<?php


namespace Nekrida\Database;


class QueryDelete extends QueryTrait
{
	public function build($preparedItems = 0) {
		$preparedCount = 0;
		$wheres = $this->buildWhere($this->wheres);

		$sql = 'DELETE FROM '.$this->table.' '.$wheres;

		$this->preparedStatement = $sql;
		$this->isPrepared = $preparedItems;
	}
}