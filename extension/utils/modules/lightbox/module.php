<?php

//
// SOFTWARE NAME: Lightbox
// SOFTWARE RELEASE: 0.1
// COPYRIGHT NOTICE: Copyright (C) 2011 Tanta Comunicación

$Module = array( 'name' => 'producto',
                 'variable_params' => true );

$ViewList = array();
	
$ViewList['ver'] = array(
    'script' => 'ver.php',
	'functions' => array( 'ver' ),
    'params' => array( 'NodeID' ),
	);	
	
$FunctionList['ver'] = array();


?>
