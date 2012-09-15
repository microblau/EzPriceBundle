<?php
class ezEflUtils
{
	function __construct()
	{
		
	}
	
	function notParent( $params )
	{		
		$sqlJoins = ' parent_node_id NOT IN ( ' . implode( ',', $params['excluded'] ) . ' ) AND ';
		
		return array( 'tables' => '', 'joins' => $sqlJoins );
	}
    
    function objectRelationFilterBuscador( $params )
    {
        // first optional param element could be either 'or' or 'and', deafult is 'and'
       if( $params[0] === 'or' || $params[0] === 'OR' || $params[0] === 'and' || $params[0] === 'AND' )
       {
           $matchAll = ( strtolower( array_shift( $params ) ) === 'and' );
       }
       else
       {
           $matchAll = true;
       }

       // remaining params are pairs of attribute id and related object id which should be matched.
       // related object id can also be an array, witch results in a 'or' fetch on those relations
       $i = 0;
       $sqlCondArray = array();
       while( isset( $params[1] ) )
       {
           $attributeId = array_shift( $params );

           $relatedobjectId = array_shift( $params );
           /*
           if ( !is_numeric( $attributeId ) )
           {
               $tempAttributeId = eZContentObjectTreeNode::classAttributeIDByIdentifier( $attributeId );
               if ( $tempAttributeId === false )
               {
                   eZDebug::writeError( 'Unknown attribute identifier: '. $attributeId, 'ObjectRelationFilter::createSqlParts()' );
                   return array( 'tables' => '', 'joins' => '', 'columns' => '' );
               }
               $attributeId = $tempAttributeId;
           }
*/
           if ( is_array( $relatedobjectId ) )
           {
                 
               $toCondition = "l$i.to_contentobject_id IN ( " . join( ', ', $relatedobjectId ) . " )";
           }
           else if ( is_numeric( $relatedobjectId ) )
           {
           
               $toCondition = "l$i.to_contentobject_id= $relatedobjectId";
           }
           else
           {
                
                eZDebug::writeError( 'Unknown relation id: '. $relatedobjectId . ' url: ' . $_SERVER['REQUEST_URI'], 'ObjectRelationFilter::createSqlParts()' );
                continue;
           }

           $subSelect = "SELECT from_contentobject_id
               FROM ezcontentobject_link l$i
               WHERE l$i.from_contentobject_id = ezcontentobject_tree.contentobject_id AND
                     l$i.from_contentobject_version = ezcontentobject_tree.contentobject_version AND ";
            $conditions = array();
            foreach( $attributeId as $attr )
            {
                $conditions[] = "l$i.contentclassattribute_id = $attr";
            }
            $subSelect .= "( " . implode( ' OR ', $conditions ) . " ) ";
            $subSelect .= "AND $toCondition";

           $sqlCondArray[] = "ezcontentobject_tree.contentobject_id IN ( $subSelect )";
           $i++;
       }

       if ( isset( $sqlCondArray[0] ) )
       {
           $joins = '( ' . join( $matchAll ? ' AND ' : ' OR ', $sqlCondArray ) . ' ) AND';
       }
       else
       {
           $joins = '';
       }

       //eZDebug::writeDebug( $joins );
       return array( 'tables' => '', 'joins' => $joins, 'columns' => '' );
   }
    
	

