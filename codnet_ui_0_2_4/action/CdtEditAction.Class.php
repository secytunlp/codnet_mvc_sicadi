<?php

/**
 * Acci�n para para editar una entidad.
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 21-04-2010
 *
 */
abstract class CdtEditAction extends CdtAction{


	/**
	 * (non-PHPdoc)
	 * @see CdtAction::execute();
	 */
	public function execute(){

		//se inicia una transacci�n.
		CdtDbManager::begin_tran();
		
		try{
			$oEntity = $this->getEntity();
			$this->edit( $oEntity );
			$forward = $this->getForwardSuccess();
			//commit de la transacci�n.
			CdtDbManager::save();
			
		}catch(GenericException $ex){
			
			//rollback de la transacci�n.
			CdtDbManager::undo();
			CdtUtils::setRequestError( $ex );
			$forward = $this->doForwardException( $ex, $this->getForwardError() );
			//$forward = $this->getForwardError();
		}

		return $forward;
	}
	
	/**
	 * entidad a editar.
	 * @return object
	 */
	protected abstract function getEntity();

	/**
	 * se edita la entidad.
	 * @param object $oEntity entidad a editar
	 */
	protected abstract function edit($oEntity);

	/**
	 * forward para el success de la edici�n.
	 * @return string
	 */
	protected abstract function getForwardSuccess();

	/**
	 * forward para cuando hay error.
	 * @return string
	 */
	protected abstract function getForwardError();


}