<?php 

/** 
 * DAO para CdtUserGroupFunction 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserGroupFunctionDAO implements ICdtUserGroupFunctionDAO{ 

	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtUserGroupFunctionDAO::addCdtUserGroupFunction()
	 */
	public function addCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 
		
		$db = CdtDbManager::getConnection(); 
		
		$cd_usergroup =  CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_usergroup(), 'null' );
		
		$cd_function =  CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_function(), 'null' );
		
		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP;
		$field_cd_function = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_FUNCTION;
				
		$sql = "INSERT INTO $tableName ($field_cd_usergroup, $field_cd_function) VALUES($cd_usergroup, $cd_function)"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtUserGroupFunction->setCd_usergroup_function( $cd );
	}


	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtUserGroupFunctionDAO::updateCdtUserGroupFunction()
	 */
	public function updateCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 

		$db = CdtDbManager::getConnection(); 

		
		$cd_usergroup_function = CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_usergroup_function(), 'null' );
		
		$cd_usergroup = CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_usergroup(), 'null' );
		
		$cd_function = CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_function(), 'null' );
		

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$field_cd_usergroupfunction = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUPFUNCTION;
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP;
		$field_cd_function = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_FUNCTION;
				
		$sql = "UPDATE $tableName SET $field_cd_usergroup = $cd_usergroup, 
									$field_cd_function = $cd_function WHERE $field_cd_usergroupfunction= $cd_usergroup_function "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtUserGroupFunctionDAO::deleteCdtUserGroupFunction()
	 */
	public function deleteCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 
		
		$db = CdtDbManager::getConnection(); 

		$cd_usergroup_function = $oCdtUserGroupFunction->getCd_usergroup_function();

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$field_cd_usergroupfunction = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUPFUNCTION;
		
		$sql = "DELETE FROM $tableName WHERE $field_cd_usergroupfunction = $cd_usergroup_function "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtUserGroupFunctionDAO::getCdtUserGroupFunctions()
	 */
	public function getCdtUserGroupFunctions(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP;
		$field_cd_function = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_FUNCTION;
		
		$usergroup_field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_CD_USERGROUP;
		$usergroup_field_ds_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_DS_USERGROUP;
		
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		$function_field_ds_function = CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION;
		
		$sql = "SELECT UGF.* ";
		$sql .= ", UG.$usergroup_field_cd_usergroup as UG_cd_usergroup, UG.$usergroup_field_ds_usergroup as UG_ds_usergroup ";
		$sql .= ", F.$function_field_cd_function as F_cd_function, F.$function_field_ds_function as F_ds_function ";
		$sql .= " FROM $tableName UGF ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.$usergroup_field_cd_usergroup=UGF.$field_cd_usergroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=UGF.$field_cd_function) ";
		
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtUserGroupFunctionFactory("UG", "F"));
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtUserGroupFunctionDAO::getCdtUserGroupFunctionsCount()
	 */
	public function getCdtUserGroupFunctionsCount(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		
		 
		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP;
		$field_cd_function = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_FUNCTION;
		
		$usergroup_field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_CD_USERGROUP;
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		
		
		$sql = "SELECT count(*) as count FROM $tableName UGF ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.$usergroup_field_cd_usergroup=UGF.$field_cd_usergroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=UGF.$field_cd_function) ";
		
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
	 * @see dao/ICdtUserGroupFunctionDAO::getCdtUserGroupFunction()
	 */
	public function getCdtUserGroupFunction(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP;
		$field_cd_function = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_FUNCTION;
		
		$usergroup_field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_CD_USERGROUP;
		$usergroup_field_ds_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_DS_USERGROUP;
		
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		$function_field_ds_function = CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION;
		
		$sql = "SELECT UGF.* ";
		$sql .= ", UG.$usergroup_field_cd_usergroup as UG_cd_usergroup, UG.$usergroup_field_ds_usergroupas UG_ds_usergroup ";
		$sql .= ", F.$function_field_cd_function as F_cd_function, F.$function_field_ds_function as F_ds_function ";
		$sql .= " FROM $tableName UGF ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.$usergroup_field_cd_usergroup=UGF.$field_cd_usergroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=UGF.$field_cd_function) ";
		
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtUserGroupFunctionFactory("UG","F");
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

	/**
	 * (non-PHPdoc)
	 * @see dao/ICdtUserGroupFunctionDAO::deleteCdtUserGroupFunctions()
	 */
	public function deleteCdtUserGroupFunctions(CdtUserGroup $oCdtUserGroup) { 
		$db = CdtDbManager::getConnection(); 

		$cd_usergroup = $oCdtUserGroup->getCd_usergroup();

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP;
		
		$sql = "DELETE FROM $tableName WHERE $field_cd_usergroup = $cd_usergroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}
	
} 
?>
