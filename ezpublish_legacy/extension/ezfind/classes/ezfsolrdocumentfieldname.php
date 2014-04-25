<?php
//
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Find
// SOFTWARE RELEASE: 2.7.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2012 eZ Systems AS
// SOFTWARE LICENSE: eZ Business Use License Agreement eZ BUL Version 2.1
// NOTICE: >
//  This source file is part of the eZ Publish CMS and is
//  licensed under the terms and conditions of the eZ Business Use
//  License v2.1 (eZ BUL).
//
//  A copy of the eZ BUL was included with the software. If the
//  license is missing, request a copy of the license via email
//  at license@ez.no or via postal mail at
// 	Attn: Licensing Dept. eZ Systems AS, Klostergata 30, N-3732 Skien, Norway
//
//  IMPORTANT: THE SOFTWARE IS LICENSED, NOT SOLD. ADDITIONALLY, THE
//  SOFTWARE IS LICENSED "AS IS," WITHOUT ANY WARRANTIES WHATSOEVER.
//  READ THE eZ BUL BEFORE USING, INSTALLING OR MODIFYING THE SOFTWARE.

// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*! \file ezfsolrdocumentfieldname.php
*/

/**
 * Class for looking up and storing Solr doc field names. This class will
 * store mapping from base names to solr internal field names for quicker
 * access.
 */
class ezfSolrDocumentFieldName
{
    /**
     *Constructor
     */
    function __construct()
    {
    }

    /**
     * Lookup Solr schema field name. The lookup requires base name and
     * field type to generate the correct field name.
     *
     * @param string Base name
     * @param string Field type
     *
     * @return string Solr field name.
     */
    public function lookupSchemaName( $baseName, $fieldType )
    {
        $solrFieldName = $baseName . $this->getPostFix( $fieldType );
        return $solrFieldName;
    }

    /**
     * @deprecated since 2.1
     * Get instance of PHPCreator to use for storing and loading
     * look up table.
     *
     * @return eZPHPCreator return instance of eZPHPCreator
     * @todo Refactor with ezcPhpGenerator
     *       http://ezcomponents.org/docs/api/trunk/classtrees_PhpGenerator.html
     */
    protected function getPHPCreatorInstance()
    {
        if ( empty( self::$PHPCreator ) )
        {
            self::$PHPCreator = new eZPHPCreator( eZDIR::path( array( eZSys::storageDirectory(),
                                                                      ezfSolrDocumentFieldName::LOOKUP_FILEDIR ) ),
                                                  ezfSolrDocumentFieldName::LOOKUP_FILENAME );
        }

        return self::$PHPCreator;
    }

    /**
     * @deprecated since 2.1
     * Load name lookup table from PHP cache.
     *
     * Stores the looup table to member variable self::$LookupTable
     */
    protected function loadLookupTable()
    {
        $phpCreator = $this->getPHPCreatorInstance();

        if ( $phpCreator->canRestore() )
        {
            $tableArray = $phpCreator->restore( array( 'table' => 'table' ) );
            self::$LookupTable = $tableArray['table'];
        }
        else
        {
            self::$LookupTable = array();
        }
    }

    /**
     * @deprecated since 2.1
     * Save new entry to lookup table
     *
     * @param string Base name
     * @param string Field type
     * @param string Solr internal field name
     */
    protected function saveEntry( $baseName, $fieldType, $solrFieldName )
    {
        self::$LookupTable[md5( $baseName . '_' . $fieldType )] = $solrFieldName;

        $phpCreator = $this->getPHPCreatorInstance();
        $phpCreator->Elements = array();
        $phpCreator->addVariable( 'table', self::$LookupTable );
        $phpCreator->store();
    }

    /**
     * Get field name postfix based on field type.
     *
     * @param string Field Type
     *
     * @return string Field name postfix.
     */
    static function getPostFix( $fieldType )
    {
        return '_' . self::$FieldTypeMap[$fieldType];
    }

    /// Member vars
    static $LookupTable = null;
    static $FieldTypeMap = array( 'int' => 'i',
                                  'float' => 'f',
                                  'double' => 'd',
                                  'sint' => 'si',
                                  'sfloat' => 'sf',
                                  'sdouble' => 'sd',
                                  'string' => 's',
                                  'long' => 'l',
                                  'slong' => 'sl',
                                  'text' => 't',
                                  'boolean' => 'b',
                                  'date' => 'dt',
                                  'random' => 'random',
                                  'keyword' => 'k',
                                  'lckeyword' => 'lk',
                                  'textgen' => 'tg',
                                  'alphaOnlySort' => 'as',
                                  'tint' => 'ti',
                                  'tfloat' => 'tf',
                                  'tdouble' => 'td',
                                  'tlong' => 'tl',
                                  'tdate' => 'tdt',
                                  'geopoint' => 'gpt',
                                  'geohash' => 'gh',
                                  'mstring' => 'ms',
                                  'mtext' => 'mt',
                                  'texticu' => 'tu');

    static $DefaultType = 'string';
    static $PHPCreator = null;

    const LOOKUP_FILENAME = 'ezfind_field_name.php';
    const LOOKUP_FILEDIR = 'ezfind';
}

?>
