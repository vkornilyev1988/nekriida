<?php


namespace Nekrida\Database;


class QuerySelect extends QueryTrait
{
	/**
	 * @var array $selects
	 * [alias=>column/expression] || [column/expression]
	 */
	protected $selects = [];

	/**
	 * @var array
	 */
	protected $selectOptions = [];

	// ['join','Table','t',['u.id','=','t.uid'],'al > 0']
	/**
	 * @var array
	 */
	protected $joins = [];

	/** @var array  */
	protected $groupBy = [];

	/** @var array  */
	protected $having = [];

	/** @var array  */
	protected $orderBy = [];

	/** @var int */
	protected $limit;

	/** @var int */
	protected $offset;

	//SQL FUNCTIONS

	/**
	 * @param $item
	 * @param $sign
	 * @param $value
	 * @return $this
	 */
	public function having($item,$sign,$value) {
		$this->having[] = [$item,$sign,$value];
		return $this;
	}

	/**
	 * @param array $columns
	 * @return $this
	 */
	public function groupBy($columns) {
		foreach ($columns as $column)
			$this->groupBy[] = $column;
		return $this;
	}

	/**
	 * @param array $columns
	 * @return $this
	 */
	public function orderBy($columns) {
		foreach ($columns as $key => $value)
			if (is_int($key))
				$this->orderBy[$value] = 'ASC';
			else
				$this->orderBy[$key] = $value;
		return $this;
	}

	/**
	 * @param array $select
	 * @return $this
	 */
	public function select($select = []) {
		if (!is_array($select)) $select = [$select];
		$this->selects = $select;
		return $this;
	}

	public function addSelect($select = []) {
		if (!is_array($select)) $select = [$select];
		$this->selects = array_merge($this->selects, $select);
		return $this;
	}

	public function removeSelect($key) {
		unset($this->selects[$key]);
		return $this;
	}

	/**
	 * SQL select options like DISTINCT
	 * @param array $options
	 * @return $this
	 */
	public function options($options) {
		$this->selectOptions = $options;
		return $this;
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return $this
	 */
	public function limit($limit, $offset = 0) {
		$this->limit = $limit;
		$this->offset = $offset;
		return $this;
	}

	//JOINS

	/**
	 * @param string $type
	 * @param string $table
	 * @return $this
	 */
	public function joinTrait($type,$table,$alias) {
		/*if (class_exists($table))
			$table = $table::TABLE_NAME;*/

		$arr = [$type,$table,$alias];
		$this->joins[] = $arr;
		return $this;
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function join($table,$alias) {
		return $this->joinTrait('JOIN',$table,$alias);
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function leftJoin($table, $alias) {
		return $this->joinTrait('LEFT JOIN',$table,$alias);
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function rightJoin($table,$alias) {
		return $this->joinTrait('RIGHT JOIN',$table,$alias);
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return QuerySelect
	 */
	public function fullJoin($table,$alias) {
		return $this->joinTrait('FULL JOIN',$table,$alias);
	}

	//DEPENDENT JOINS

	/**
	 * @param string $type
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function dependentJoinTrait ($type,$table,$alias) {
		$table = $this->getDependentTable($table);

		$arr = [$type,$table,$alias];
		$this->joins[] = $arr;
		return $this;
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function dependentJoin($table,$alias) {
		return $this->dependentJoinTrait('JOIN',$table,$alias);
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function dependentLeftJoin($table,$alias) {
		return $this->dependentJoinTrait('LEFT JOIN',$table,$alias);
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function dependentRightJoin($table,$alias) {
		return $this->dependentJoinTrait('RIGHT JOIN',$table,$alias);
	}

	/**
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function dependentFullJoin($table,$alias) {
		return $this->dependentJoinTrait('FULL JOIN',$table,$alias);
	}

	/**
	 * SQL join on column and value (Value is screened)
	 * @param $item string
	 * @param $sign string
	 * @param $value mixed
	 * @return $this
	 */
	public function on($item,$sign,$value) {
		$this->joins[count($this->joins) -1][] = [$item,$sign,$value];
		return $this;
	}

	/**
	 * SQL join of 2 columns
	 * @param $item1 string
	 * @param $sign string
	 * @param $item2 mixed
	 * @return $this
	 */
	public function onA($item1,$sign,$item2) {
		$this->joins[count($this->joins) -1][] = "$item1 $sign $item2";
		return $this;
	}

	//BUILD

	/**
	 * @param int $preparedItems
	 */
	public function build($preparedItems = 0) {
		$preparedCount = 0;
		//SELECT
		$select = [];
		foreach ($this->selects as $alias => $column) {
			$select[] = $column . (is_numeric($alias) ? '' : ' as "'.$alias.'"');
		}
		//$tableAlias =//$this->getTableAlias($this->table);
		if (empty($select)) $select = ['*'];
		//JOIN
		$joins = [];
		foreach ($this->joins as $join) {
			$joinStrings = [];

			for ($i = 3; $i < count($join); $i++)
				$joinStrings[] = $this->quoteIfArray($join[$i],$preparedCount,$preparedItems);

			$joins[] = $join[0] . ' '.$join[1].' '.$join[2].' ON '. implode(' AND ',$joinStrings);
		}
		$joins = implode(' ',$joins);
		//WHERE
		if (!$this->wheres)
			$wheres = '';
		else {
			$builtWhere = $this->buildWhere($this->wheres);
			$wheres = $builtWhere ? 'WHERE ' . $builtWhere : '';
		}
		//GROUP BY
		if (empty($this->groupBy))
			$groupBy = '';
		else
			$groupBy = 'GROUP BY '. implode(',',$this->groupBy);

		//HAVING
		if (!$this->having)
			$having = '';
		else {
			$having = [];
			foreach ($this->having as $where) {
				$whereStrings = [];
				foreach ($where as $item)
					$whereStrings[] = $this->quoteIfArray($item,$preparedCount,$preparedItems);
				$wheres = 'HAVING ' . implode(' AND ', $whereStrings);
			}
		}

		//ORDER BY
		if (empty($this->orderBy))
			$orderBy = '';
		else {
			$orderByS = [];
			foreach ($this->orderBy as $column => $type)
				$orderByS[] = $column . ' '.$type;
			$orderBy = 'ORDER BY '.implode(',',$orderByS);
		}

		//LIMIT
		if (empty($this->limit))
			$limit = '';
		else
			if (empty($this->offset))
				$limit = 'LIMIT '. $this->limit;
			else
				$limit = 'LIMIT '. $this->offset . ', '.$this->limit;
		$sql = 'SELECT '.implode(' ',$this->selectOptions).' '.implode(',',$select) .' FROM '.$this->table.' '.$this->tableAlias.' '.$joins.' '.$wheres.' '.$groupBy.' '.$having.' '.$orderBy. ' '.$limit;

		$this->preparedStatement = $sql;
		$this->isPrepared = $preparedItems;
	}
}