<?php
/**
 * Para representar la expresi�n del criterio de b�squeda.
 * 
 * Ej: X AND Y AND (Z OR ( Y AND W) )
 * 
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 25-08-10
 *
 */
abstract class CdtExpression{

	/**
	 * se construye la expresi�n para realizar el filtrado
	 * de una consulta.
	 * @return string.
	 */
	public abstract function build();
	
}
	
?>