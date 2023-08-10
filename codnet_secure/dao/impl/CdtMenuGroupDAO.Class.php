<?php 

/** 
 * DAO para CdtMenuGroup 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtMenuGroupDAO implements ICdtMenuGroupDAO{ 

	/**
	 * se persiste la nueva entity
	 * @param CdtMenuGroup $oCdtMenuGroup entity a persistir.
	 */
	public function addCdtMenuGroup(CdtMenuGroup $oCdtMenuGroup) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_name = $oCdtMenuGroup->getDs_name();
		
		$ds_action = $oCdtMenuGroup->getDs_action();
		
		$ds_cssclass = $oCdtMenuGroup->getDs_cssclass();
		
		$nu_order =  CdtFormatUtils::ifEmpty( $oCdtMenuGroup->getNu_order(), 'null' );
		
		$nu_width =  CdtFormatUtils::ifEmpty( $oCdtMenuGroup->getNu_width(), 'null' );
		
		
		$tableName = CDT_SECURE_TABLE_CDTMENUGROUP;
		$field_ds_name = CDT_SECURE_TABLE_CDTMENUGROUP_DS_NAME;
		$field_ds_action = CDT_SECURE_TABLE_CDTMENUGROUP_DS_ACTION;
		$field_ds_cssclass = CDT_SECURE_TABLE_CDTMENUGROUP_DS_CSSCLASS;
		$field_nu_order = CDT_SECURE_TABLE_CDTMENUGROUP_NU_ORDER;
		$field_nu_width = CDT_SECURE_TABLE_CDTMENUGROUP_NU_WIDTH;
		
		$sql = "INSERT INTO $tableName ($field_nu_order, $field_nu_width, $field_ds_name, $field_ds_action, $field_ds_cssclass) VALUES($nu_order, $nu_width, '$ds_name', '$ds_action', '$ds_cssclass')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtMenuGroup->setCd_menugroup( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtMenuGroup $oCdtMenuGroup entity a modificar.
	 */
	public function updateCdtMenuGroup(CdtMenuGroup $oCdtMenuGroup) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_name = $oCdtMenuGroup->getDs_name();
		
		$ds_action = $oCdtMenuGroup->getDs_action();
		
		$ds_cssclass = $oCdtMenuGroup->getDs_cssclass();
		
		
		$cd_menugroup = CdtFormatUtils::ifEmpty( $oCdtMenuGroup->getCd_menugroup(), 'null' );
		
		$nu_order = CdtFormatUtils::ifEmpty( $oCdtMenuGroup->getNu_order(), 'null' );
		
		$nu_width = CdtFormatUtils::ifEmpty( $oCdtMenuGroup->getNu_width(), 'null' );
		
		

		$tableName = CDT_SECURE_TABLE_CDTMENUGROUP;
		$field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUGROUP_CD_MENUGROUP;
		$field_ds_name = CDT_SECURE_TABLE_CDTMENUGROUP_DS_NAME;
		$field_ds_action = CDT_SECURE_TABLE_CDTMENUGROUP_DS_ACTION;
		$field_ds_cssclass = CDT_SECURE_TABLE_CDTMENUGROUP_DS_CSSCLASS;
		$field_nu_order = CDT_SECURE_TABLE_CDTMENUGROUP_NU_ORDER;
		$field_nu_width = CDT_SECURE_TABLE_CDTMENUGROUP_NU_WIDTH;
				
		$sql = "UPDATE $tableName SET $field_nu_order = $nu_order, $field_nu_width = $nu_width, $field_ds_name = '$ds_name', $field_ds_action = '$ds_action', $field_ds_cssclass = '$ds_cssclass' WHERE $field_cd_menugroup = $cd_menugroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtMenuGroup $oCdtMenuGroup entity a eliminar.
	 */
	public function deleteCdtMenuGroup(CdtMenuGroup $oCdtMenuGroup) { 
		$db = CdtDbManager::getConnection(); 

		$cd_menugroup = $oCdtMenuGroup->getCd_menugroup();

		$tableName = CDT_SECURE_TABLE_CDTMENUGROUP;
		$field_cd_menugroup = CDT_SECURE_TABLE_CDTMENUGROUP_CD_MENUGROUP;
		
		$sql = "DELETE FROM $tableName WHERE $field_cd_menugroup = $cd_menugroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtMenuGroup]
	 */
	public function getCdtMenuGroups(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUGROUP;

		$sql = "SELECT * FROM $tableName ";
		//TODO left joins
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtMenuGroupFactory());
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public function getCdtMenuGroupsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUGROUP;
		
		$sql = "SELECT count(*) as count FROM $tableName "; 
		//TODO left joins
		
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
	 * @return CdtMenuGroup
	 */
	public function getCdtMenuGroup(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUGROUP;
		
		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtMenuGroupFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>