<?php


class Valoraciones  {

	function Valoraciones(){
	}

	function havotado($node_id,$usuario){
		$db = eZDB::instance();
		$res= $db->arrayQuery( "SELECT count(*) as cuantos from valoraciones_productos where node_producto=". $node_id. " and user_id=".$usuario."");
		$result=$res[0]['cuantos'];
		return array( 'result' => $result );
		
		}

	function muestratodas($node_id,$limite,$offset,$condicion){
		$devuelve=$node_id;
		if ($condicion==''){
			$condi='';
			}else{
			$condi='and ' .$condicion;
			}
		$db = eZDB::instance();
		$primer=$offset;
		$segun=$limite;
		
		if(($primer==0) && ($segun==0)){
			$res= $db->arrayQuery( "SELECT * from valoraciones_productos where node_producto=". $devuelve. " and visible=1 ".$condi." order by fecha desc");
		}else{
			$res= $db->arrayQuery( "SELECT * from valoraciones_productos where node_producto=". $devuelve. " and visible=1 ".$condi." order by fecha desc limit ".$primer.",".$segun."");
		}
		
		
		
//print "SELECT * from valoraciones_productos where node_producto=". $devuelve. " and visible=1 ".$condi." order by fecha desc limit ".$primer.",".$segun."";
	//var_dump($res);
//die('');
		$result=$res;
		return array( 'result' => $result );
	}

	function cuantasvaloraciones($node_id){
		$devuelve=$node_id;
		
		$db = eZDB::instance();
		$res= $db->arrayQuery( "SELECT count(*) as cuantos from valoraciones_productos where node_producto=". $devuelve. " and visible=1");
		$result=$res[0]['cuantos'];
		return array( 'result' => $result );
		
		}

	function mediacalidad($node_id){
		$devuelve=$node_id;
		
		$db = eZDB::instance();
		$res= $db->arrayQuery( "SELECT calidad as calidad from valoraciones_productos where node_producto=". $devuelve. " and visible=1");
		$sum=0;
		$cuantos=count($res);
		foreach ($res as $fila){
			$sum += $fila['calidad'];	
		}
			
		$media=$sum/$cuantos;
		$fracciones=intval($media/0.5);
		
		$result=$fracciones * 0.5;
      
		return array( 'result' => number_format( $result, 1, '.', '' ) );
	}

	function mediaactualizaciones($node_id){
		$devuelve=$node_id;
		
		$db = eZDB::instance();
		$res= $db->arrayQuery( "SELECT actualizaciones as actualizaciones from valoraciones_productos where node_producto=". $devuelve. " and visible=1");
		$sum=0;
		$cuantos=count($res);
		foreach ($res as $fila){
			$sum += $fila['actualizaciones'];	
		}
			
		$media=$sum/$cuantos;
		$fracciones=intval($media/0.5);
		
		$result=$fracciones * 0.5;
		return array( 'result' => number_format( $result, 1, '.', '' ) );
	}
	
	function mediafacilidad($node_id){
		$devuelve=$node_id;
		
		$db = eZDB::instance();
		$res= $db->arrayQuery( "SELECT facilidad as facilidad from valoraciones_productos where node_producto=". $devuelve. " and visible=1");
		$sum=0;
		$cuantos=count($res);
		foreach ($res as $fila){
			$sum += $fila['facilidad'];	
		}
			
		$media=$sum/$cuantos;
		$fracciones=intval($media/0.5);
		
		$result=$fracciones * 0.5;
		return array( 'result' => number_format( $result, 1, '.', '' ) );
	}

function muestraultimas($node_id){
		$devuelve=$node_id;
		
		$db = eZDB::instance();
		$res= $db->arrayQuery( "SELECT * from valoraciones_productos where node_producto=". $devuelve. " and visible=1 order by fecha desc limit 3");
		$result=$res;
		return array( 'result' => $result );
	}
function muestraaleatorio($node_id){
		$devuelve=$node_id;
		
		$db = eZDB::instance();
		$res= $db->arrayQuery( "SELECT * from valoraciones_productos where node_producto=". $devuelve. " and visible=1 ORDER BY RAND() desc limit 1");
		$result=$res;
		return array( 'result' => $result );
	}	


function calculaestrellas($node_id , $categoria, $n_estrellas){
		$db = eZDB::instance();
		$total=$this->cuantasvaloraciones($node_id);
		$res= $db->arrayQuery( "SELECT count(*) as cuantos from valoraciones_productos where node_producto=". $node_id. " and ".$categoria."=".$n_estrellas." and visible=1");
		$result['cuantos']=$res[0]['cuantos'];
		$result['media']=($res[0]['cuantos']/$total['result'])*100;
		return array( 'result' => $result );
	}	

function damevaloraciones($orden,$limite,$offset){
		$db = eZDB::instance();
		if (($limite==0)&&($offset==0)){
			$res= $db->arrayQuery( "SELECT * from valoraciones_productos order by ".$orden." ");
		}else{
			$res= $db->arrayQuery( "SELECT * from valoraciones_productos order by ".$orden." limit ".$offset.",".$limite."");
		}
		$result=$res;
		return array( 'result' => $result );
	}	




}

?>
