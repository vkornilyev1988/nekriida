Nekrida\Core\Database
===============

Class Database
PDO objects factory




* Class name: Database
* Namespace: Nekrida\Core





Properties
----------


### $instances

    protected array<mixed,\PDO> $instances = array()





* Visibility: **protected**
* This property is **static**.


Methods
-------


### setInstance

    mixed Nekrida\Core\Database::setInstance($databaseCfg, $name)

Creates database instance



* Visibility: **public**
* This method is **static**.


#### Arguments
* $databaseCfg **mixed**
* $name **mixed**



### getInstance

    mixed Nekrida\Core\Database::getInstance(string $schema)

Returns database instance by name



* Visibility: **public**
* This method is **static**.


#### Arguments
* $schema **string**


