<?php

/**
 * eZ Human CAPTCHA extension for eZ Publish 4.0
 * Written by Piotrek Karas, Copyright (C) SELF s.c.
 * http://www.mediaself.pl, http://ryba.eu
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2 of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */


class eZHumanCAPTCHAType extends eZDataType
{


    const DATA_TYPE_STRING = 'ezhumancaptcha';


    public function __construct()
    {
        $this->eZDataType( self::DATA_TYPE_STRING, ezi18n( 'extension/ezhumancaptcha', "Human CAPTCHA" ) );
    }


    function initializeObjectAttribute( $contentObjectAttribute, $currentVersion, $originalContentObjectAttribute )
    {
        if ( $currentVersion != false )
        {
            $dataText = $originalContentObjectAttribute->attribute( "data_text" );
            $contentObjectAttribute->setAttribute( "data_text", $dataText );
        }
    }


    private function validateCAPTCHAHTTPInput( $captcha, $contentObjectAttribute )
    {

        include_once( 'extension/ezhumancaptcha/classes/ezhumancaptchatools.php' );

        $http = eZHTTPTool::instance();
        $ini = eZINI::instance('ezhumancaptcha.ini');

        if( $ini->hasVariable( 'GeneralSettings', 'TokenBypassSiteaccessList' ) )
        {
            $bypassSiteaccessList = $ini->variable( 'GeneralSettings', 'TokenBypassSiteaccessList' );
            if( in_array( $GLOBALS['eZCurrentAccess']['name'], $bypassSiteaccessList ) )
            {
                $contentObjectAttribute->setAttribute( "data_text", '' );
                return eZInputValidator::STATE_ACCEPTED;
            }
        }

        if( $ini->hasVariable( 'GeneralSettings', 'TokenBypassUserIDList' ) )
        {
            $bypassUserList = $ini->variable( 'GeneralSettings', 'TokenBypassUserIDList' );
            if( in_array( eZUser::currentUserID(), $bypassUserList ) )
            {
                $contentObjectAttribute->setAttribute( "data_text", '' );
                return eZInputValidator::STATE_ACCEPTED;
            }
        }

        if( $ini->hasVariable( 'GeneralSettings', 'TokenSessionVariableName' ) )
        {
            $tokenSessionVariableName = $ini->variable( 'GeneralSettings', 'TokenSessionVariableName' );
        }
        else
        {
            $tokenSessionVariableName = 'eZHumanCAPTCHAEncryptedToken';
        }

        if( $ini->hasVariable( 'CommonCAPTCHASettings', 'TokenUpperToLowerCase' ) )
        {
            if( $ini->variable( 'CommonCAPTCHASettings', 'TokenUpperToLowerCase' ) == 'enabled' )
            {
                $captcha = mb_strtolower( $captcha );
            }
        }


        $classAttribute = $contentObjectAttribute->contentClassAttribute();

        if( $ini->hasVariable( 'GeneralSettings', 'TokenBypassLoggedInClassAttributeID' ) )
        {
            if( in_array( $classAttribute->ID, $ini->variable( 'GeneralSettings', 'TokenBypassLoggedInClassAttributeID' ) ) )
            {
                if( $captcha == eZHumanCAPTCHATools::bypassSessionIDHash() )
                {
                    $contentObjectAttribute->setAttribute( "data_text", '' );
                    return eZInputValidator::STATE_ACCEPTED;
                }
            }
        }

        if( $http->hasSessionVariable( $tokenSessionVariableName ) )
        {
            $encryptedToken = $http->sessionVariable( $tokenSessionVariableName );

            if ( $captcha == '' )
            {

                if ( $contentObjectAttribute->validateIsRequired() )
                {
                    eZHumanCAPTCHATools::cleanupPrevious( $encryptedToken );
                    $http->setSessionVariable( $tokenSessionVariableName, '' );
                    $contentObjectAttribute->setValidationError( ezi18n( 'extension/ezhumancaptcha', 'The CAPTCHA code is empty' ) );
                    return eZInputValidator::STATE_INVALID;
                }
            }
            else
            {
                $credentials = new ezcAuthenticationIdCredentials( $captcha );
                $authentication = new ezcAuthentication( $credentials );
                $authentication->addFilter( new ezcAuthenticationTokenFilter( $encryptedToken, array( 'eZHumanCAPTCHATools', 'encryptToken' ) ) );
                if ( !$authentication->run() )
                {
                    eZHumanCAPTCHATools::cleanupPrevious( $encryptedToken );
                    $http->setSessionVariable( $tokenSessionVariableName, '' );
                    $contentObjectAttribute->setValidationError( ezi18n( 'extension/ezhumancaptcha', 'The CAPTCHA code is not valid' ) );
                    return eZInputValidator::STATE_INVALID;
                }
            }
            eZHumanCAPTCHATools::cleanupPrevious( $encryptedToken );
            $http->setSessionVariable( $tokenSessionVariableName, '' );
        }
        else
        {
            $contentObjectAttribute->setValidationError( ezi18n( 'extension/ezhumancaptcha', 'The CAPTCHA code is not set' ) );
            return eZInputValidator::STATE_INVALID;
        }
        return eZInputValidator::STATE_ACCEPTED;
    }


