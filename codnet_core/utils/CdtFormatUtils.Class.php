<?php

/**
 * Utilidades para el tratamiento de formatos.
 * 
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 10-03-2010
 */
class CdtFormatUtils{
	
		
	public static function isEmpty($value){
		return $value==null || $value=='' || $value==0;
	}

	public static function ifNull($value,$show){
		return ($value==null)?$show:$value;
	}
	
	public static function ifEmpty($value,$show){
		return (self::isEmpty($value))?$show:$value; //TODO parse number.
	}
	
	public static function formatEmpty($value){
		return (self::isEmpty($value))?'':$value;
	}
	
	public static function quitarEnters($value){
		$value = str_replace("\n", "", $value);
		return str_replace("\r", "", $value);
	}
	
	/**
	 * si cd1=cd2, formatea la salida :
	 *     'cd1' selected='selected'
	 *     
	 * @param unknown_type $cd1
	 * @param unknown_type $cd2
	 * @return unknown_type
	 */
	public static function selected($cd1, $cd2){

		$value='';
		if($cd1==$cd2){
				$value = " selected='selected'" ;
		}else{
				$value = '';				
		}				
		return $value;
	}	

	/**
	 * si cd1=cd2, formatea la salida :
	 *     'cd1' checked='checked'
	 *     
	 * @param unknown_type $cd1
	 * @param unknown_type $cd2
	 * @return unknown_type
	 */
	public static function checked($cd1, $cd2){
		$value='';
		if($cd1==$cd2){
				$value = "'". $cd1. "'" . " checked='checked'" ;
		}else{
				$value = $cd1;				
		}				
		return $value;
	}	
	

    static function redondear($valor) {
        $float_redondeado = round($valor * 100) / 100;
        return $float_redondeado;
    }
	
	/**
	 * formatea el mensaje con los par�metros indicados.
	 * @param unknown_type $msg mensaje a formatear
	 * @param unknown_type $params par�metros
	 * @return string
	 */
	public static function formatMessage($msg, $params){
		
		if(!empty($params)){
			
			$count = count ( $params );
			$i=1;
			while ( $i <= $count ) {
				$param = $params [$i-1];
				
				$msg = str_replace('$'.$i, $param, $msg);
				
				$i ++;
			}
			
		}
		return $msg;
		
	
	}


	//formatea el set update set poniendo comillas simples o null, segun el valor ingresado
    static function formatSetUpdate($campo, $value) {
    	return ($value=='null')?$campo."=". $value:$campo."='". $value."'";
    }
}
