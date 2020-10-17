Nekrida\Database\QueryTrait
===============

Class QueryTrait




* Class name: QueryTrait
* Namespace: Nekrida\Database
* This is an **abstract** class





Properties
----------


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


### __construct

    mixed Nekrida\Database\QueryTrait::__construct($table, integer $schema)

QueryTrait constructor.



* Visibility: **public**


#### Arguments
* $table **mixed**
* $schema **integer**



### from

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::from($table)





* Visibility: **public**


#### Arguments
* $table **mixed**



### table

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::table($table)

Set table for the query



* Visibility: **public**


#### Arguments
* $table **mixed**



### getDependentTable

    string Nekrida\Database\QueryTrait::getDependentTable($table)





* Visibility: **protected**


#### Arguments
* $table **mixed**



### dependentTable

    string Nekrida\Database\QueryTrait::dependentTable($table)

Choose associative table based on current table.



* Visibility: **public**


#### Arguments
* $table **mixed**



### where

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::where(string $item, string $sign, integer|string|null $value)

SQL Where clause. Multiple wheres form AND clause. Value is quoted



* Visibility: **public**


#### Arguments
* $item **string** - &lt;p&gt;column&lt;/p&gt;
* $sign **string**
* $value **integer|string|null**



### whereA

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::whereA(string $item1, string $sign, string $item2)

SQL Where clause. Multiple wheres form AND clause.



* Visibility: **public**


#### Arguments
* $item1 **string** - &lt;p&gt;column&lt;/p&gt;
* $sign **string**
* $item2 **string**



### whereRaw

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::whereRaw(string $where)

SQL Where clause. Enters the query as it is, without parsing.



* Visibility: **public**


#### Arguments
* $where **string**



### build

    void Nekrida\Database\QueryTrait::build(integer $preparedItems)

Builds the query to be passed to the database



* Visibility: **public**
* This method is **abstract**.


#### Arguments
* $preparedItems **integer** - &lt;p&gt;How many items are to be prepared before executing&lt;/p&gt;



### query

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::query(array $args)





* Visibility: **public**


#### Arguments
* $args **array**



### getTableAlias

    string Nekrida\Database\QueryTrait::getTableAlias($table)





* Visibility: **protected**


#### Arguments
* $table **mixed**



### quote

    string Nekrida\Database\QueryTrait::quote($value)





* Visibility: **protected**


#### Arguments
* $value **mixed**



### quoteCount

    string Nekrida\Database\QueryTrait::quoteCount($value, $counter, $count)





* Visibility: **protected**


#### Arguments
* $value **mixed**
* $counter **mixed**
* $count **mixed**



### quoteIfArray

    string Nekrida\Database\QueryTrait::quoteIfArray($item, $counter, $count)





* Visibility: **protected**


#### Arguments
* $item **mixed**
* $counter **mixed**
* $count **mixed**



### __toString

    string Nekrida\Database\QueryTrait::__toString()





* Visibility: **public**




### lastInsertId

    string Nekrida\Database\QueryTrait::lastInsertId()





* Visibility: **public**




### closeCursor

    boolean Nekrida\Database\QueryTrait::closeCursor()





* Visibility: **public**




### columnCount

    integer Nekrida\Database\QueryTrait::columnCount()





* Visibility: **public**




### debugDumpParams

    \Nekrida\Database\QueryTrait Nekrida\Database\QueryTrait::debugDumpParams()





* Visibility: **public**




### errorCode

    string Nekrida\Database\QueryTrait::errorCode()





* Visibility: **public**




### errorInfo

    array Nekrida\Database\QueryTrait::errorInfo()





* Visibility: **public**




### fetch

    mixed Nekrida\Database\QueryTrait::fetch(integer $fetch_style, integer $cursor_orientation, integer $cursor_offset)





* Visibility: **public**


#### Arguments
* $fetch_style **integer**
* $cursor_orientation **integer**
* $cursor_offset **integer**



### fetchAll

    array Nekrida\Database\QueryTrait::fetchAll(integer $fetch_style)





* Visibility: **public**


#### Arguments
* $fetch_style **integer**



### fetchColumn

    mixed Nekrida\Database\QueryTrait::fetchColumn(integer $column_number)





* Visibility: **public**


#### Arguments
* $column_number **integer**



### fetchObject

    mixed Nekrida\Database\QueryTrait::fetchObject(string $class_name, array $ctor_args)





* Visibility: **public**


#### Arguments
* $class_name **string**
* $ctor_args **array**



### getPdoPrepared

    \PDOStatement Nekrida\Database\QueryTrait::getPdoPrepared()





* Visibility: **public**



