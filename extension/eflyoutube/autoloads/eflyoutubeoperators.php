<?php

class eflYoutube
{

    function __construct()
    {
        $this->Operators = array( 'eflyoutube' );
    }

    function operatorList()
    {
        return $this->Operators;
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(  'eflyoutube' => array(	'youtube_url' => array( 'type' => 'string', 'required' => true),
        										'width' => array( 'type' => 'integer', 'required' => true),
        										'height' => array( 'type' => 'integer', 'required' => true)
        										 ));
    }
    
    function eflEmbedVideo( $videoid, $width=481, $height=290 )
    {
    	$jutjub = new YouTube();
		$videoid = $jutjub->_GetVideoIdFromUrl( $videoid );
		return '<object type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" data="https://www.youtube.com/v/'.$videoid.'"><param name="wmode" value="transparent" /><param name="movie" value="https://www.youtube.com/v/'.$videoid.'" /></object>';
	}

    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace,
    $currentNamespace, &$operatorValue, $namedParameters )
    {
        $youtubeURL = $namedParameters['youtube_url'];
        $width 		= $namedParameters['width'];
        $height 	= $namedParameters['height'];
        
        switch ( $operatorName )
        {
            case 'eflyoutube':
            {
            	$operatorValue = $this->eflEmbedVideo( $youtubeURL, $width, $height );
            }break;
            
        }
        
    }
    
    public $Operators;
}

?>
