<?php


namespace Nekrida\Database;

/**
 * Class QueryInsert
 * @package Nekrida\Database
 */
class QueryInsert extends QueryTrait
{
	/** @var array  */
	protected $columns = [];

	/** @var array  */
	protected $rawValues = [];

	/** @var array  */
	protected $values = [];

	/**
	 * @param $columnsArray
	 * @return $this
	 */
	public function columns($columnsArray) {
		$this->columns = $columnsArray;
		return $this;
	}

	/**
	 * @param $columns
	 * @return $this
	 */
	public function addColumns($columns) {
		$this->columns = array_values(array_unique(array_merge($this->columns,$columns)));
		return $this;
	}

	/**
	 * @return $this
	 */
	public function prepareRow() {
		$this->values = [];
		foreach ($this->columns as $column) {
			$this->values[0][] = '?';
		}
		return $this;
	}

	/**
	 * @param mixed $values
	 * @return QueryInsert
	 */
	public function fetchValue($values) {
		$a = [];
		foreach ($values as $value) {
			$a[] = '?';
		}
		$this->values[] = $a;
		return $this->query([$values]);
	}

	/**
	 * @param $values
	 * @return $this
	 */
	public function value($values) {
		$this->values[] = $values;
		return $this;
	}

	/**
	 * @param $values
	 * @return $this
	 */
	public function values ($values) {
		foreach ($values as $value)
			$this->values[] = $value;
		return $this;
	}

	/**
	 * Sets column and value for the query
	 * @param $key
	 * @param $value
	 * @param int $row
	 * @return $this
	 */
	public function set($key,$value, $row = 0) {
		$this->values[$row][count($this->columns)] = $value;
		$this->columns[count($this->columns)] = $key;

		return $this;
	}

	/**
	 * Set column and value to update. Value is not quoted
	 * @param $key
	 * @param $value
	 * @param int $row
	 * @return $this
	 */
	public function setRaw($key,$value, $row = 0) {
		$this->rawValues[$row][count($this->columns)] = true;

		$this->values[$row][count($this->columns)] = $value;
		$this->columns[count($this->columns)] = $key;

		return $this;
	}

	/**
	 * Builds the query to be passed to the database
	 * @param int $preparedItems How many items are to be prepared before executing
	 * @return void
	 */
	public function build($preparedItems = 0)
	{
		$preparedCount = 0;

		$valuesStrings = [];
		foreach ($this->values as $row => $values) {
			$valuesQuoted = [];
			foreach ($values as $key => $value) {
				$valuesQuoted[] = isset($this->rawValues[$row][$key]) ? $value : ($preparedItems ? $this->quoteCount($value, $preparedCount, $preparedItems) : $this->quote($value));
			}
			$valuesStrings[] = "(".implode(',',$valuesQuoted).")";
		}
		$sql = "INSERT INTO ".$this->table. " (".implode(',',$this->columns).") VALUES ".implode(',',$valuesStrings);

		$this->preparedStatement = $sql;
		$this->isPrepared = $preparedItems;
	}
}