<?php
/**
 * Opci�n de men� con una funci�n asociada
 * para ser segurizado.
 * 
 * @author bernardo
 * @since 23-06-2010
 *
 */
class MenuSecureOption extends MenuOption{
	
	private $oFuncion;

	//M�todo constructor 
	
	function MenuSecureOption(Funcion $oFunction=null, $nombre='', $href='#', $activo=false) {
		$this->setNombre( $nombre );
		$this->setHref( $href );
		$this->setBl_activo( $activo );
		$this->setMenuGroup( new MenuGroup() );
		if(isset( $oFunction ))
			$this->setFuncion( $oFunction );
	}
	
	//M�todos Get 
	
	function getFuncion() {
		return $this->oFuncion;
	}
		
	//M�todos Set 
	
	function setFuncion(Funcion $value) {
		$this->oFuncion = $value;
	}
	
	/**
	 * dada una lista de funciones, se determina si se tiene acceso o no
	 * a la opci�n de men�.
	 * @param $funciones
	 */
	function tieneAcceso( ItemCollection $funciones = null  ){
		if( $funciones != null)
		return $funciones->existObject( $this->getFuncion() );
		else 
		return false;
	}	
}