    function validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . '_data_text_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
            $captchaPost = $http->postVariable( $base . '_data_text_' . $contentObjectAttribute->attribute( 'id' ) );
            $captchaPost = trim( $captchaPost );
            return $this->validateCAPTCHAHTTPInput( $captchaPost, $contentObjectAttribute );

        }
        else
        {
            $ini = eZINI::instance('ezhumancaptcha.ini');
            if( $ini->hasVariable( 'GeneralSettings', 'IsAttributeRequired' ) )
            {
                if( $ini->variable( 'GeneralSettings', 'IsAttributeRequired' ) == 'true' )
                {
                    $contentObjectAttribute->setValidationError( ezi18n( 'extension/ezhumancaptcha', 'The CAPTCHA attribute is missing' ) );
                    return eZInputValidator::STATE_INVALID;
                }
            }
        }
        return eZInputValidator::STATE_ACCEPTED;
    }


    function fetchObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) ) )
        {
            $data = $http->postVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) );
            $contentObjectAttribute->setAttribute( "data_text", $data );
            return true;
        }
        return true;
    }


    function storeObjectAttribute( $attribute )
    {
        return;
    }


    function objectAttributeContent( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( "data_text" );
    }


    function validateCollectionAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        return $this->validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute );
    }


    function fetchCollectionAttributeHTTPInput( $collection, $collectionAttribute, $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) ) )
        {
            $dataText = $http->postVariable( $base . "_data_text_" . $contentObjectAttribute->attribute( "id" ) );
            $collectionAttribute->setAttribute( 'data_text', $dataText );
            return true;
        }
        return false;
    }



    function isIndexable()
    {
        return false;
    }


    function metaData( $contentObjectAttribute )
    {
        return '';
    }


    function toString( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( 'data_text' );
    }


    function fromString( $contentObjectAttribute, $string )
    {
        return $contentObjectAttribute->setAttribute( 'data_text', $string );
    }


    function title( $contentObjectAttribute, $name = null )
    {
        return $contentObjectAttribute->attribute( "data_text" );
    }


    function hasObjectAttributeContent( $contentObjectAttribute )
    {
        return trim( $contentObjectAttribute->attribute( "data_text" ) ) != '';
    }


    function isInformationCollector()
    {
        return true;
    }


    function sortKey( $contentObjectAttribute )
    {
        return '';
    }


    function sortKeyType()
    {
        return 'string';
    }


}

eZDataType::register( eZHumanCAPTCHAType::DATA_TYPE_STRING, "eZHumanCAPTCHAType" );

?>
