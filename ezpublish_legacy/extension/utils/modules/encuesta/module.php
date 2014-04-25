<?php
$Module = array( 'name' => 'encuesta',
                 'variable_params' => true,
				 'function' => array(
					'script' => 'rellenar.php',
					'params' => array( 'Hash', 'OrderID', 'Type' ),
					'functions' => array( 'rellenar')
				 )
);

$ViewList = array();



$FunctionList = array();
$FunctionList['rellenar'] = array( );
?>
