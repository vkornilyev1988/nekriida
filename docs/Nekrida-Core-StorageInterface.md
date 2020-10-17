Nekrida\Core\StorageInterface
===============

Interface StorageInterface




* Interface name: StorageInterface
* Namespace: Nekrida\Core
* This is an **interface**






Methods
-------


### delete

    boolean Nekrida\Core\StorageInterface::delete($link)

Deletes the file



* Visibility: **public**


#### Arguments
* $link **mixed**



### download

    \Nekrida\Core\Response Nekrida\Core\StorageInterface::download($link, $name)

Returns response with the header to force download the file or link to the file

Use Response::file($link) to print the file

* Visibility: **public**


#### Arguments
* $link **mixed** - &lt;p&gt;string&lt;/p&gt;
* $name **mixed**



### get

    \Nekrida\Core\Response Nekrida\Core\StorageInterface::get($link)

Returns response with the header to the file or the file itself

Use Response::file($link) to print the file

* Visibility: **public**


#### Arguments
* $link **mixed** - &lt;p&gt;string&lt;/p&gt;



### patch

    mixed Nekrida\Core\StorageInterface::patch($link, $file)

Replaces the file by new file.



* Visibility: **public**


#### Arguments
* $link **mixed** - &lt;p&gt;string&lt;/p&gt;
* $file **mixed** - &lt;p&gt;array $_FILES typed array&lt;/p&gt;



### put

    boolean|string Nekrida\Core\StorageInterface::put($file, array $options, $storage)

Uploads the file and returns the url to this file



* Visibility: **public**


#### Arguments
* $file **mixed** - &lt;p&gt;array $_FILES typed array&lt;/p&gt;
* $options **array**
* $storage **mixed** - &lt;p&gt;string Name of the storage (configured at &#039;config/storage.php&#039;)&lt;/p&gt;



### url

    string Nekrida\Core\StorageInterface::url(string $link)

Returns real link to the object from the virtual link set in the configurations.



* Visibility: **public**


#### Arguments
* $link **string**


