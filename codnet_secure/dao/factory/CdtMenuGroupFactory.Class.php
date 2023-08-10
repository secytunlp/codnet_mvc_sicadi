<?php 

/** 
 * Factory para CdtMenuGroup
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtMenuGroupFactory implements ICdtObjectFactory{ 

	private $aliasMenuGroup;
	
	public function __construct( $aliasMenuGroup=""){
		$this->setAliasMenuGroup( $aliasMenuGroup );
	} 
	
	public function build($next) { 

		$aliasMenuGroup = ($this->getAliasMenuGroup())? $this->getAliasMenuGroup(). "_" : "";
		
		$oCdtMenuGroup  = new CdtMenuGroup();

		$oCdtMenuGroup->setCd_menugroup( $next[$aliasMenuGroup . "cd_menugroup"] );
		$oCdtMenuGroup->setDs_action( $next[$aliasMenuGroup . "ds_action"] );
		$oCdtMenuGroup->setDs_cssclass( $next[$aliasMenuGroup . "ds_cssclass"] );
		$oCdtMenuGroup->setDs_name( $next[$aliasMenuGroup . "ds_name"] );
		$oCdtMenuGroup->setNu_order( $next[$aliasMenuGroup . "nu_order"] );
		$oCdtMenuGroup->setNu_width( $next[$aliasMenuGroup . "nu_width"] );
		
		return $oCdtMenuGroup;
	}


	public function getAliasMenuGroup()
	{
	    return $this->aliasMenuGroup;
	}

	public function setAliasMenuGroup($aliasMenuGroup)
	{
	    $this->aliasMenuGroup = $aliasMenuGroup;
	}
}
?>
