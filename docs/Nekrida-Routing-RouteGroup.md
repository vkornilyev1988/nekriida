Nekrida\Routing\RouteGroup
===============

Class RouteGroup




* Class name: RouteGroup
* Namespace: Nekrida\Routing





Properties
----------


### $namespace

    protected string $namespace = ''





* Visibility: **protected**


### $domain

    protected string $domain = ''





* Visibility: **protected**


### $prefix

    protected string $prefix = ''





* Visibility: **protected**


### $middleware

    protected array<mixed,string> $middleware = array()





* Visibility: **protected**


### $restrictions

    protected array $restrictions = array()





* Visibility: **protected**


Methods
-------


### domain

    \Nekrida\Routing\RouteGroup Nekrida\Routing\RouteGroup::domain($domain)





* Visibility: **public**


#### Arguments
* $domain **mixed**



### group

    array<mixed,\Nekrida\Routing\RouteItem> Nekrida\Routing\RouteGroup::group($routes)





* Visibility: **public**


#### Arguments
* $routes **mixed** - &lt;p&gt;RouteItem[]&lt;/p&gt;



### middleware

    \Nekrida\Routing\RouteGroup Nekrida\Routing\RouteGroup::middleware($middleware)

Adds middleware for routes in the group



* Visibility: **public**


#### Arguments
* $middleware **mixed**



### xnamespace

    \Nekrida\Routing\RouteGroup Nekrida\Routing\RouteGroup::xnamespace($namespace)

Sets namespace for routes



* Visibility: **public**


#### Arguments
* $namespace **mixed**



### prefix

    \Nekrida\Routing\RouteGroup Nekrida\Routing\RouteGroup::prefix($prefix)

Sets url prefix for the routes in the group



* Visibility: **public**


#### Arguments
* $prefix **mixed**



### where

    \Nekrida\Routing\RouteGroup Nekrida\Routing\RouteGroup::where(array $restrictions)

Sets restrictions for the variables of the url



* Visibility: **public**


#### Arguments
* $restrictions **array** - &lt;p&gt;key - variable name; value - regex restriction&lt;/p&gt;



### multiArrayToSimple

    array Nekrida\Routing\RouteGroup::multiArrayToSimple($array)

Converts multidimensional array into simple one dimensional array



* Visibility: **protected**


#### Arguments
* $array **mixed**


