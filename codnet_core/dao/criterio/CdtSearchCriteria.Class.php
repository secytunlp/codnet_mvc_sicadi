<?php
/**
 * Para representar criterios de b�squeda.
 *
 * La idea es no tener que modificar la especificaci�n de un m�todo
 * cada vez que queremos agregar criterios de b�squeda a un query.
 *
 * Ej:
 *    -  buscar($id, $nombre);
 *    despu�s queremos buscar tambi�n por domicilio y tel�fono
 *    -  buscar($id, $nombre, $domicilio, $telefono);
 *    y adem�s luego queremos filtrar tambi�n por celular
 *    -  buscar($id, $nombre, $domicilio, $telefono, $celular);
 *
 *    y as� va creciendo la especificaci�n del m�todo.
 *
 *    Usando un criterio de b�squeda ser�a:
 *
 *    - buscar ($criterio );
 *
 *    y vamos modificando el criterio de b�squeda a medida que sea necesario.
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 27-04-10
 *
 */
class CdtSearchCriteria{

	private $notNullFields;//fields a determinar que no sean null.
	private $nullFields;//fields a determinar que sean null.
	private $orderFields;//fields para ordenar.
	private $groupByFields;//fields para ordenar.
	private $page;//p�gina a paginar.
	private $rowPerPage;//cantidad de filas para el paginado.
	private $filters; //filters de b�squeda. array ( key=>field, value=> (value, operator, format))
	private $filtersHaving;
	private $oExpresion;//expresi�n para filters complejos.

	private $tableName;
	
	public function __construct(){
		
		$this->filters = array();
		$this->filtersHaving = array();
		$this->notNullFields = array();
		$this->nullFields = array();
		$this->orderFields = array();
		$this->groupByFields = array();
		$this->oExpresion = null;
	}

	


	/**
	 * setea el value a un field para buscar por like.

	 *	NOTA: Cambi� la manera de tratar los filters.
	 * Primeramente se agregaban filters con este m�todo, y siempre se anidaban con el operator AND.
	 * Ahora se cre� la clase Expresion para que los criterios puedan ser m�s elaborados, de la forma ( X AND ( Y OR Z AND (NOT B) ) ) ....
	 *	Se deja este m�todo para que lo anterior sigo funcionando correctamente.
	 * Al momento de crear el filtro de b�squeda, si $this->filters[] tuviese elementos, se generar� una expresi�n AND con los mismos.
	 *
	 * @param string $field field a filtrar
	 * @param object $value value por el cual filtrar el field
	 * @param string $operator operator para el filtrado.
	 * @param FormatValue $format clase que le da formato al value, por default ser� la identidad (format($value)=>$value).
	 */
	public function addFilter($field, $value, $operator, $format=null, $operatorWhere="AND"){

		if(empty($format))
			$format = new CdtCriteriaFormatValue();
		
		$this->filters[] = array('field' => $field, 'operator' => $operator, 'value' => $value, 'format' => $format, 'operatorWhere' => $operatorWhere);
	}
	
	/**
	 * setea un unevo filtro para having
	 * @param string $field field a filtrar
	 * @param object $value value por el cual filtrar el field
	 * @param string $operator operator para el filtrado.
	 * @param FormatValue $format clase que le da formato al value, por default ser� la identidad (format($value)=>$value).
	 */
	public function addFilterHaving($field, $value, $operator, $format=null){

		if(empty($format))
			$format = new FormatValue();
			
		$this->filtersHaving[] = array('field' => $field, 'operator' => $operator, 'value' => $value, 'format' => $format);
	}

	/**
	 * se agrega un field a evaluar 'por not null'.
	 * @param $field
	 */
	public function addNotNull($field){
		$this->notNullFields[] = $field;
	}

	public function addNull($field){
		$this->nullFields[] = $field;
	}
	/**
	 * se agrega un field para ordenar.
	 * @param $field
	 * @param $value ASC / DESC
	 */
	public function addOrder($field, $value='ASC'){
		//$this->orderFields[$field] = $value;
		$this->orderFields[] = " $field $value ";
	}

	public function addGroupBy($field){
		$this->groupByFields[] = $field;
	}

	/**
	 * dado un nombre del estilo "propiedad" o "T.propiedad"
	 * retorna la referencia válidad para el sql.
	 * @param string $name
	 * @return string
	 */
	protected function getFieldName( $name ){
		
		$field = $name;
		
		//si es simple, le agregamos el nombre de la tabla para evitar ambigüedades
		$names = explode(".", $name);
		
		if( count($names) == 1 ){
			$tableName = $this->getTableName();
			if(!empty($tableName))
				$field = $tableName . "." . $name;
		}
		
		return $field;
		
	}
	
	/**
	 * se construye el where
	 * @return string.
	 */
	public function buildWHERE(){
		$where = '' ;

		//WHERE
		//foreach ($this->filters as $field => $operator_value) {
		foreach ($this->filters as $key => $field_op_value) {
			$field = $this->getFieldName( $field_op_value['field'] );
			$operator = $field_op_value['operator'];
			$value = $field_op_value['value'];
			$format = $field_op_value['format'];
			$value = $format->format($value);
			$operatorWhere = $field_op_value['operatorWhere'];
			
			
			if( $operator == "LIKE" ){
				//si es el like fuerzo a que cada palabra matchea dentro del campo sin importar el orden.
				$value = $field_op_value['value'];
				
				$words = explode(" ", $value);
				
				if(count($words) > 1){
					$whereLIKE=array();
					foreach ($words as $word) {
						$word = $format->format($word);
						$whereLIKE[] = "$field $operator $word";
					}
					$whereLIKE = implode(" AND ", $whereLIKE);
				}else{
					$value = $format->format($value);
					$whereLIKE = "$field $operator $value";
					
				}
				
				$where .= " $operatorWhere  ($whereLIKE)";
				
			}else 
				$where .= " $operatorWhere  $field $operator $value";
		}

		foreach ($this->getNotNullFields() as $field) {
			$where .= " AND not ($field is null OR $field='') ";
		}
		foreach ($this->getNullFields() as $field) {
			$where .= " AND ($field is null) ";
		}
		if( !CdtFormatUtils::isEmpty( $this->oExpresion ) )
		$where .= " AND  " . $this->oExpresion->build() ;
			
		if(!empty($where)){
			$where =  substr( $where, 4); //le quitamos el primer AND o OR
			$where = " WHERE " . $where;
		}

		return $where;
	}

