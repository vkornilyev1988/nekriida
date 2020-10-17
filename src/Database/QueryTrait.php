<?php


namespace Nekrida\Database;

/**
 * Trait QueryTrait
 * @package Nekrida\Sql
 */
abstract class QueryTrait
{
	/**
	 * @var string
	 */
	protected $table = '';

	/** @var string  */
	protected $tableAlias = '';

	/**
	 * @var array
	 * @deprecated
	 */
	protected $aliases = [];

	/**
	 * @var array
	 */
	protected $wheres = [];

	/**
	 * @var int
	 */
	protected $groupLevel = 0;

	/** @var string */
	protected $preparedStatement;

	/** @var bool */
	protected $isPrepared;

	/**
	 * @var mixed $databaseObject PDO like object to work with queries
	 */
	protected $databaseObject;

	/**
	 * @var mixed $statementObject PDOStatement like object for prepared queries and to fetch results
	 */
	protected $statementObject;

	public function __construct($databaseObject = null) {
		if ($databaseObject)
			$this->databaseObject = $databaseObject;
	}

	/**
	 * Builds the query to be passed to the database
	 * @param int $preparedItems How many items are to be prepared before executing
	 * @abstract
	 * @return void
	 */
	public abstract function build($preparedItems = 0);

	//SQL FUNCTIONS

	//TABLE
	/**
	 * Set table for the query
	 * @param string $table
	 * @param string $alias
	 * @return $this
	 */
	public function table($table, $alias) {
		$this->table = $table;
		$this->tableAlias = '';
		return $this;
	}
	//DEPENDENT TABLE
	protected function getDependentTable($table) {
		if (class_exists($table) && is_subclass_of($table,'Query'))
			$table = $table::TABLE_NAME;
		if ($this->table > $table)
			return $table.'_'.$this->table;
		else
			return $this->table.'_'.$table;
	}

	/**
	 * Choose associative table based on current table.
	 * @param string $table
	 * @return string
	 */
	public function dependentTable($table) {
		$this->table = $this->getDependentTable($table);
		return $this;
	}

	//WHERES
	//QUOTED WHERES
	/**
	 * SQL Where clause. Multiple wheres form AND clause. Value is quoted
	 * @param string $column column
	 * @param string $sign
	 * @param int|string|null $value
	 * @param bool $quote
	 * @return $this
	 */
	public function where($column, $sign, $value, $quote = true) {
		$this->setWhereToGroup([
			'column' => $column,
			'sign' => $sign,
			'value' => $value,
			'quote' => $quote
		]);
		return $this;
	}

	/**
	 * SQL Where clause. Attaches to other wheres with OR clause. Value is quoted
	 * @param $column
	 * @param $sign
	 * @param $value
	 * @param bool $quote
	 * @return $this
	 */
	public function orWhere($column, $sign, $value,$quote = true) {
		$this->setWhereToGroup([
			'operator' => 'or',
			'column' => $column,
			'sign' => $sign,
			'value' => $value,
			'quote' => $quote
		]);
		return $this;
	}

	//NON-QUOTED WHERES

	/**
	 * @param $column
	 * @param $sign
	 * @param $value
	 * @return $this
	 */
	public function whereA($column, $sign, $value) {
		return $this->where($column,$sign,$value, false);
	}

	/**
	 * @param $column
	 * @param $sign
	 * @param $value
	 * @return $this
	 */
	public function orWhereA($column, $sign, $value) {
		return $this->orWhere($column,$sign,$value, false);
	}

	//RAW WHERES
	/**
	 * Raw where clause
	 * @param $raw
	 * @return $this
	 */
	public function whereRaw($raw) {
		$this->setWhereToGroup([
			'raw' => $raw
		]);
		return $this;
	}

	/**
	 * Raw where clause. Attaches to other wheres with OR clause
	 * @param $raw
	 * @return $this
	 */
	public function orWhereRaw($raw) {
		$this->setWhereToGroup([
			'raw' => $raw,
			'operator' => 'or',
		]);
		return $this;
	}


	protected function setWhereToGroup($where) {
		if($this->groupLevel === 0)
			$this->wheres[] = $where;
		else {
			//Get to the groupLevel
			$x = &$this->wheres;
			for ($i = 0; $i < $this->groupLevel; $i++)
				$x = &$x[count($x) - 1];
			//Set to where to group
			$x[] = $where;
		}
	}

	//WHERE GROUPS

	/**
	 * Initializes Where group. Attaches to other wheres and where groups with AND clause.
	 * @return $this
	 */
	public function group() {
		$this->setWhereToGroup([]);
		$this->groupLevel++;
		return $this;
	}

	/**
	 * Initializes Where group. Attaches to other wheres and where groups with OR clause.
	 * @return $this
	 */
	public function orGroup() {
		$this->setWhereToGroup(['operator' => 'or']);
		$this->groupLevel++;
		return $this;
	}

	/**
	 * Adds raw where group statement. Attaches to other wheres and where groups with AND clause.
	 * @param $raw
	 * @return $this
	 */
	public function groupRaw($raw) {
		$this->setWhereToGroup([['raw' => $raw]]);
		return $this;
	}

	/**
	 * Adds raw where group statement. Attaches to other wheres and where groups with OR clause.
	 * @param $raw
	 * @return $this
	 */
	public function orGroupRaw($raw) {
		$this->setWhereToGroup(['operator' => 'or',['raw' => $raw]]);
		return $this;
	}

	/**
	 * Closes current where group
	 * @return $this
	 */
	public function end() {
		$this->groupLevel--;
		return $this;
	}


