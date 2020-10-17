Nekrida\Core\Autoloader
===============






* Class name: Autoloader
* Namespace: Nekrida\Core





Properties
----------


### $prefixes

    protected array $prefixes = array()

An associative array where the key is a namespace prefix and the value
is an array of base directories for classes in that namespace.



* Visibility: **protected**


Methods
-------


### register

    void Nekrida\Core\Autoloader::register()

Register loader with SPL autoloader stack.



* Visibility: **public**




### addNamespace

    void Nekrida\Core\Autoloader::addNamespace(string $prefix, string $base_dir, boolean $prepend)

Adds a base directory for a namespace prefix.



* Visibility: **public**


#### Arguments
* $prefix **string** - &lt;p&gt;The namespace prefix.&lt;/p&gt;
* $base_dir **string** - &lt;p&gt;A base directory for class files in the
namespace.&lt;/p&gt;
* $prepend **boolean** - &lt;p&gt;If true, prepend the base directory to the stack
instead of appending it; this causes it to be searched first rather
than last.&lt;/p&gt;



### loadClass

    mixed Nekrida\Core\Autoloader::loadClass(string $class)

Loads the class file for a given class name.



* Visibility: **public**


#### Arguments
* $class **string** - &lt;p&gt;The fully-qualified class name.&lt;/p&gt;



### loadMappedFile

    mixed Nekrida\Core\Autoloader::loadMappedFile(string $prefix, string $relative_class)

Load the mapped file for a namespace prefix and relative class.



* Visibility: **protected**


#### Arguments
* $prefix **string** - &lt;p&gt;The namespace prefix.&lt;/p&gt;
* $relative_class **string** - &lt;p&gt;The relative class name.&lt;/p&gt;



### requireFile

    boolean Nekrida\Core\Autoloader::requireFile(string $file)

If a file exists, require it from the file system.



* Visibility: **protected**


#### Arguments
* $file **string** - &lt;p&gt;The file to require.&lt;/p&gt;