    function objectRelationFilterCustomized( $vars )
    {
        // first optional param element could be either 'or' or 'and', deafult is 'and'
       $params = $vars['filter'];
       if( $params[0] === 'or' || $params[0] === 'OR' || $params[0] === 'and' || $params[0] === 'AND' )
       {
           $matchAll = ( strtolower( array_shift( $params ) ) === 'and' );
       }
       else
       {
           $matchAll = true;
       }

       // remaining params are pairs of attribute id and related object id which should be matched.
       // related object id can also be an array, witch results in a 'or' fetch on those relations
       $i = 0;
       $sqlCondArray = array();
       while( isset( $params[1] ) )
       {
           $attributeId = array_shift( $params );
           $relatedobjectId = array_shift( $params );

           if ( !is_numeric( $attributeId ) )
           {
               $tempAttributeId = eZContentObjectTreeNode::classAttributeIDByIdentifier( $attributeId );
               if ( $tempAttributeId === false )
               {
                   eZDebug::writeError( 'Unknown attribute identifier: '. $attributeId, 'ObjectRelationFilter::createSqlParts()' );
                   return array( 'tables' => '', 'joins' => '', 'columns' => '' );
               }
               $attributeId = $tempAttributeId;
           }

           if ( is_array( $relatedobjectId ) )
           {
               $toCondition = "l$i.to_contentobject_id IN ( " . join( ', ', $relatedobjectId ) . " )";
           }
           else if ( is_numeric( $relatedobjectId ) )
           {
               $toCondition = "l$i.to_contentobject_id= $relatedobjectId";
           }
           else
           {
                eZDebug::writeError( 'Unknown relation id: '. $relatedobjectId . ' url: ' . $_SERVER['REQUEST_URI'], 'ObjectRelationFilter::createSqlParts()' );
                continue;
           }

           $subSelect = "SELECT from_contentobject_id
               FROM ezcontentobject_link l$i
               WHERE l$i.from_contentobject_id = ezcontentobject_tree.contentobject_id AND
                     l$i.from_contentobject_version = ezcontentobject_tree.contentobject_version AND
                     l$i.contentclassattribute_id = $attributeId AND
                     $toCondition";

           $sqlCondArray[] = "ezcontentobject_tree.contentobject_id IN ( $subSelect )";
           $i++;

       }

       $tables = ', ezcontentobject ezco2 LEFT JOIN ( SELECT contentobject_id, sort_key_int, version FROM ezcontentobject_attribute WHERE contentclassattribute_id IN (' . implode(',', $vars['order'] ) . ') ) t

on ezco2.id = t.contentobject_id AND ezco2.current_version = t.version';

       if ( isset( $sqlCondArray[0] ) )
       {
           $joins = '( ' . join( $matchAll ? ' AND ' : ' OR ', $sqlCondArray ) . ' ) AND';
       }
       else
       {
           $joins = '';
       }

       $joins .= ' ezco2.id = ezcontentobject.id AND ';

       //eZDebug::writeDebug( $joins );
      
       return array( 'tables' => $tables, 'joins' => $joins, 'columns' => '' );
    }
	
