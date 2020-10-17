Nekrida\Database\QuerySelect
===============

Class QueryTrait




* Class name: QuerySelect
* Namespace: Nekrida\Database
* Parent class: [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)





Properties
----------


### $selects

    protected array $selects = array()





* Visibility: **protected**


### $selectOptions

    protected array $selectOptions = array()





* Visibility: **protected**


### $joins

    protected array $joins = array()





* Visibility: **protected**


### $groupBy

    protected array $groupBy = array()





* Visibility: **protected**


### $having

    protected array $having = array()





* Visibility: **protected**


### $orderBy

    protected array $orderBy = array()





* Visibility: **protected**


### $limit

    protected integer $limit





* Visibility: **protected**


### $offset

    protected integer $offset





* Visibility: **protected**


### $table

    protected string $table = ''





* Visibility: **protected**


### $aliases

    protected array $aliases = array()





* Visibility: **protected**


### $wheres

    protected array $wheres = array()





* Visibility: **protected**


### $preparedStatement

    protected string $preparedStatement





* Visibility: **protected**


### $isPrepared

    protected boolean $isPrepared





* Visibility: **protected**


### $pdoObject

    protected \PDO $pdoObject





* Visibility: **protected**


### $pdoPrepared

    protected \PDOStatement $pdoPrepared





* Visibility: **protected**


Methods
-------


### having

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::having($item, $sign, $value)





* Visibility: **public**


#### Arguments
* $item **mixed**
* $sign **mixed**
* $value **mixed**



### groupBy

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::groupBy(array $columns)





* Visibility: **public**


#### Arguments
* $columns **array**



### orderBy

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::orderBy(array $columns)





* Visibility: **public**


#### Arguments
* $columns **array**



### select

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::select(array $select)





* Visibility: **public**


#### Arguments
* $select **array**



### options

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::options(array $options)

SQL select options like DISTINCT



* Visibility: **public**


#### Arguments
* $options **array**



### limit

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::limit(integer $limit, integer $offset)





* Visibility: **public**


#### Arguments
* $limit **integer**
* $offset **integer**



### joinTrait

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::joinTrait(string $type, $table, array $ons)





* Visibility: **public**


#### Arguments
* $type **string**
* $table **mixed**
* $ons **array**



### join

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::join($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### leftJoin

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::leftJoin($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### rightJoin

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::rightJoin($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### fullJoin

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::fullJoin($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### dependentJoinTrait

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::dependentJoinTrait($type, $table, array $ons)





* Visibility: **public**


#### Arguments
* $type **mixed**
* $table **mixed**
* $ons **array**



### dependentJoin

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::dependentJoin($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### dependentLeftJoin

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::dependentLeftJoin($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### dependentRightJoin

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::dependentRightJoin($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### dependentFullJoin

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::dependentFullJoin($table, array $ons)





* Visibility: **public**


#### Arguments
* $table **mixed**
* $ons **array**



### on

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::on($item, $sign, $value)

SQL join on column and value (Value is screened)



* Visibility: **public**


#### Arguments
* $item **mixed** - &lt;p&gt;string&lt;/p&gt;
* $sign **mixed** - &lt;p&gt;string&lt;/p&gt;
* $value **mixed** - &lt;p&gt;mixed&lt;/p&gt;



### onA

    \Nekrida\Database\QuerySelect Nekrida\Database\QuerySelect::onA($item1, $sign, $item2)

SQL join of 2 columns



* Visibility: **public**


#### Arguments
* $item1 **mixed** - &lt;p&gt;string&lt;/p&gt;
* $sign **mixed** - &lt;p&gt;string&lt;/p&gt;
* $item2 **mixed** - &lt;p&gt;mixed&lt;/p&gt;



### build

    void Nekrida\Database\QueryTrait::build(integer $preparedItems)

Builds the query to be passed to the database



* Visibility: **public**
* This method is **abstract**.
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $preparedItems **integer** - &lt;p&gt;How many items are to be prepared before executing&lt;/p&gt;



### __construct

    mixed Nekrida\Database\QueryTrait::__construct($table, integer $schema)

QueryTrait constructor.



* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $table **mixed**
* $schema **integer**



### from

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::from($table)





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $table **mixed**



### table

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::table($table)

Set table for the query



* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $table **mixed**



### getDependentTable

    string Nekrida\Database\QueryTrait::getDependentTable($table)





* Visibility: **protected**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $table **mixed**



### dependentTable

    string Nekrida\Database\QueryTrait::dependentTable($table)

Choose associative table based on current table.



* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $table **mixed**



### where

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::where(string $item, string $sign, integer|string|null $value)

SQL Where clause. Multiple wheres form AND clause. Value is quoted



* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $item **string** - &lt;p&gt;column&lt;/p&gt;
* $sign **string**
* $value **integer|string|null**



### whereA

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::whereA(string $item1, string $sign, string $item2)

SQL Where clause. Multiple wheres form AND clause.



* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $item1 **string** - &lt;p&gt;column&lt;/p&gt;
* $sign **string**
* $item2 **string**



### whereRaw

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::whereRaw(string $where)

SQL Where clause. Enters the query as it is, without parsing.



* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $where **string**



### query

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::query(array $args)





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $args **array**



### getTableAlias

    string Nekrida\Database\QueryTrait::getTableAlias($table)





* Visibility: **protected**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $table **mixed**



### quote

    string Nekrida\Database\QueryTrait::quote($value)





* Visibility: **protected**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $value **mixed**



### quoteCount

    string Nekrida\Database\QueryTrait::quoteCount($value, $counter, $count)





* Visibility: **protected**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $value **mixed**
* $counter **mixed**
* $count **mixed**



### quoteIfArray

    string Nekrida\Database\QueryTrait::quoteIfArray($item, $counter, $count)





* Visibility: **protected**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $item **mixed**
* $counter **mixed**
* $count **mixed**



### __toString

    string Nekrida\Database\QueryTrait::__toString()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)




### lastInsertId

    string Nekrida\Database\QueryTrait::lastInsertId()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)




### closeCursor

    boolean Nekrida\Database\QueryTrait::closeCursor()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)




### columnCount

    integer Nekrida\Database\QueryTrait::columnCount()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)




### debugDumpParams

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::debugDumpParams()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)




### errorCode

    string Nekrida\Database\QueryTrait::errorCode()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)




### errorInfo

    array Nekrida\Database\QueryTrait::errorInfo()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)




### fetch

    mixed Nekrida\Database\QueryTrait::fetch(integer $fetch_style, integer $cursor_orientation, integer $cursor_offset)





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $fetch_style **integer**
* $cursor_orientation **integer**
* $cursor_offset **integer**



### fetchAll

    array Nekrida\Database\QueryTrait::fetchAll(integer $fetch_style)





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $fetch_style **integer**



### fetchColumn

    mixed Nekrida\Database\QueryTrait::fetchColumn(integer $column_number)





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $column_number **integer**



### fetchObject

    mixed Nekrida\Database\QueryTrait::fetchObject(string $class_name, array $ctor_args)





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)


#### Arguments
* $class_name **string**
* $ctor_args **array**



### getPdoPrepared

    \PDOStatement Nekrida\Database\QueryTrait::getPdoPrepared()





* Visibility: **public**
* This method is defined by [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)



