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
 *
 *
 *
 * This class provides a collection of universal tools for CAPTCHA purposes.
 */


class eZHumanCAPTCHATools
{


    /**
     * Generates a random token string of given length and charset
     * (including lower and upper case characters), according to given rule.
     * If dictionary mode is used and fails to set the token, randomization
     * is used as a fallback.
     *
     * @return string
     */
    public static function generateToken()
    {
        $ini = eZINI::instance('ezhumancaptcha.ini');
        $token = false;
        
        $tokenType = $ini->variable( 'CommonCAPTCHASettings', 'TokenType' );
        
        if( $tokenType == 'dictionary' )
        {
            $tokenDictionary = $ini->variable( 'CommonCAPTCHASettings', 'TokenDictionary' );
            $tokenDictionary = explode( ';', $tokenDictionary );
            $tokenDictionaryCount = count( $tokenDictionary );
            $token = $tokenDictionary[rand( 0, $tokenDictionaryCount - 1 )];
        }
        
        if( !$token )
        {
            $tokenLength = $ini->variable( 'CommonCAPTCHASettings', 'TokenLength' );
            $tokenCharset = $ini->variable( 'CommonCAPTCHASettings', 'TokenCharset' );

            $tokenCharsetLength = mb_strlen( $tokenCharset ) - 1;
            $token  = '';
            for( $i = 1; $i <= $tokenLength ; $i++ )
            {
                $token .= $tokenCharset{rand( 0, $tokenCharsetLength )};
            }
        }
        
        return $token;
    }


    public static function bypassSessionIDHash()
    {
        $ini = eZINI::instance('ezhumancaptcha.ini');
        $generalINI = $ini->group( 'GeneralSettings' );
        return md5( self::getSessionID() . $generalINI['TokenEncryptionSalt'] );
    }


    public static function getSessionID()
    {
        $http = eZHTTPTool::instance();
        return $http->sessionID();
    }


    /**
     * Based on the encrypted token string and given image format, it generates
     * a path for the token image.
     *
     * @param string $encryptedToken
     * @return string
     */
    public static function generateImagePath( $encryptedToken )
    {
        $ini = eZINI::instance('ezhumancaptcha.ini');
        $tokenDirectory = eZSys::cacheDirectory() . '/'. $ini->variable( 'GeneralSettings', 'TokenCacheDir' ) .'/';
        $tokenFormat = $ini->variable( 'CommonCAPTCHASettings', 'TokenFormat' );

        if( !eZDir::isWriteable( $tokenDirectory ) )
        {
            eZDebug::writeNotice( 'Cache subdirectory does not exist, attempting to create', 'eZHumanCAPTCHATools::generateImagePath' );
            eZDir::mkdir( $tokenDirectory );
        }
        $tokenPath = $tokenDirectory.sha1( $encryptedToken ).'.'.$tokenFormat;

        return $tokenPath;
    }


    /**
     * A simple interface for an image filter to be loaded and used to generate
     * token image. Takes original token string as well as human value of the
     * token, and returns the image path.
     *
     * @param string $token
     * @param string $encryptedToken
     * @return string
     */
    public static function generateImage( $token, $encryptedToken )
    {
        $ini = eZINI::instance('ezhumancaptcha.ini');
        $imageFilter = mb_strtolower( $ini->variable( 'GeneralSettings', 'TokenImageFilter' ) );

        $imageFilterPath = 'extension/ezhumancaptcha/classes/imagefilters/'.$imageFilter.'.php';
        if( eZFileHandler::doExists( $imageFilterPath ) )
        {
            include_once( $imageFilterPath );
            return eZHumanCAPTCHAImageFilter::generateImage( $token, $encryptedToken );
        }
        else
        {
            eZDebug::writeError( 'No token image filter found at: '.$imageFilterPath, 'eZHumanCAPTCHATools::generateImage' );
        }
        return false;
    }


