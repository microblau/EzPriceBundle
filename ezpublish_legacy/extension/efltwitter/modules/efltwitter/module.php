<?php

$Module = array( 'name' => 'EFL Twitter' );

$ViewList = array();
$ViewList['status'] = array (
    'functions' => array( 'status' ),
    'script' => 'status.php'
);

$ViewList['search'] = array (
    'functions' => array( 'status' ),
    'script' => 'search.php'
);

$FunctionList = array();
$FunctionList['status'] = array();

?>
