Nekrida\Database\QueryInsert
===============

Class QueryInsert




* Class name: QueryInsert
* Namespace: Nekrida\Database
* Parent class: [Nekrida\Database\QueryTrait](Nekrida-Database-QueryTrait.md)





Properties
----------


### $columns

    protected array $columns = array()





* Visibility: **protected**


### $rawValues

    protected array $rawValues = array()





* Visibility: **protected**


### $values

    protected array $values = array()





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


### columns

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::columns($columnsArray)





* Visibility: **public**


#### Arguments
* $columnsArray **mixed**



### addColumns

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::addColumns($columns)





* Visibility: **public**


#### Arguments
* $columns **mixed**



### prepareRow

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::prepareRow()





* Visibility: **public**




### fetchValue

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::fetchValue(mixed $values)





* Visibility: **public**


#### Arguments
* $values **mixed**



### value

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::value($values)





* Visibility: **public**


#### Arguments
* $values **mixed**



### values

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::values($values)





* Visibility: **public**


#### Arguments
* $values **mixed**



### set

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::set($key, $value, integer $row)

Sets column and value for the query



* Visibility: **public**


#### Arguments
* $key **mixed**
* $value **mixed**
* $row **integer**



### setRaw

    \Nekrida\Database\QueryInsert Nekrida\Database\QueryInsert::setRaw($key, $value, integer $row)

Set column and value to update. Value is not quoted



* Visibility: **public**


#### Arguments
* $key **mixed**
* $value **mixed**
* $row **integer**



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



