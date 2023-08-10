<?php

/**
 * Interface que implementar�n las clases encargadas de renderizar la grilla 
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 14-12-2011
 *
 */
interface IGridRenderer{

	public function render( CMPGrid $oGrid );
	
}