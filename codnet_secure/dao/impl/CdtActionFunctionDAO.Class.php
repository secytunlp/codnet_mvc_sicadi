<?php 

/** 
 * DAO para CdtActionFunction 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtActionFunctionDAO implements ICdtActionFunctionDAO{ 

	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtActionFunctionDAO::addCdtActionFunction()
	 */
	public function addCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 

		$db = CdtDbManager::getConnection(); 

		$ds_action = $oCdtActionFunction->getDs_action();
		
		$cd_function =  CdtFormatUtils::ifEmpty( $oCdtActionFunction->getCd_function(), 'null' );
		
		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$field_cd_function = CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_FUNCTION;
		$field_ds_action = CDT_SECURE_TABLE_CDTACTIONFUNCTION_DS_ACTION;
		
		$sql = "INSERT INTO $tableName ( $field_cd_function , $field_ds_action) VALUES($cd_function, '$ds_action')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtActionFunction->setCd_actionfunction( $cd );
	}

	
	
	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtActionFunctionDAO::updateCdtActionFunction()
	 */
	public function updateCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 
		
		$db = CdtDbManager::getConnection(); 

		
		$ds_action = $oCdtActionFunction->getDs_action();
		
		$cd_actionfunction = CdtFormatUtils::ifEmpty( $oCdtActionFunction->getCd_actionfunction(), 'null' );
		
		$cd_function = CdtFormatUtils::ifEmpty( $oCdtActionFunction->getCd_function(), 'null' );
		
		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$field_cd_actionfunction = CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_ACTIONFUNCTION;
		$field_cd_function = CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_FUNCTION;
		$field_ds_action = CDT_SECURE_TABLE_CDTACTIONFUNCTION_DS_ACTION;
		
		$sql = "UPDATE $tableName SET $field_cd_function = $cd_function, $field_ds_action = '$ds_action' WHERE $field_cd_actionfunction = $cd_actionfunction "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtActionFunctionDAO::deleteCdtActionFunction()
	 */
	public function deleteCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 

		$db = CdtDbManager::getConnection(); 

		$cd_actionfunction = $oCdtActionFunction->getCd_actionfunction();

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$field_cd_actionfunction = CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_ACTIONFUNCTION;
		
		$sql = "DELETE FROM $tableName WHERE $field_cd_actionfunction = $cd_actionfunction "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtActionFunctionDAO::getCdtActionFunctions()
	 */
	public function getCdtActionFunctions(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;

		$actionfunction_field_cd_function = CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_FUNCTION;
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		$function_field_ds_function = CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION;
		
		$sql = "SELECT AF.* ";
		$sql .= ", F.$function_field_cd_function as F_cd_function, F.$function_field_ds_function as F_ds_function ";
		$sql .= " FROM $tableName AF ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=AF.$actionfunction_field_cd_function) ";
		
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtActionFunctionFactory("F"));
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtActionFunctionDAO::getCdtActionFunctionsCount()
	 */
	public function getCdtActionFunctionsCount(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;

		$actionfunction_field_cd_function = CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_FUNCTION;
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		
		$sql = "SELECT count(*) as count "; 
		$sql .= " FROM $tableName AF ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=AF.$actionfunction_field_cd_function) ";
		
		$sql .= $oCriteria->buildCriteriaWithoutPaging();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$next = $db->sql_fetchassoc($result);
		$cant = $next['count'];
		$db->sql_freeresult($result);
		return ((int) $cant);
	}


	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtActionFunctionDAO::getCdtActionFunction()
	 */
	public function getCdtActionFunction(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$actionfunction_field_cd_function = CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_FUNCTION;
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		$function_field_ds_function = CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION;
		
		$sql = "SELECT AF.* ";
		$sql .= ", F.$function_field_cd_function as F_cd_function, F.$function_field_ds_function as F_ds_function ";
		$sql .= " FROM $tableName AF ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=AF.$actionfunction_field_cd_function) ";
		
		
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtActionFunctionFactory("F");
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>