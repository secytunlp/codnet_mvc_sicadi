<?php
/**
 * 
 * @author bernardo
 * @since 09-03-2010
 * 
 * Factory para pa�s.
 *
 */
class PaisFactory implements ObjectFactory{

	/**
	 * construye un pa�s. 
	 * @param $next
	 * @return unknown_type
	 */
	public function build($next){
		$oPais = new Pais();
		$oPais->setCd_pais( $next ['cd_pais'] );
		$oPais->setDs_pais( $next ['ds_pais'] );
		return $oPais;
	}
}
?>