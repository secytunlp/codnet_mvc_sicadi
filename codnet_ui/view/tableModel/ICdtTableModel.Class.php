<?php
/**
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 20-04-2010
 *
 * Interfaz que define m�todos para obtener informaci�n
 * (y meta-informaci�n) de una colecci�n o conjunto de elementos.
 *
 */

interface ICdtTableModel{

	/**
	 * retorna el t�tulo.
	 * @return
	 */
	function getTitle();

	/**
	 * retorna la cantidad de columnas a visualizar.
	 * @param unknown_type $items
	 * @return cantidad de columnas.
	 */
	function getColumnCount();

	/**
	 * retorna el nombre de la columna para el �ndice dado.
	 * @param unknown_type $columnIndex
	 * @return descripci�n
	 */
	function getColumnName($columnIndex);

	/**
	 * retorna el label de la columna para el �ndice dado.
	 * @param unknown_type $columnIndex
	 * @return descripci�n
	 */
	function getColumnLabel($columnIndex);

	/**
	 * retorna el ancho de una columna.
	 * @param unknown_type $columnIndex
	 * @return int
	 */
	function getColumnWidth($columnIndex);

	/**
	 * retorna la cantidad de filas en el modelo.
	 * @return unknown_type
	 */
	function getRowCount();

	/**
	 * retorna el valor de una celda.
	 * @param unknown_type $rowIndex
	 * @param unknown_type $columnIndex
	 * @return valor
	 */
	function getValueAt($rowIndex, $columnIndex);

	/**
	 * retorna el valor de la entitdad dado el �ndice de columna
	 * @param oEntity $oEntity entitdad
	 * @param int $columnIndex �ndice de la columna
	 * @return anObject.
	 */
	public function getValue($oEntity, $columnIndex);

}
?>