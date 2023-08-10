<?php 

/** 
 * DAO para CdtUserGroup 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserGroupDAO implements ICdtUserGroupDAO { 

	/**
	 * se persiste la nueva entity
	 * @param CdtUserGroup $oCdtUserGroup entity a persistir.
	 */
	public function addCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		$db = CdtDbManager::getConnection(); 

		$ds_usergroup = $oCdtUserGroup->getDs_usergroup();
		
		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		$field_ds_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_DS_USERGROUP;
				
		$sql = "INSERT INTO $tableName ($field_ds_usergroup) VALUES('$ds_usergroup')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtUserGroup->setCd_usergroup( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtUserGroup $oCdtUserGroup entity a modificar.
	 */
	public function updateCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		
		$db = CdtDbManager::getConnection(); 

		$ds_usergroup = $oCdtUserGroup->getDs_usergroup();
		
		$cd_usergroup = CdtFormatUtils::ifEmpty( $oCdtUserGroup->getCd_usergroup(), 'null' );
		
		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_CD_USERGROUP;
		$field_ds_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_DS_USERGROUP;
		
		$sql = "UPDATE $tableName SET $field_ds_usergroup = '$ds_usergroup' WHERE $field_cd_usergroup = $cd_usergroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtUserGroup $oCdtUserGroup entity a eliminar.
	 */
	public function deleteCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		
		$db = CdtDbManager::getConnection(); 

		$cd_usergroup = $oCdtUserGroup->getCd_usergroup();

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		$field_cd_usergroup = CDT_SECURE_TABLE_CDTUSERGROUP_CD_USERGROUP;
		
		$sql = "DELETE FROM $tableName WHERE $field_cd_usergroup = $cd_usergroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtUserGroup]
	 */
	public function getCdtUserGroups(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;

		$sql = "SELECT * FROM $tableName ";
		
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtUserGroupFactory());
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public function getCdtUserGroupsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "SELECT count(*) as count FROM $tableName "; 
		
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
	 * @return CdtUserGroup
	 */
	public function getCdtUserGroup(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtUserGroupFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>