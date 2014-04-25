<?php
class Utils
{
    /**
     * Constructor
     *
     */
    const SECOND = 1;
    const MINUTE = 60;
    const HOUR = 3600;
    const DAY = 86400;
    const MONTH = 2592000;    

    function __construct()
    {
    }
    
    /**
     * operatorList
     * 
     * @return array list of template operators hosted by this class
     */
    function operatorList()
    {
        return array( 'normalize_path', 'ezurl_formacion', 'ezurl_www', 'sortbasketitems', 'redirect', 'tweetrelativetime', 'redirectToFirstAvailableChild' );
    }
    
    /**
     * namedParameterPerOperator
     * 
     * @return true 
     */
    function namedParameterPerOperator()
    {
        return true;
    }
    
    /**
     * namedParameterList
     * 
     * @return array List of operators and their parameters
     */
    function namedParameterList()
    {
        return array( 'normalize_path' => array( ), 'ezurl_formacion' => array( ), 'ezurl_www' => array(), 
        				'sortbasketitems' => array(), 'redirect' => array(), 'tweetrelativetime' => array(),
				'redirectToFirstAvailableChild' => array()
         );               
    }
    
    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    {
        switch(  $operatorName )
		{
            case 'redirect':               
                eZURI::transformURI( $operatorValue );
                eZHTTPTool::redirect( $operatorValue, array(), 301 );
                eZExecution::cleanExit();
                break;
		    case 'normalize_path':
                $trans = eZCharTransform::instance();
		        $operatorValue = $trans->transformByGroup( $operatorValue, "urlalias_compat" );	
                break;

		    case 'ezurl_formacion':
		    	  $ini = eZINI::instance();
				  $operatorValue = '"' . 'http://' . $ini->variable( 'EFLSettings', 'FormationSubdomain' ) . '/' . str_replace( 'formacion/', '', $operatorValue ) . '"';
                  break;  
                   
            case 'ezurl_www':
		    	  $ini = eZINI::instance();	
		    	  if( strpos( '/', $operatorValue ) === 0 )
				  {
				  	 $add = '';
				  }		    	
				  else
				  {
				  	 $add = '/';
				  }  
				  $operatorValue = '"' . 'http://' . $ini->variable( 'EFLSettings', 'WWWSubdomain' ) . $add . $operatorValue . '"';
				  
				  
                  break; 

            case 'sortbasketitems':            	     	  
            	  $prices = array();
            	  $names = array();
            	  foreach( $operatorValue as $index => $val )
            	  {
            	  	 $prices[] = $val['price_ex_vat'];
            	  	 $names[] = $val['object_name'];            	  	 
            	  }
            	  array_multisort($prices, SORT_DESC, $names, $operatorValue);
                break;
            case 'tweetrelativetime':
                     
                $delta = time() - $operatorValue;


                if ($delta < ( 2 * self::MINUTE ) ) {
                    $operatorValue = "hace 1 minuto";
                }
                elseif ($delta < ( 45 * self::MINUTE ) ) {
                    $operatorValue = "hace " . floor($delta / self::MINUTE) . " minutos";
                }
                elseif ($delta < ( 90 * self::MINUTE) ) {
                    $operatorValue = "hace 1 hora";
                }
                elseif ($delta < ( 24 * self::HOUR) ) {
                    $operatorValue = "hace " . floor($delta / self::HOUR) . " horas";
                }
                elseif ($delta < ( 48 * self::HOUR ) ) {
                   $operatorValue = "ayer";
                }
                elseif ($delta < ( 30 * self::DAY) ) {
                    $operatorValue = "hace " . floor($delta / self::DAY) . " días";
                }
                elseif ($delta < ( 12 * self::MONTH) ) {
                    $months = floor($delta / self::DAY / 30);
                    $operatorValue = $months <= 1 ? "hace 1 mes" : "hace " . $months . " meses";
                } else {
                    $years = floor($delta / self::DAY / 365);
                   $operatorValue =  $years <= 1 ? "hace un año" : "hace " . $years . " años";
                }
                break;
	   case 'redirectToFirstAvailableChild':
		$data = $operatorValue->dataMap();
		if ( $data['ventajas']->hasContent() )
		{
		   $ventajas = eZContentObjectTreeNode::subTreeByNodeId( 
                      array( 'ClassFilterType' => 'include',
                            'ClassFilterArray' => array( 'ventajas_producto' ) ),

		      $operatorValue->attribute('node_id')
		   );
                  
	          eZURI::transformURI( $ventajas[0]->urlAlias() );
                  eZHTTPTool::redirect( '/' . $ventajas[0]->urlAlias(), array(), 301 );
                 
		 
                }
                
		if ( $data['condiciones']->hasContent() )
		{
		   $els = eZContentObjectTreeNode::subTreeByNodeId( 
                      array( 'ClassFilterType' => 'include',
                            'ClassFilterArray' => array( 'condiciones_producto' ) ),

		      $operatorValue->attribute('node_id')
		   );
                  
	          eZURI::transformURI( $els[0]->urlAlias() );
                  eZHTTPTool::redirect( '/' . $els[0]->urlAlias(), array(), 301 );
                 
		 
                }

		$pestanias =  eZContentObjectTreeNode::subTreeByNodeId( 
                      array( 'ClassFilterType' => 'include',
                            'ClassFilterArray' => array( 'pestania' ) ),

		      $operatorValue->attribute('node_id')
		   );
		if( count($pestanias) ){
		     eZURI::transformURI( $pestanias[0]->urlAlias() );
 
                  eZHTTPTool::redirect( '/' . $pestanias[0]->urlAlias(), array(), 301 );
                }
		$operatorValue = '';
		break;
        }	
    }    
}
?>