	/**
	 * @param array $args
	 * @param bool $force
	 * @return $this
	 */
	public function query($args = [], $force = false) {
		if ($force || is_null($this->preparedStatement) || $this->isPrepared != count($args))
			$this->build(count($args));
		if (empty($args)) {
			$this->statementObject = $this->databaseObject->query($this->preparedStatement);
		} else {
			$this->statementObject = $this->databaseObject->prepare($this->preparedStatement);
			$this->statementObject->execute($args);
		}
		return $this;
	}

	/**
	 * Deletes the current cached request
	 */
	public function reset() {
		$this->isPrepared = false;
	}

	/**
	 * @param mixed $databaseObject
	 * @return QueryTrait
	 */
	public function setDatabaseObject($databaseObject)
	{
		$this->databaseObject = $databaseObject;
		return $this;
	}


	/**
	 * @param $value
	 * @return string
	 */
	protected function quote($value) {
		if (is_string($value)) {
			return "'".str_replace(["'",'\\'],["''","\\\\"],$value)."'";
		} elseif (is_null($value))
			return 'null';
		else {
			return $value;
		}
	}

	/**
	 * @param $value
	 * @param $counter
	 * @param $count
	 * @return string
	 */
	protected function quoteCount($value, &$counter, $count) {
		if (is_string($value)) {
			if (($value == '?' || strpos($value,':') === 0) && $counter < $count) {
				$counter++;
				return $value;
			} else
				return "'".str_replace(["'",'\\'],["''","\\\\"],$value)."'";
		} elseif (is_null($value))
			return 'null';
		else
			return $value;
	}

	/**
	 * @param $item
	 * @param $counter
	 * @param $count
	 * @return string
	 */
	protected function quoteIfArray($item, &$counter, $count) {
		if (is_array($item))
			return $item[0] . ' ' . $item[1] . ' ' . ($count ? $this->quoteCount($item[2], $counter, $count) : $this->quote($item[2]));
		else
			return $item;
	}

	//GETTERS AND SETTERS

	/**
	 * @return string
	 */
	public function __toString()
	{
		if (is_null($this->preparedStatement)) $this->build();
		return $this->preparedStatement;
	}

	public function export() {
		$res = get_object_vars($this);
		foreach ($res as $key => $value)
			if (!$value)
				unset($res[$key]);
		return $res;
	}

	public function import($array) {
		foreach ($array as $key => $value)
			if (is_array($this->$key))
				$this->$key = array_merge($this->$key, $value);
			else
				$this->$key = $value;
		return $this;
	}

	//PDO functions wrapper

	/**
	 * @return string
	 */
	public function lastInsertId() {
		return $this->databaseObject->lastInsertId();
	}

	/**
	 * @return bool
	 */
	public function closeCursor () { return $this->statementObject->closeCursor(); }

	/**
	 * @return int
	 */
	public function columnCount () { return $this->statementObject->columnCount(); }

	/**
	 * @return $this
	 */
	public function debugDumpParams () { $this->statementObject->debugDumpParams(); return $this; }

	/**
	 * @return string
	 */
	public function errorCode () { return $this->statementObject->errorCode(); }

	/**
	 * @return array
	 */
	public function errorInfo () { return $this->statementObject->errorInfo(); }

	/**
	 * @param int $fetch_style
	 * @param int $cursor_orientation
	 * @param int $cursor_offset
	 * @return mixed
	 */
	public function fetch ($fetch_style = \PDO::FETCH_BOTH , $cursor_orientation = \PDO::FETCH_ORI_NEXT , $cursor_offset = 0 ) { return $this->statementObject->fetch($fetch_style,$cursor_orientation,$cursor_offset);}

	/**
	 * @param int $fetch_style
	 * @return array
	 */
	public function fetchAll ($fetch_style = \PDO::FETCH_BOTH) { return $this->statementObject->fetchAll($fetch_style); }

	/**
	 * @param int $column_number
	 * @return mixed
	 */
	public function fetchColumn ($column_number = 0) {return $this->statementObject->fetchColumn($column_number);}

	/**
	 * @param string $class_name
	 * @param array $ctor_args
	 * @return mixed
	 */
	public function fetchObject ($class_name = "stdClass", $ctor_args = [] ) { return $this->statementObject->fetchObject($class_name,$ctor_args);}
	/*public function getAttribute ( int $attribute ) : mixed
	public function getColumnMeta ( int $column ) : array
	public function nextRowset ( void ) : bool
	public function rowCount ( void ) : int
	public function setAttribute ( int $attribute , mixed $value ) : bool
	public function setFetchMode ( int $mode ) : bool*/

	/**
	 * @return mixed
	 */
	public function getStatementObject() {
		return $this->statementObject;
	}

	protected function buildWhere($array, $groupLevel = 0) {
		$string = ''; $counter = 0;
		foreach ($array as $key => $level) {
			if (!isset($level['column']) && !isset($level['raw'])) {
				//Operator can be in a group and in a regular where.
				if ($key === 'operator') continue;
				//We are in the group

				//Insert operator
				$built = $this->buildWhere($level, $groupLevel++);
				if ($built) {
					if ($counter > 0)
						$string .= isset($level['operator']) ? ' ' . $level['operator'] . ' ' : ' AND ';
					$counter++;
					$string .= ' ('.$this->buildWhere($level, $groupLevel++).') ';
				}
			} else {
				//Actually mustn't execute.
				if (!is_array($level)) continue;

				//Insert operator
				if ($key > 0)
					$string .= isset($level['operator']) ? ' '.$level['operator'].' ' : ' AND ';
				//If the statement is raw don't try to parse it.
				if (isset($level['raw']))
					$string .= $level['raw'];
				else
					$string .= $level['column'] . ' ' . $level['sign'] . ' ' .
						($level['quote'] ? $this->quote($level['value']) : $level['value']);
			}
		}
		return $string;
	}
}