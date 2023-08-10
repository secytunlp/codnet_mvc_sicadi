<?php 

/** 
 * DAO para CdtMenuOption 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtMenuOptionDAO implements ICdtMenuOptionDAO{ 

	/**
	 * se persiste la nueva entity
	 * @param CdtMenuOption $oCdtMenuOption entity a persistir.
	 */
	public function addCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_name = $oCdtMenuOption->getDs_name();
		
		$ds_href = $oCdtMenuOption->getDs_href();
		
		$ds_cssclass = $oCdtMenuOption->getDs_cssclass();
		
		$ds_description = $oCdtMenuOption->getDs_description();
		
		
		$cd_function =  CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_function(), 'null' );
		
		$nu_order =  CdtFormatUtils::ifEmpty( $oCdtMenuOption->getNu_order(), 'null' );
		
		$cd_menugroup =  CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_menugroup(), 'null' );
		
		
		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$field_ds_name = CDT_SECURE_TABLE_CDTMENUOPTION_DS_NAME;
		$field_ds_href = CDT_SECURE_TABLE_CDTMENUOPTION_DS_HREF;
		$field_cd_function = CDT_SECURE_TABLE_CDTMENUOPTION_CD_FUNCTION;
		$field_nu_order = CDT_SECURE_TABLE_CDTMENUOPTION_NU_ORDER;
		$field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUGROUP;
		$field_ds_cssclass = CDT_SECURE_TABLE_CDTMENUOPTION_DS_CSSCLASS;
		$field_ds_description = CDT_SECURE_TABLE_CDTMENUOPTION_DS_DESCRIPTION;
		
		$sql = "INSERT INTO $tableName ($field_ds_name, $field_ds_href, $field_cd_function, $field_nu_order, $field_cd_menugroup, $field_ds_cssclass, $field_ds_description) VALUES('$ds_name', '$ds_href', $cd_function, $nu_order, $cd_menugroup, '$ds_cssclass', '$ds_description')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtMenuOption->setCd_menuoption( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtMenuOption $oCdtMenuOption entity a modificar.
	 */
	public function updateCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 

		$db = CdtDbManager::getConnection(); 
		
		$ds_name = $oCdtMenuOption->getDs_name();
		
		$ds_href = $oCdtMenuOption->getDs_href();
		
		$ds_cssclass = $oCdtMenuOption->getDs_cssclass();
		
		$ds_description = $oCdtMenuOption->getDs_description();
		
		$cd_menuoption = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_menuoption(), 'null' );
		
		$cd_function = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_function(), 'null' );
		
		$nu_order = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getNu_order(), 'null' );
		
		$cd_menugroup = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_menugroup(), 'null' );
		
		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$field_cd_menuoption = CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUOPTION;
		$field_ds_name = CDT_SECURE_TABLE_CDTMENUOPTION_DS_NAME;
		$field_ds_href = CDT_SECURE_TABLE_CDTMENUOPTION_DS_HREF;
		$field_cd_function = CDT_SECURE_TABLE_CDTMENUOPTION_CD_FUNCTION;
		$field_nu_order = CDT_SECURE_TABLE_CDTMENUOPTION_NU_ORDER;
		$field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUGROUP;
		$field_ds_cssclass = CDT_SECURE_TABLE_CDTMENUOPTION_DS_CSSCLASS;
		$field_ds_description = CDT_SECURE_TABLE_CDTMENUOPTION_DS_DESCRIPTION;
		
		$sql = "UPDATE $tableName SET $field_ds_name = '$ds_name', $field_ds_href = '$ds_href', $field_cd_function = $cd_function, $field_nu_order = $nu_order, $field_cd_menugroup = $cd_menugroup, $field_ds_cssclass = '$ds_cssclass', $field_ds_description = '$ds_description' WHERE $field_cd_menuoption = $cd_menuoption "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtMenuOption $oCdtMenuOption entity a eliminar.
	 */
	public function deleteCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 
		$db = CdtDbManager::getConnection(); 

		$cd_menuoption = $oCdtMenuOption->getCd_menuoption();

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$field_cd_menuoption = CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUOPTION;
		
		$sql = "DELETE FROM $tableName WHERE $field_cd_menuoption = $cd_menuoption "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtMenuOption]
	 */
	public function getCdtMenuOptions(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$tableNameMenuGroup = CDT_SECURE_TABLE_CDTMENUGROUP;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$menuoption_field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUGROUP;
		$menuoption_field_cd_function = CDT_SECURE_TABLE_CDTMENUOPTION_CD_FUNCTION;
		
		$menugroup_field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUGROUP_CD_MENUGROUP;
		$menugroup_field_ds_name = CDT_SECURE_TABLE_CDTMENUGROUP_DS_NAME;
		
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		$function_field_ds_function = CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION;
		
		$sql  = "SELECT MO.* ";
		$sql .= ", MG.$menugroup_field_cd_menugroup as MG_cd_menugroup, MG.$menugroup_field_ds_name as MG_ds_name ";
		$sql .= ", F.$function_field_cd_function as F_cd_function, F.$function_field_ds_function as F_ds_function ";
		$sql .= " FROM $tableName MO ";
		$sql .= " LEFT JOIN $tableNameMenuGroup MG ON(MG.$menugroup_field_cd_menugroup=MO.$menuoption_field_cd_menugroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=MO.$menuoption_field_cd_function) ";
		
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtMenuOptionFactory("", "MG", "F"));
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public function getCdtMenuOptionsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$tableNameMenuGroup = CDT_SECURE_TABLE_CDTMENUGROUP;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;

		$menuoption_field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUGROUP;
		$menuoption_field_cd_function = CDT_SECURE_TABLE_CDTMENUOPTION_CD_FUNCTION;
		
		$menugroup_field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUGROUP_CD_MENUGROUP;
		
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		
		$sql = "SELECT count(*) as count  FROM $tableName MO";
		$sql .= " LEFT JOIN $tableNameMenuGroup MG ON(MG.$menugroup_field_cd_menugroup=MO.$menuoption_field_cd_menugroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=MO.$menuoption_field_cd_function) ";
		
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
	 * se obtiene un entity dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return CdtMenuOption
	 */
	public function getCdtMenuOption(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$tableNameMenuGroup = CDT_SECURE_TABLE_CDTMENUGROUP;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$menuoption_field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUGROUP;
		$menuoption_field_cd_function = CDT_SECURE_TABLE_CDTMENUOPTION_CD_FUNCTION;
		
		$menugroup_field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUGROUP_CD_MENUGROUP;
		$menugroup_field_ds_name = CDT_SECURE_TABLE_CDTMENUGROUP_DS_NAME;
		
		$function_field_cd_function = CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION;
		$function_field_ds_function = CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION;
		
		$sql  = "SELECT MO.* ";
		$sql .= ", MG.$menugroup_field_cd_menugroup as MG_cd_menugroup, MG.$menugroup_field_ds_name as MG_ds_name ";
		$sql .= ", F.$function_field_cd_function as F_cd_function, F.$function_field_ds_function as F_ds_function ";
		$sql .= " FROM $tableName MO ";
		$sql .= " LEFT JOIN $tableNameMenuGroup MG ON(MG.$menugroup_field_cd_menugroup=MO.$menuoption_field_cd_menugroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.$function_field_cd_function=MO.$menuoption_field_cd_function) ";
				
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtMenuOptionFactory("", "MG","F");
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
