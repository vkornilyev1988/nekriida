Nekrida\Database\Query
===============

Class Query




* Class name: Query
* Namespace: Nekrida\Database



Constants
----------


### TABLE_NAME

    const TABLE_NAME = 'models'





### ID_COLUMN

    const ID_COLUMN = 'id'





Properties
----------


### $databaseName

    public string $databaseName = 'main'





* Visibility: **public**
* This property is **static**.


Methods
-------


### insertColumns

    \Nekrida\Database\QueryInsert Nekrida\Database\Query::insertColumns(array $columns)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $columns **array**



### insertSet

    \Nekrida\Database\QueryInsert Nekrida\Database\Query::insertSet($options)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $options **mixed**



### deleteById

    \Nekrida\Database\QueryDelete Nekrida\Database\Query::deleteById($id)

Delete row by table id. Shortcut for self::delete()->where('id','=','?')->query([$id])



* Visibility: **public**
* This method is **static**.


#### Arguments
* $id **mixed**



### delete

    \Nekrida\Database\QueryDelete Nekrida\Database\Query::delete()

Init delete query



* Visibility: **public**
* This method is **static**.




### updateSet

    \Nekrida\Database\QueryUpdate Nekrida\Database\Query::updateSet($options)

Init update query



* Visibility: **public**
* This method is **static**.


#### Arguments
* $options **mixed** - &lt;p&gt;array of key-value pairs&lt;/p&gt;



### updateColumns

    \Nekrida\Database\QueryUpdate Nekrida\Database\Query::updateColumns($keys)

Init update query and set columns



* Visibility: **public**
* This method is **static**.


#### Arguments
* $keys **mixed** - &lt;p&gt;array of columns to update&lt;/p&gt;



### select

    \Nekrida\Database\QuerySelect Nekrida\Database\Query::select(array $select)

Init select query and choose columns to select



* Visibility: **public**
* This method is **static**.


#### Arguments
* $select **array** - &lt;p&gt;columns to select either &quot;column alias&quot; =&gt; &quot;column name&quot; or &quot;column name 1&quot;, &quot;column name 2&quot;. Mixing is allowed&lt;/p&gt;



### selectAll

    array Nekrida\Database\Query::selectAll(integer $fetchStyle)

Shortcut for self::select()->query()->fetchAll($fetchStyle)
Returns all rows from the table



* Visibility: **public**
* This method is **static**.


#### Arguments
* $fetchStyle **integer** - &lt;p&gt;PDO fetch_style&lt;/p&gt;



### getById

    \Nekrida\Database\QuerySelect Nekrida\Database\Query::getById($id, array $select, integer $fetchStyle)

Shortcut for self::get($select)->where('id','=','?')->query([$id])->fetch($fetchStyle)
Returns row with the specific ID



* Visibility: **public**
* This method is **static**.


#### Arguments
* $id **mixed**
* $select **array** - &lt;p&gt;{@see Query::get()}&lt;/p&gt;
* $fetchStyle **integer** - &lt;p&gt;PDO fetch_style&lt;/p&gt;


