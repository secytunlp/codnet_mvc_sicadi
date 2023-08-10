<?php 

/**
 * 
 * @author bernardo
 * @since 11-03-2010
 * 
 * Manejador de l�gica de negocio para provincias.
 *
 */
class LocalizacionManager{

	/**
	 * se listan localidades.
	 * @param $cd_provincia c�digo de provincia.
	 * @return itemCollection
	 */
	public function getLocalidadesPorProvincia($cd_provincia){

		$oProvincia = new Provincia();
		$oProvincia->setCd_provincia($cd_provincia);
		$localidades = LocalidadQuery::getLocalidadesDeProvincia($oProvincia);
				
		return $localidades;
	}
	
	/**
	 * obtiene una localidad espec�fica dado un identificador.
	 * @param $cd_localidad identificador de la localidad a recuperar 
	 * @return localidad
	 */
	public function getLocalidadPorId($cd_localidad){
		$oLocalidad = new Localidad ();
		$oLocalidad->setCd_localidad ( $cd_localidad);		
		$oLocalidad=LocalidadQuery::getLocalidadPorId( $oLocalidad );
		return $oLocalidad;
	}
	
	/**
	 * se listan provincias.
	 * @param $cd_pais c�digo de pa�s.
	 * @return itemCollection
	 */
	public function getProvinciasPorPais($cd_pais){

		$oPais = new Pais();
		$oPais->setCd_pais($cd_pais);
		$provincias = ProvinciaQuery::getProvinciasDePais($oPais);
				
		return $provincias;
	}
	
	/**
	 * obtiene una provincia espec�fica dado un identificador.
	 * @param $cd_provincia identificador de la provincia a recuperar 
	 * @return provincia
	 */
	public function getProvinciaPorId($cd_provincia){
		$oProvincia = new Provincia ();
		$oProvincia->setCd_provincia ( $cd_provincia);		
		$oProvincia=ProvinciaQuery::getProvinciaPorId( $oProvincia );
		return $oProvincia;
	}
	
	/**
	 * se listan paises.
	 * @return itemCollection
	 */
	public function getPaises(){
		//criterio de busqueda
		$criterio = new CriterioBusqueda();
		return PaisQuery::getPaises($criterio);
	}
	
	/**
	 * obtiene un pa�s espec�fico dado un identificador.
	 * @param $cd_pais identificador del pa�s a recuperar 
	 * @return pa�s
	 */
	public function getPaisPorId($cd_pais){
		$oPais = new Pais ();
		$oPais->setCd_pais ( $cd_pais);		
		$oPais=PaisQuery::getPaisPorId( $oPais );
		return $oPais;
	}
	
}