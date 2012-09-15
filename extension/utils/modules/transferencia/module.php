<?php
$Module = array( "name" => "transferencia",
                 "variable_params" => true );

$ViewList = array();

$ViewList['complete'] = array(
    'functions' => array( 'transferencia' ),
    'script' => 'complete.php',
    'params' => array( 'OrderID', 'FromSurvey'  )
);

$FunctionList = array();
$FunctionList['transferencia'] = array( );
?>
