<?php

/**
 * Clase para manejar las excepciones.
 * 
 * @author bernardo
 * @since 06-03-2013
 */
class CdtExceptionHandler {
	
	public function doHandle(  Exception $ex ){
		
		//asociamos el error al request.
		CdtUtils::setRequestError( $ex );
		
		CdtUtils::log_error( get_class($this) . " > error() => Error no esperado: code => " . $ex->getCode() . " msg => " . $ex->getMessage(), __CLASS__);

		if( get_class($ex) == "DBException" ){
			//TODO podria mandar a una pantalla especial para mostrar errores de base de datos.
			echo "Error no esperado: code => " . $ex->getCode() . " msg => " . $ex->getMessage() ;
			return null;
		}
		return  "error";	
			
	}
}