    /**
     * This method tries to get rid of an image of a given path.
     * Should be called whenever an image should be no longer valid
     *
     */
    public static function cleanupPrevious( $encryptedToken )
    {
        $path = self::generateImagePath( $encryptedToken );
        if( eZFileHandler::doExists( $path ) )
        {
            eZFileHandler::doUnlink( $path );
        }
        return;
    }


    /**
     * This method can be used whenever token is not served via datatype,
     * for example in own modules, where we have access to PHP and which
     * receive POST variables. When called, eZHumanCAPTCHACode POST variable
     * is checked and authenticated.
     *
     * Requires init() method to have been called beforehand.
     * Returns an array of error messages, if authentication failed
     * or an empty array on success.
     *
     * Validation can be bypassed by userID or siteaccess
     *
     * Requires ezcAuthentication component
     *
     * @return array
     */
    public static function validateHTTPInput()
    {
        $result = array();
        $http = eZHTTPTool::instance();
        $ini = eZINI::instance('ezhumancaptcha.ini');

        if( $ini->hasVariable( 'GeneralSettings', 'TokenBypassSiteaccessList' ) )
        {
            $bypassSiteaccessList = $ini->variable( 'GeneralSettings', 'TokenBypassSiteaccessList' );
            if( in_array( $GLOBALS['eZCurrentAccess']['name'], $bypassSiteaccessList ) )
            {
                return $result;
            }
        }

        if( $ini->hasVariable( 'GeneralSettings', 'TokenBypassUserIDList' ) )
        {
            $bypassUserList = $ini->variable( 'GeneralSettings', 'TokenBypassUserIDList' );
            if( in_array( eZUser::currentUserID(), $bypassUserList ) )
            {
                return $result;
            }
        }

        if( $http->hasPostVariable( 'eZHumanCAPTCHACode' ) )
        {

            if( $ini->hasVariable( 'GeneralSettings', 'TokenSessionVariableName' ) )
            {
                $tokenSessionVariableName = $ini->variable( 'GeneralSettings', 'TokenSessionVariableName' );
            }
            else
            {
                $tokenSessionVariableName = 'eZHumanCAPTCHAEncryptedToken';
            }


            $captcha = $http->postVariable( 'eZHumanCAPTCHACode' );
            if( $ini->hasVariable( 'CommonCAPTCHASettings', 'TokenUpperToLowerCase' ) )
            {
                if( $ini->variable( 'CommonCAPTCHASettings', 'TokenUpperToLowerCase' ) == 'enabled' )
                {
                    $captcha = mb_strtolower( $captcha );
                }
            }

            if( $http->hasSessionVariable( $tokenSessionVariableName ) )
            {
                $encryptedToken = $http->sessionVariable( $tokenSessionVariableName );

                if ( $captcha == '' )
                {
                    self::cleanupPrevious( $encryptedToken );
                    $http->setSessionVariable( $tokenSessionVariableName, '' );
                    $result[] = ezpI18n::tr( 'extension/ezhumancaptcha', 'The CAPTCHA code is empty' );
                }
                else
                {
                    $credentials = new ezcAuthenticationIdCredentials( $captcha );
                    $authentication = new ezcAuthentication( $credentials );
                    $authentication->addFilter( new ezcAuthenticationTokenFilter( $encryptedToken, array( 'eZHumanCAPTCHATools', 'encryptToken' ) ) );
                    if ( !$authentication->run() )
                    {
                        self::cleanupPrevious( $encryptedToken );
                        $http->setSessionVariable( $tokenSessionVariableName, '' );
                        $result[] = ezpI18n::tr( 'extension/ezhumancaptcha', 'The CAPTCHA code is not valid' );
                    }
                }
                self::cleanupPrevious( $encryptedToken );
                $http->setSessionVariable( $tokenSessionVariableName, '' );
            }
            else
            {
                $result[] = ezpI18n::tr( 'extension/ezhumancaptcha', 'The CAPTCHA code is not set' );
            }
        }
        else
        {
            $result[] = ezpI18n::tr( 'extension/ezhumancaptcha', 'The CAPTCHA code is not set' );
        }

        return $result;
    }


