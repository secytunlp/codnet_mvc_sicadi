<?php 

/** 
 * DAO para CdtRegistration 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtRegistrationDAO implements ICdtRegistrationDAO{ 

	/**
	 * se persiste la nueva entity 
	 * @param CdtRegistration $oCdtRegistration entity a persistir.
	 */
	public function addCdtRegistration(CdtRegistration $oCdtRegistration) { 

		$db = CdtDbManager::getConnection(); 
		
		$ds_activationcode = $oCdtRegistration->getDs_activationcode();
		
		$dt_date = $oCdtRegistration->getDt_date();
		
		$ds_username = $oCdtRegistration->getDs_username();
		
		$ds_name = $oCdtRegistration->getDs_name();
		
		$ds_email = $oCdtRegistration->getDs_email();
		
		$ds_password = $oCdtRegistration->getDs_password();
		
		$ds_phone = $oCdtRegistration->getDs_phone();
		
		$ds_address = $oCdtRegistration->getDs_address();
		
		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		$field_ds_activationdate = CDT_SECURE_TABLE_CDTREGISTRATION_DS_ACTIVATIONCODE;
		$field_dt_date = CDT_SECURE_TABLE_CDTREGISTRATION_DT_DATE;
		$field_ds_username = CDT_SECURE_TABLE_CDTREGISTRATION_DS_USERNAME;
		$field_ds_name = CDT_SECURE_TABLE_CDTREGISTRATION_DS_NAME;
		$field_ds_email = CDT_SECURE_TABLE_CDTREGISTRATION_DS_EMAIL;
		$field_ds_password = CDT_SECURE_TABLE_CDTREGISTRATION_DS_PASSWORD;
		$field_ds_phone = CDT_SECURE_TABLE_CDTREGISTRATION_DS_PHONE;
		$field_ds_address = CDT_SECURE_TABLE_CDTREGISTRATION_DS_ADDRESS;
		
		$sql = "INSERT INTO $tableName ($field_ds_activationdate, 
										$field_dt_date, 
										$field_ds_username, 
										$field_ds_name, 
										$field_ds_email, 
										$field_ds_password, 
										$field_ds_phone, 
										$field_ds_address) VALUES('$ds_activationcode', '$dt_date', '$ds_username', '$ds_name', '$ds_email', '$ds_password', '$ds_phone', '$ds_address')"; 

		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

			
		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtRegistration->setCd_registration( $cd );
        
	}


	/**
	 * se modifica la entity
	 * @param CdtRegistration $oCdtRegistration entity a modificar.
	 */
	public function updateCdtRegistration(CdtRegistration $oCdtRegistration) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_activationcode = $oCdtRegistration->getDs_activationcode();
		
		$dt_date = $oCdtRegistration->getDt_date();
		
		$ds_username = $oCdtRegistration->getDs_username();
		
		$ds_name = $oCdtRegistration->getDs_name();
		
		$ds_email = $oCdtRegistration->getDs_email();
		
		$ds_password = $oCdtRegistration->getDs_password();
		
		$ds_phone = $oCdtRegistration->getDs_phone();
		
		$ds_address = $oCdtRegistration->getDs_address();
		
		$cd_registration = CdtFormatUtils::ifEmpty( $oCdtRegistration->getCd_registration(), 'null' );
		
		
		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		$field_cd_registration = CDT_SECURE_TABLE_CDTREGISTRATION_CD_REGISTRATION;
		$field_ds_activationdate = CDT_SECURE_TABLE_CDTREGISTRATION_DS_ACTIVATIONCODE;
		$field_dt_date = CDT_SECURE_TABLE_CDTREGISTRATION_DT_DATE;
		$field_ds_username = CDT_SECURE_TABLE_CDTREGISTRATION_DS_USERNAME;
		$field_ds_name = CDT_SECURE_TABLE_CDTREGISTRATION_DS_NAME;
		$field_ds_email = CDT_SECURE_TABLE_CDTREGISTRATION_DS_EMAIL;
		$field_ds_password = CDT_SECURE_TABLE_CDTREGISTRATION_DS_PASSWORD;
		$field_ds_phone = CDT_SECURE_TABLE_CDTREGISTRATION_DS_PHONE;
		$field_ds_address = CDT_SECURE_TABLE_CDTREGISTRATION_DS_ADDRESS;
		
		$sql = "UPDATE $tableName SET $field_ds_activationdate = '$ds_activationcode', 
										$field_dt_date = '$dt_date', 
										$field_ds_username = '$ds_username', 
										$field_ds_name = '$ds_name', 
										$field_ds_email = '$ds_email', 
										$field_ds_password = '$ds_password', 
										$field_ds_phone = '$ds_phone', 
										$field_ds_address = '$ds_address' WHERE $field_cd_registration = $cd_registration "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtRegistration $oCdtRegistration entity a eliminar.
	 */
	public function deleteCdtRegistration(CdtRegistration $oCdtRegistration) { 
		$db = CdtDbManager::getConnection(); 

		$cd_registration = $oCdtRegistration->getCd_registration();

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		$field_cd_registration = CDT_SECURE_TABLE_CDTREGISTRATION_CD_REGISTRATION;
		
		$sql = "DELETE FROM $tableName WHERE $field_cd_registration = $cd_registration "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtRegistration]
	 */
	public function getCdtRegistrations(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;

		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtRegistrationFactory());
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public function getCdtRegistrationsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		
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
	 * @return CdtRegistration
	 */
	public function getCdtRegistration(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		
		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtRegistrationFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
