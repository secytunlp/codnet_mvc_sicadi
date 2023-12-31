<?php 

/** 
 * Factory para CdtUserGroupFunction
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserGroupFunctionFactory implements ICdtObjectFactory{

	private $aliasUserGroup;
	private $aliasFunction;
	
	public function CdtUserGroupFunctionFactory( $aliasUserGroup="", $aliasFunction="" ){
		$this->setAliasUserGroup( $aliasUserGroup );	
		$this->setAliasFunction( $aliasFunction );
	}
	
	public function build($next) { 
		
		$aliasFunction = ($this->getAliasFunction())? $this->getAliasFunction() . "_" : "";
		$aliasUserGroup = ($this->getAliasUserGroup())? $this->getAliasUserGroup(). "_" : "";
				
		$oCdtUserGroupFunction = new CdtUserGroupFunction();
		$oCdtUserGroupFunction->setCd_usergroup_function( $next [ CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUPFUNCTION] );
		$oCdtUserGroupFunction->setCd_usergroup ( $next [ $aliasUserGroup .CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP] );
		$oCdtUserGroupFunction->setCd_function( $next [ $aliasUserGroup .CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_FUNCTION] );
		
		//para el caso que se hace el join con el usergroup.
		if(array_key_exists($aliasUserGroup .CDT_SECURE_TABLE_CDTUSERGROUP_DS_USERGROUP,$next)){
			
			$oFactory = new CdtUserGroupFactory( $this->getAliasUserGroup() );
			$oCdtUserGroupFunction->setCdtUserGroup( $oFactory->build($next) );
		}

		//para el caso que se hace el join con function.
		if(array_key_exists($aliasFunction .CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION,$next)){
			
			$oFactory = new CdtFunctionFactory( $this->getAliasFunction() );
			$oCdtUserGroupFunction->setCdtFunction( $oFactory->build($next) );
		}
		
		return $oCdtUserGroupFunction;
	}

	public function getAliasUserGroup()
	{
	    return $this->aliasUserGroup;
	}

	public function setAliasUserGroup($aliasUserGroup)
	{
	    $this->aliasUserGroup = $aliasUserGroup;
	}

	public function getAliasFunction()
	{
	    return $this->aliasFunction;
	}

	public function setAliasFunction($aliasFunction)
	{
	    $this->aliasFunction = $aliasFunction;
	}
} 
?>