    /**
     * Initializes a CAPTCHA check session by cleaning previous image,
     * setting up token, encrypting it in session variables, and generating
     * token image. Returns a path to a new captcha token image.
     *
     * This method is used by ezhumancaptcha_image template operator, which
     * means that every time the operator is used, new CAPTCHA set is
     * initialized.
     *
     *
     * @return unknown
     */
    public static function init()
    {

        $http = eZHTTPTool::instance();
        $ini = eZINI::instance('ezhumancaptcha.ini');

        if( $ini->hasVariable( 'GeneralSettings', 'TokenSessionVariableName' ) )
        {
            $tokenSessionVariableName = $ini->variable( 'GeneralSettings', 'TokenSessionVariableName' );
        }
        else
        {
            $tokenSessionVariableName = 'eZHumanCAPTCHAEncryptedToken';
        }

        if( $http->hasSessionVariable( $tokenSessionVariableName ) )
        {
            $encryptedToken = $http->sessionVariable( $tokenSessionVariableName );
            self::cleanupPrevious( $encryptedToken );
        }


        $token = self::generateToken();
        $imageToken = $token;
        if( $ini->hasVariable( 'CommonCAPTCHASettings', 'TokenUpperToLowerCase' ) )
        {
            if( $ini->variable( 'CommonCAPTCHASettings', 'TokenUpperToLowerCase' ) == 'enabled' )
            {
                $token = mb_strtolower( $token );
            }
        }

        $encryptedToken = self::encryptToken( $token );

        $http->setSessionVariable( $tokenSessionVariableName, $encryptedToken );
        $path = self::generateImage( $imageToken, $encryptedToken );
        return $path;
    }


    /**
     * Encrypts token according to a chosen method
     *
     * @param string $token
     * @return string
     */
    public static function encryptToken( $token )
    {
        $encryptedToken = '';
        $tokenSalt = '';
        $ini = eZINI::instance('ezhumancaptcha.ini');
        if( $ini->hasVariable( 'GeneralSettings', 'TokenEncryptionSalt' ) )
        {
            $tokenSalt = $ini->variable( 'GeneralSettings', 'TokenEncryptionSalt' );
        }

        if( $ini->hasVariable( 'GeneralSettings', 'TokenEncryptionMethod' ) )
        {
            $tokenEncryptionMethod = $ini->variable('GeneralSettings', 'TokenEncryptionMethod' );
        }
        else
        {
            $tokenEncryptionMethod = 'sha1';
        }

        switch( $tokenEncryptionMethod )
        {
            case 'md5':
                $encryptedToken = md5( $token.$tokenSalt );
                break;
            case 'sha1':
                $encryptedToken = sha1( $token.$tokenSalt );
                break;
            default:
                $encryptedToken = sha1( $token.$tokenSalt );
                eZDebug::writeWarning( 'Unknown token encryption method: '.$tokenEncryptionMethod.', used sha1 instead', 'eZHumanCAPTCHATools::encryptToken' );
                break;
        }
        return $encryptedToken;
    }


    /**
     * Method for maintenance purposes, cleans up images that were not
     * cleaned automatically. Should be run periodically.
     *
     * @return array
     */
    public static function cleanupImages()
    {

        $ini = eZINI::instance('ezhumancaptcha.ini');
        $tokenDirectory = eZSys::cacheDirectory() . '/'. $ini->variable( 'GeneralSettings', 'TokenCacheDir' ) .'/';
        $tokenTimeout = time() - $ini->variable( 'GeneralSettings', 'TokenTimeout' );
        $tokenImages = eZDir::findSubitems( $tokenDirectory, 'f' );

        $countAll = 0;
        $countUnlinked = 0;
        foreach( $tokenImages as $tokenImage )
        {
            $countAll++;
            $path = $tokenDirectory . $tokenImage;
            $tokenMTime = filemtime( $path );
            if( $tokenMTime < $tokenTimeout )
            {
                eZFileHandler::doUnlink( $path );
                $countUnlinked++;
            }
        }
        return array( $countUnlinked, $countAll, );
    }

}
?>