	/**
	 * se construye el having.
	 * @return string.
	 */
	public function buildHAVING(){
		$having = '' ;
		//HAVING
		foreach ($this->filtersHaving as $key => $field_op_value) {
			$field = $this->getFieldName($field_op_value['field']);
			$op = $field_op_value['operator'];
			$value = $field_op_value['value'];
			$format = $field_op_value['format'];
			$value = $format->format($value);
			$having .= " AND $field $op $value";
		}
		if(!empty($having)){
			$having =  substr( $having, 4); //le quitamos el primer AND
			$having = " HAVING " . $having;
		}
		return $having;
	}


	/**
	 * se construye el order by
	 * @return string.
	 */
	public function buildORDERBY(){
		//ORDER BY
		$order = '';
		for ($index = 0; $index < count($this->orderFields); $index++) {
			$order .= ", " .$this->getFieldName( $this->orderFields[$index] );
		}
		/*
		foreach ($this->orderFields  as $key => $value) {
			$order = ", $value ";
		}*/
		if(!empty($order)){
			$order =  substr( $order, 2); //le quitamos la primer coma
			$order = " ORDER BY " . $order;
		}

		return $order;
	}

	/**
	 * se construye el group by
	 * @return string.
	 */
	public function buildGROUPBY(){
		//GROUP BY
		$group = '';
		foreach ($this->groupByFields  as $field) {
			$field = $this->getFieldName( $field );
			$group .= ", $field ";
		}
		if(!empty($group)){
			$group =  substr( $group, 2); //le quitamos la primer coma
			$group = " GROUP BY " . $group;
		}

		return $group;
	}


	/**
	 * se contruye la paginaci�n
	 * @return string.
	 */
	public function buildLIMIT(){
		$limit='';
		
		if(!empty($this->page)){
			
			$limitInf = (($this->page - 1) * $this->rowPerPage);
			$limit .= " LIMIT $limitInf,$this->rowPerPage";
		}

		return $limit;
	}

	/**
	 * se construye el filtro de b�squeda.
	 * @return string
	 */
	public function buildCriteria(){
		$criteria  = $this->buildWHERE();
		$criteria .= $this->buildGROUPBY();
		$criteria .= $this->buildHAVING();
		$criteria .= $this->buildORDERBY();
		$criteria .= $this->buildLIMIT();
		return $criteria;

	}

	/**
	 * se construye el filtro de b�squeda sin la paginaci�n.
	 * @return string
	 */
	public function buildCriteriaWithoutPaging(){

		return $this->buildWHERE() . $this->buildGROUPBY();
	}


	public function removeFilter( $fieldName ){
		
		$filter = null;
		$ok = false;
		foreach ($this->filters as $key => $field_op_value) {
			$field = $field_op_value['field'];
			if($fieldName==$field){
				$filter = $key;
				$ok = true;
			}
		}
		if( $ok )
			unset($this->filters[ $filter ]);
	}
	
	/**
	 * retorna el value de un filtro dado el nombre del field
	 * @param string $fieldName nombre del field
	 * @return string
	 */
	public function getFilterValue( $fieldName ){
		$value = null;
		foreach ($this->filters as $key => $field_op_value) {
			$field = $field_op_value['field'];
			if($fieldName==$field)
				$value = $field_op_value['value'];
		}
		return $value;
	}

	/**
	 * retorna el value de un filtro dado el nombre del field
	 * @param string $fieldName nombre del field
	 * @return string
	 */
	public function renameFilter( $fieldName, $newName ){
		$filter = null;
		$ok = false;
		foreach ($this->filters as $key => $field_op_value) {
			$field = $field_op_value['field'];
			if($fieldName==$field){
				$filter = $key;
				$ok = true;
			}
		}
		if( $ok ){
			$newFilter = $this->filters[ $filter ];
			unset($this->filters[ $filter ]);
			$newFilter["field"]=$newName;
			$this->filters[$newName] = $newFilter;
		}
			
	}
	
	
	
	/* Getters & Setters */
	
	public function setExpresion( CdtExpression $exp ){
		$this->oExpresion = $exp;
	}
	
	public function setPage($page){
		$this->page = $page;
	}

	public function setRowPerPage($rowPerPage){
		$this->rowPerPage = $rowPerPage;
	}

	public function getPage(){
		return $this->page;
	}

	public function getRowPerPage(){
		return $this->rowPerPage;
	}

	/**
	 * retorna los valuees a evaluar 'por not null'
	 * @return unknown_type
	 */
	public function getNotNullFields(){
		return $this->notNullFields;
	}

	public function getNullFields(){
		return $this->nullFields;
	}
	/**
	 * retorna los filters.
	 * @return unknown_type
	 */
	public function getFilters(){
		return $this->filters;
	}
	

	public function getTableName()
	{
	    return $this->tableName;
	}

	public function setTableName($tableName)
	{
	    $this->tableName = $tableName;
	}
	
	public function getExpresion( ){
		return $this->oExpresion;
	}
	
}

?>