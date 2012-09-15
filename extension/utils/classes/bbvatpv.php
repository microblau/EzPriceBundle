<?php
/*****************************************************
/** @Author: Ricard Catalan
/** @return: pal_sec
/** Clase usada para devolver la palabra desofuscada
/****************************************************/
class Desofuscar
{
    private $pal_sec_ofuscada;
    private $clave_xor;
    private $cad1_0 = "0";
    private $cad2_0 = "00";
    private $cad3_0 = "000";
    private $cad4_0 = "0000";
    private $cad5_0 = "00000";
    private $cad6_0 = "000000";
    private $cad7_0 = "0000000";
    private $cad8_0 = "00000000";
    private $pal_sec = "";
    
    public function __construct( $ofuscada, $clave, $idcomercio )
    {
        $this->pal_sec_ofuscada = $ofuscada;
        $this->clave_xor = $clave . substr($idcomercio,0,9) . '***';
        $this->Desofuscar(); //Desofuscamos
    }
    
    private function Desofuscar()
    {
        $trozos = explode( ";", $pal_sec_ofuscada );
        $tope = count( $trozos );
        $res = "";
        for ( $i=0; $i<$tope; $i++ )
        {
            $x1 = ord( $clave_xor[$i] );
            $x2 = hexdec( $trozos[$i] );
            $r = $x1 ^ $x2;
            $res .= chr($r);
        }
        $this->pal_sec = $res;
    }
    
    public function getDesofuscar()
    {
        return $this->pal_sec;
    }    
    
}
?>