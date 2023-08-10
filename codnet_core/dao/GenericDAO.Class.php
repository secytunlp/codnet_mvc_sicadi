<?php

/**
 * DAO para Genérico
 *  
 * @author Bernardo
 * @since 05-03-2013
 */
abstract class GenericDAO {

	
	public abstract function getFieldsToAdd($entity);
	
	public abstract function getFieldsToUpdate($entity);
	
	public abstract function getId($entity);
	
	public abstract function getIdFieldName();
	
	public abstract function setId($entity, $id);
	
	public abstract function getTableName();
	
	public abstract function getEntityFactory();

	public function getEntitiesSQL(CdtSearchCriteria $oCriteria){
	
		$sql = "SELECT " . implode(", ", $this->getFieldsToSelect() );
        $sql .= " FROM " . $this->getFromToSelect() ;
        return $sql;	
		
	}
	
	public function getEntitiesCountSQL(CdtSearchCriteria $oCriteria){
		
		$sql = "SELECT count(*) as count";
        $sql .= " FROM " . $this->getFromToSelect() ;
        
        return $sql;
	}
	
	public function getFromToSelect(){
	
		return $this->getTableName();
	}
	
	public function getFieldsToSelect(){
		$fields = array();
		$fields[] = $this->getTableName() . ".*";
		return $fields;
	}
	
	
    /**
     * se persiste la nueva entity
     * @param $entity entity a persistir.
     */
    public function addEntity( $entity, $idConn=0 ) {
    	
        $db = CdtDbManager::getConnection($idConn);

        $fields = $this->getFieldsToAdd( $entity );
        
        $strFields = array();
        $strValues = array();
        foreach ($fields as $name => $value) {
        	$strFields[] = $name;
        	$strValues[] = $value;
        }
        
        $strFields = implode( ",", $strFields);
        $strValues = implode( ",", $strValues);
        
        $tableName = $this->getTableName();

        $sql = "INSERT INTO $tableName ( $strFields ) VALUES( $strValues )";

        CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());
        
        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());

        //seteamos el nuevo id.
        $id = $db->sql_nextid();
        $this->setId( $entity, $id );
    }

    /**
     * se modifica la entity
     * @param $entity entity a modificar.
     */
    public function updateEntity($entity, $idConn=0) {
        
    	$db = CdtDbManager::getConnection($idConn);

		$fields = $this->getFieldsToUpdate( $entity );
        
        $strFieldsValues = array();
        foreach ($fields as $name => $value) {
        	$strFieldsValues[] = $name . "=" . $value;
        }
        
        $strFieldsValues = implode( ",", $strFieldsValues);
        
        $tableName = $this->getTableName();
    	        
        $id = CdtFormatUtils::ifEmpty( $this->getId($entity), 'null');

        $tableName = $this->getTableName();

        $idName = $this->getIdFieldName();
        
        $sql = "UPDATE $tableName SET $strFieldsValues WHERE $idName = $id ";

        CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());
        
        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());
    }

    /**
     * se elimina la entity
     * @param $id identificador de la entity a eliminar.
     */
    public function deleteEntity($oid, $idConn=0) {
    	
        $db = CdtDbManager::getConnection( $idConn );

        $idName = $this->getIdFieldName();
        
        $tableName = $this->getTableName();

        $sql = "DELETE FROM $tableName WHERE $idName = $oid ";

        CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());
        
        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());
    }

    /**
     * se obtiene una colección de entities dado el filtro de búsqueda
     * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
     * @return ItemCollection
     */
    public function getEntities(CdtSearchCriteria $oCriteria, $idConn=0) {

        $db = CdtDbManager::getConnection( $idConn );

        $sql = $this->getEntitiesSQL($oCriteria);
                
        $sql .= $oCriteria->buildCriteria();

        CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());
        
        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());

        $items = CdtResultFactory::toCollection($db, $result, $this->getEntityFactory());
        $db->sql_freeresult($result);
        return $items;
    }

    /**
     * se obtiene la cantidad de entities dado el filtro de búsqueda
     * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
     * @return int
     */
    public function getEntitiesCount(CdtSearchCriteria $oCriteria, $idConn=0) {
        
    	$db = CdtDbManager::getConnection( $idConn );

        $sql = $this->getEntitiesCountSQL($oCriteria);

        $sql .= $oCriteria->buildCriteriaWithoutPaging();

        CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());
        
        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());

        $next = $db->sql_fetchassoc($result);
        $cant = $next['count'];
        $db->sql_freeresult($result);
        return ((int) $cant);
    }

    /**
     * se obtiene un entity dado el filtro de búsqueda
     * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
     * @return Entity
     */
    public function getEntity(CdtSearchCriteria $oCriteria, $idConn=0) {

        $db = CdtDbManager::getConnection( $idConn );

        $idName = $this->getIdFieldName();
        
        //para evitar ambigüedades de indentificador.
         $oCriteria->renameFilter("$idName", $this->getTableName() . ".$idName");
        
        $sql = $this->getEntitiesSQL($oCriteria);
        
        $sql .= $oCriteria->buildCriteria();

        CdtUtils::log($sql, __CLASS__,LoggerLevel::getLevelDebug());
        
        $result = $db->sql_query($sql);
        if (!$result)//hubo un error en la bbdd.
            throw new DBException($db->sql_error());

        if ($db->sql_numrows() > 0) {
            $temp = $db->sql_fetchassoc($result);
            $factory = $this->getEntityFactory();
            $obj = $factory->build($temp);
        }
        $db->sql_freeresult($result);
        return $obj;
    }

	public function formatString( $value ){
		$res = addslashes($value);
		return "'$res'";
	}
	
	public function formatIfNull( $value, $nullValue = "null"){
		return CdtFormatUtils::ifEmpty($value, $nullValue);
	}
	
	public function getEntityById($id) {
        $oCriteria = new CdtSearchCriteria();
        $idName = $this->getIdFieldName();
        $oCriteria->addFilter( $this->getTableName() . ".$idName", $id, "=");
        return self::getEntity($oCriteria);
    }

	public function formatDate( $value, $format = "Y-m-d H:i:s"){
		
		if(empty($value))
			return "null";
		
		$value = str_replace('/', '-', $value);
		$time = strtotime( $value );
		$res = $this->formatString( date( $format, $time) );
		
		CdtUtils::log("formatDate value $value, format $format, result $res", __CLASS__, LoggerLevel::getLevelDebug());
		
		return $res;
	}
    
}
?>