	function relatedTraining( $params )
	{
		
	  $sqlJoins =  "( ezcontentobject_tree.contentobject_id IN ( SELECT from_contentobject_id
               FROM ezcontentobject_link l0
               WHERE                    
                     l0.contentclassattribute_id IN( 446, 447) AND
                     l0.to_contentobject_id IN ( " . implode( ', ', $params["items"] ) . " ) ) ) AND "; 
		return array( 'tables' => $tables, 'joins' => $sqlJoins );
	}
	
	static function validateNIF( $nif )
	{
		$letra = substr("TRWAGMYFPDXBNJZSQVHLCKE",strtr( substr( $nif, 0, 8 ),"XYZ","012")%23,1);	
		return ( $letra == substr( $nif, 8, 1 ) );		
	}

	static function getTiposVia()
	{
		$db = eZDB::instance();
		return array( 'result' => $db->arrayQuery( 'SELECT clave, nombre FROM efl_tipos_via ORDER BY nombre' ) );
	}

    static function getProfesiones()
	{
		$db = eZDB::instance();
		return array( 'result' => $db->arrayQuery( 'SELECT COD_PROFESION1, DESCRIPCION FROM efl_profesiones ORDER BY DESCRIPCION' ) );
	}

    static function getCargos()
	{
		$db = eZDB::instance();
		return array( 'result' => $db->arrayQuery( 'SELECT CDFN, LBFN FROM efl_fn ORDER BY LBFN' ) );
	}

    static function getActividades()
	{
		$db = eZDB::instance();
		return array( 'result' => $db->arrayQuery( 'SELECT CD_ACTIV, LB_ACTIV FROM efl_activite ORDER BY LB_ACTIV' ) );
	}

    static function getAreas()
	{
		$db = eZDB::instance();
		return array( 'result' => $db->arrayQuery( 'SELECT CD_MAT, LB_MAT FROM efl_mat ORDER BY LB_MAT' ) );
	}
	
    static function getDepartamentos()
    {
        $db = eZDB::instance();
        return array( 'result' => $db->arrayQuery( 'SELECT CD_SVC, LB_SVC FROM efl_svc ORDER BY LB_SVC' ) );
    }
    
    static function getMaterias()
    {
        $db = eZDB::instance();
        return array( 'result' => $db->arrayQuery( 'SELECT CD_MAT, LB_MAT FROM efl_mat ORDER BY LB_MAT' ) );
    }
	
	static function getOrderInfo( $productcollection_id )
	{
		$object = eZPersistentObject::fetchObject( eflOrders::definition(), array( 'productcollection_id', 'order_serialized'), array( 'productcollection_id' => $productcollection_id ) );
		return array( 'result' => unserialize( $object->Order ) );
	}
	
	static function validateCIF( $str )
	{
    
    	//Copyright ©2005-2008 David Vidal Serra. Bajo licencia GNU GPL.
//Este software viene SIN NINGUN TIPO DE GARANTIA; para saber mas detalles
//puede consultar la licencia en http://www.gnu.org/licenses/gpl.txt(1)
//Esto es software libre, y puede ser usado y redistribuirdo de acuerdo
//con la condicion de que el autor jamas sera responsable de su uso.
//Returns: 1 = NIF ok, 2 = CIF ok, 3 = NIE ok, -1 = NIF bad, -2 = CIF bad, -3 = NIE bad, 0 = ??? bad
   $cif = strtoupper($str);
   for ($i = 0; $i < 9; $i ++)
      $num[$i] = substr($cif, $i, 1);
//si no tiene un formato valido devuelve error
   if (!ereg('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)', $cif))
      return 0;
//comprobacion de NIFs estandar
   if (ereg('(^[0-9]{8}[A-Z]{1}$)', $cif))
      if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1))
         return true;
      else
         return false;
//algoritmo para comprobacion de codigos tipo CIF
   $suma = $num[2] + $num[4] + $num[6];
   for ($i = 1; $i < 8; $i += 2)
      $suma += substr((2 * $num[$i]),0,1) + substr((2 * $num[$i]),1,1);
   $n = 10 - substr($suma, strlen($suma) - 1, 1);
//comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
   if (ereg('^[KLM]{1}', $cif))
      if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1))
         return true;
      else
         return false;
//comprobacion de CIFs
   if (ereg('^[ABCDEFGHJNPQRSUVW]{1}', $cif))
      if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1))
         return true;
      else
         return false;
//comprobacion de NIEs
   //T
   if (ereg('^[T]{1}', $cif))
      if ($num[8] == ereg('^[T]{1}[A-Z0-9]{8}$', $cif))
         return true;
      else
         return false;
   //XYZ
   if (ereg('^[XYZ]{1}', $cif))
      if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $cif), 0, 8) % 23, 1))
         return true;
      else
         return false;
//si todavia no se ha verificado devuelve error
   return false;
	}
	
	static function getDatosUsuario( $email )
	{
		$eflWS = new eflWS();
		$existsUser = $eflWS->existeUsuario( $email );
		$nombre = '';
		$apellido1 = '';
		$apellido2 = '';
		if(  $existsUser )
		{
			$usuario_empresa = $eflWS->getUsuarioCompleto( $existsUser );
			$usuario = $usuario_empresa->xpath( '//usuario' );
			$nombre  = $usuario[0]->nombre;
			$apellido1  = $usuario[0]->apellido1;
			$apellido2  = $usuario[0]->apellido2;
		}
		
		return array( 'result' =>  array( 'nombre' => (string)$nombre, 'apellido1' => (string)$apellido1, 'apellido2' => (string)$apellido2 ) );
	}
	
}
?>
