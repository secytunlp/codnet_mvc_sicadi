<?php 

/** 
 * Factory para CdtUser
 *  
 * @author codnet archetype builder
 * @since 26-10-2011
 */ 
class CdtUserFactory implements ICdtObjectFactory{ 

	private $aliasUser;
	private $aliasUserGroup;
	
	public function CdtUserFactory( $aliasUser="", $aliasUserGroup=""){
		$this->setAliasUser( $aliasUser );
		$this->setAliasUserGroup( $aliasUserGroup );	
	} 
	public function build($next) { 

		$aliasUser = ($this->getAliasUser())? $this->getAliasUser() . "_" : "";
		$aliasUserGroup = ($this->getAliasUserGroup())? $this->getAliasUserGroup(). "_" : "";
		
		$oUser = new CdtUser();
		
		$oUser->setDs_username ( $next [$aliasUser . "ds_username"] );
		$oUser->setCd_user( $next [$aliasUser .'cd_user'] );
		$oUser->setCd_usergroup ( $next [$aliasUser .'cd_usergroup'] );
		$oUser->setDs_name ( $next [$aliasUser .'ds_name'] );
		$oUser->setDs_email ( $next [$aliasUser .'ds_email'] );
		$oUser->setDs_password ( $next [$aliasUser .'ds_password'] );
		$oUser->setDs_phone ( $next [$aliasUser .'ds_phone'] );
		$oUser->setDs_address ( $next [$aliasUser .'ds_address'] );
		$oUser->setDs_ips ( $next [$aliasUser .'ds_ips'] );
		$oUser->setNu_attemps( $next [$aliasUser .'nu_attemps'] );
		
		//para el caso que se hace el join con el usergroup.
		if(array_key_exists($aliasUserGroup .'ds_usergroup',$next)){
			
			$oFactory = new CdtUserGroupFactory( $this->getAliasUserGroup() );
			$oUser->setCdtUserGroup( $oFactory->build($next) );
		}
		
		return $oUser;
	}

	public function getAliasUser()
	{
	    return $this->aliasUser;
	}

	public function setAliasUser($aliasUser)
	{
	    $this->aliasUser = $aliasUser;
	}

	public function getAliasUserGroup()
	{
	    return $this->aliasUserGroup;
	}

	public function setAliasUserGroup($aliasUserGroup)
	{
	    $this->aliasUserGroup = $aliasUserGroup;
	}
} 
?>
