<?php
/**
 * Este factory crea una colecci�n de objetos a partir
 * del resultado de un query.
 * 
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 04-03-2010
 *
 */

class CdtResultFactory {

	/**
	 * mapea los resultados de una consulta en una colecci�n
	 * @param ICdtDatabase $db manejador de bbdd.
	 * @param $result resultados de un query.
	 * @param ICdtObjectFactory $factory construye el objeto espec�fico.
	 * @return ItemCollection
	 */
	public static function toCollection( ICdtDatabase $db, $result, ICdtObjectFactory $factory){
		
		$colection = new ItemCollection();
		
		while ( $next = $db->sql_fetchassoc ( $result ) ) {
			
			$oNext = $factory->build($next);
			$colection->addItem($oNext);
		}
		
		return $colection;
	}

	/**
	 * mapea los resultados en una colecci�n donde el �ndice para
	 * acceder a cada objeto es su identificador.
	 * @param $db manejador de bbdd.
	 * @param $result resultados de un query.
	 * @param $factory construye el objeto espec�fico.
	 * @return itemCollection
	 * @deprecated
	 */
	public static function toCollectionWithCode($db, $result, ObjectCodeFactory $factory){
		$collection = new ItemCollection();
		while ( $next = $db->sql_fetchassoc ( $result ) ) {
			$oNext = $factory->build($next);
			$oNextCode = $factory->getCode($oNext);
			$collection->addItem($oNext, $oNextCode);
		}
		return $collection;
	}
	
	/**
	 * dado una arreglo asociativo, construye una colecci�n de objetos.
	 * @param array $resultArray arreglo asociativo
	 * @param ICdtObjectFactory $factory construye el objeto espec�fico.
	 */
	public static function arrayToCollection($resultArray, ICdtObjectFactoryy $factory){
		$collection = new ItemCollection();
		
		foreach ($resultArray as $next) {
			$oNext = $factory->build($next);
			$collection->addItem($oNext);
		}
		return $collection;
	}

	
}
?>