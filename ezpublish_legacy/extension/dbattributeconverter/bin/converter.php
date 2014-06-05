<?php
// Created on: <26-Jul-2009 17:00 bm>
//
// SOFTWARE NAME: DB Attribute Converter
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 2009 DB Team, http://db-team.eu
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.


require 'autoload.php';


// Init script

$cli = eZCLI::instance();
$endl = $cli->endlineString();

$script = eZScript::instance( array( 'description' => ( "CLI script.\n\n" .
                                                        "Will convert attributes set with wizard.\n" .
                                                        "\n" .
                                                        'converter.php -s admin' ),
                                      'use-session' => false,
                                      'use-modules' => true,
                                      'use-extensions' => true ) );
$script->startup();

$options = $script->getOptions( '[db-user:][db-password:][db-database:][db-driver:][sql][filename-part:][admin-user:][scriptid:]',
                                '[name]',
                                array( 'db-host' => 'Database host',
                                       'db-user' => 'Database user',
                                       'db-password' => 'Database password',
                                       'db-database' => 'Database name',
                                       'db-driver' => 'Database driver',
                                       'sql' => 'Display sql queries',
                                       'filename-part' => 'Part of filename to read with serialized object data',
                                       'admin-user' => 'Alternative login for the user to perform operation as',
                                       'scriptid' => 'Used by the Script Monitor extension, do not use manually'
                                        ) );
$script->initialize();

// Log in admin user
if ( isset( $options['admin-user'] ) )
{
    $adminUser = $options['admin-user'];
}
else
{
    $adminUser = 'admin';
}
$user = eZUser::fetchByName( $adminUser );
if ( $user )
    eZUser::setCurrentlyLoggedInUser( $user, $user->attribute( 'id' ) );
else
{
    $cli->error( 'Could not fetch admin user object' );
    $script->shutdown( 1 );
    return;
}

$db = eZDB::instance();

// Take care of script monitoring
$scheduledScript = false;
if ( isset( $options['scriptid'] ) and
     in_array( 'ezscriptmonitor', eZExtension::activeExtensions() ) and
     class_exists( 'eZScheduledScript' ) )
{
    $scriptID = $options['scriptid'];
    $scheduledScript = eZScheduledScript::fetch( $scriptID );
}


// get data from file
if ( isset( $options['filename-part'] ) )
{
    $filename_part = $options['filename-part'];
}
else
{
	$cli->error( 'Missing datafile name !' );
	$script->shutdown();
}

$filename = 'var/cache/' . $filename_part . '.txt';
$fp = fopen( $filename, 'r' );
$contents = fread( $fp, filesize( $filename ) );
fclose( $fp );

$object = unserialize( $contents );


$cli->endlineString();

$handler_name = $object->variable( 'source_datatype_string') . '2' . $object->variable( 'target_datatype_string' );

$cli->output( 'Procesing handler: ' . $handler_name );


// initialize convert handler
$converter = new $handler_name();

// transaction begin - note that with transaction it's not possible to see progress in script monitoring tool
$db = eZDB::instance();
//$db->begin();			

// do preAction()
$converter->preAction( $object );


// do class attribute conversion
$contentClassAttribute = eZContentClassAttribute::fetch( $object->variable( 'attribute_id' ) );
$converter->convertClassAttribute( $contentClassAttribute, $object );		

if ( $scheduledScript )
{		
	$scheduledScript->updateProgress( 1 ); // after class conversion set process as 1%
}

// do postConvertClassAttributeAction()
$converter->postConvertClassAttributeAction( $object );

// do preConvertObjectAttributesAction()
$converter->preConvertObjectAttributesAction( $object );
			
// fetch attributes just to count			
$total_attribute_count = DBAttributeConverter::getContentObjectAttributeCount( $object->variable( 'attribute_id' ) );

// do object attributes conversion - all versions
$conditions = array( "contentclassattribute_id" => $object->variable( 'attribute_id' ) );
$offset = 0;
$limit = 100;
$counter = 0;

while ( true )
{
	$objectsArray = eZPersistentObject::fetchObjectList( eZContentObjectAttribute::definition(),
                                                null,
                                                $conditions,
                                                null,
                                                array( 'limit' => $limit,
													   'offset' => $offset ),
                                                $asObject = true);
	
	if ( !$objectsArray || count( $objectsArray ) == 0 )
	{
		break;
	}

	$offset+=$limit;
	
	foreach ( $objectsArray as $attributeObject )
	{
		$converter->convertObjectAttribute( $attributeObject, $object );
		$cli->output( '#', false );
		$counter++;
	}
	
    // Progress bar and Script Monitor progress
    $progressPercentage = ( $counter / $total_attribute_count ) * 100;
    $cli->output( sprintf( ' %01.1f %%', $progressPercentage ) );
    if ( $scheduledScript )
    {
        $scheduledScript->updateProgress( $progressPercentage );
    }

}
// do postAction()
$converter->postAction( $object );

// transaction commit
//$db->commit();

// remove used file
unlink( $filename );


$script->shutdown();
?>