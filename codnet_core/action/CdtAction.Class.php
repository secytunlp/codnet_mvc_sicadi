<?php 

/**
 * 
 * Las acciones son disparadas por el actionController 
 * a partir de las peticiones (request).
 * Cada acci�n est� destinada a realizar una tarea
 * espec�fica en la aplicaci�n. Tambi�n decide el destino
 * posible de acuerdo al resultado obtenido (forward).
 * 
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 03-03-2010
 */
abstract class CdtAction{

	//par�metros utilizados para el forward.
	private $ds_forward_params=null;

		
	//M�todos Get 
	
	public function getDs_forward_params(){
		return $this->ds_forward_params;
	}
	
		
	//M�todos Set 
	
	public function setDs_forward_params($value){
		$this->ds_forward_params = $value;
	}
	
	//Funciones.
	
	/**
	 * Se ejecuta la acci�n.
	 * Cada acci�n concreta implementar� una funcionalidad espec�fica.
	 * 
	 * @return forward indica el camino a seguir.
	 * @throws GenericException excepci�n gen�ria ante alguna posible falla.
	 */
	public abstract function execute();

	/**
	 * Ante una falla se lanza una forward por excepci�n. 
	 * @param GenericException $ex excepci�n que indica el fallo
	 * @param string $forward el camino a seguir
	 * @throws FailureException excepci�n por fallo
	 * @deprecated
	 */
	protected function doForwardException(GenericException $ex, $forward){
		
		$map = new CdtActionMapHelper();
		$ds_forward = $map->getForward( $forward );
		
		$pos_accion = strpos( $ds_forward, "action" );
		
		if( $pos_accion  )
			$ds_actionName = CdtUtils::getActionFromUrl( $ds_forward );
		else		
			$ds_actionName = $ds_forward;

		throw new FailureException( $ds_actionName, $ex->getMessage(), $ex->getCode() );
	}		



}