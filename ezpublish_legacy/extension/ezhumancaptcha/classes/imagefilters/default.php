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
 * This is a default image filter class for CAPTCHA.
 */


class eZHumanCAPTCHAImageFilter
{

    /**
     * This method is responsible for generating a proper CAPTCHA token image
     * and returning path to it.
     *
     * It should:
     * - generate the image in a proper location
     * - write the image in one of the supported formats
     *
     * @param string $token
     * @param string $encryptedToken
     * @return string
     */

    public static function generateImage( $token, $encryptedToken )
    {

        $ini = eZINI::instance('ezhumancaptcha.ini');

        $filterSettings = $ini->group( 'DefaultFilterSettings' );
        $commonSettings = $ini->group( 'CommonCAPTCHASettings' );

        $path = eZHumanCAPTCHATools::generateImagePath( $encryptedToken, $commonSettings['TokenFormat'] );
        $tokenLength = mb_strlen( $token );

        // Begin actuall token image generation
        $image = imagecreatetruecolor( (int)$filterSettings['TokenWidth'], (int)$filterSettings['TokenHeight'] );

        $bgImagePath = $filterSettings['TokenBackgroundPath'].$filterSettings['TokenBackgroundImage'][rand(0, count($filterSettings['TokenBackgroundImage'])-1)];
        if( count ( $filterSettings['TokenBackgroundImage'] ) )
        {
            if( eZFileHandler::doExists( $bgImagePath ) )
            {
                $bgImage = imagecreatefromgif( $bgImagePath );
                imagecopyresampled( $image, $bgImage, 0, 0, rand(0, 100), rand(0, 100), (int)$filterSettings['TokenWidth'], (int)$filterSettings['TokenHeight'], (int)$filterSettings['TokenWidth'], (int)$filterSettings['TokenHeight'] );
                imagedestroy( $bgImage );
            }
            else
            {
                eZDebug::writeError( 'No token background image found at: '.$bgImagePath, 'eZHumanCAPTCHAImageFilter::generateImage' );
            }
        }

        $spaceX = (int)$filterSettings['TokenWidth']/$tokenLength;
        for($s=0; $s<$tokenLength; $s++)
        {
            /*
             $RColor = 215;
             $GColor = 235;
             $BColor = 194;
             */
            $RColor = 255;
            $GColor = 255;
            $BColor = 255;
            $textColor = imagecolorallocate( $image, $RColor, $GColor, $BColor );
            $fontPath = $filterSettings['TokenFontPath'].$filterSettings['TokenFont'][rand( 0, count( $filterSettings['TokenFont'] )-1 )];
            imagettftext( $image, $filterSettings['TokenFontSize'], rand( -$filterSettings['TokenFontRotation']/2, $filterSettings['TokenFontRotation']/2 ), round( $spaceX*$s )+$filterSettings['TokenFontShiftX'], $filterSettings['TokenFontShiftY'], $textColor, $fontPath, mb_substr( $token, $s, 1 ) );
        }

        switch( $commonSettings['TokenFormat'] )
        {
            case 'png':
                imagepng( $image, $path );
                break;
            case 'jpg':
                imagejpeg( $image, $path );
                break;
            case 'gif':
                imagegif( $image, $path );
                break;
        }

        imagedestroy( $image );
        return $path;
    }



}
?>
