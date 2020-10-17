Nekrida\Routing\RouteItem
===============

Class RouteItem




* Class name: RouteItem
* Namespace: Nekrida\Routing





Properties
----------


### $counter

    protected integer $counter





* Visibility: **protected**
* This property is **static**.


### $url

    protected string $url





* Visibility: **protected**


### $callback

    protected callable $callback





* Visibility: **protected**


### $name

    protected string $name = ''





* Visibility: **protected**


### $methods

    protected array $methods





* Visibility: **protected**


### $domain

    protected string $domain = ''





* Visibility: **protected**


### $restrictions

    protected array $restrictions = array()





* Visibility: **protected**


### $namespace

    protected string $namespace = ''





* Visibility: **protected**


### $middleware

    protected array<mixed,\Nekrida\Routing\Middleware> $middleware = array()





* Visibility: **protected**


### $afterMiddleware

    protected array<mixed,\Nekrida\Routing\Middleware> $afterMiddleware = array()





* Visibility: **protected**


Methods
-------


### __construct

    mixed Nekrida\Routing\RouteItem::__construct($methods, $url, $callback, array $middleware)

RouteItem constructor.



* Visibility: **public**


#### Arguments
* $methods **mixed**
* $url **mixed**
* $callback **mixed**
* $middleware **array**



### after

    \Nekrida\Routing\RouteItem Nekrida\Routing\RouteItem::after($middleware)





* Visibility: **public**


#### Arguments
* $middleware **mixed**



### domain

    \Nekrida\Routing\RouteItem Nekrida\Routing\RouteItem::domain($domain)





* Visibility: **public**


#### Arguments
* $domain **mixed** - &lt;p&gt;string&lt;/p&gt;



### middleware

    \Nekrida\Routing\RouteItem Nekrida\Routing\RouteItem::middleware($middleware)





* Visibility: **public**


#### Arguments
* $middleware **mixed**



### xnamespace

    \Nekrida\Routing\RouteItem Nekrida\Routing\RouteItem::xnamespace($namespace)





* Visibility: **public**


#### Arguments
* $namespace **mixed** - &lt;p&gt;string&lt;/p&gt;



### name

    \Nekrida\Routing\RouteItem Nekrida\Routing\RouteItem::name($name)





* Visibility: **public**


#### Arguments
* $name **mixed** - &lt;p&gt;string&lt;/p&gt;



### prefix

    \Nekrida\Routing\RouteItem Nekrida\Routing\RouteItem::prefix($prefix)





* Visibility: **public**


#### Arguments
* $prefix **mixed** - &lt;p&gt;string&lt;/p&gt;



### where

    \Nekrida\Routing\RouteItem Nekrida\Routing\RouteItem::where($restrictions)





* Visibility: **public**


#### Arguments
* $restrictions **mixed** - &lt;p&gt;array&lt;/p&gt;



### getUrl

    string Nekrida\Routing\RouteItem::getUrl()





* Visibility: **public**




### getCallback

    callable Nekrida\Routing\RouteItem::getCallback()





* Visibility: **public**




### getName

    integer|string Nekrida\Routing\RouteItem::getName()





* Visibility: **public**




### getMethods

    array Nekrida\Routing\RouteItem::getMethods()





* Visibility: **public**




### getDomain

    string Nekrida\Routing\RouteItem::getDomain()





* Visibility: **public**




### getRestrictions

    array Nekrida\Routing\RouteItem::getRestrictions()





* Visibility: **public**




### getNamespace

    string Nekrida\Routing\RouteItem::getNamespace()





* Visibility: **public**




### getMiddlewares

    array|array<mixed,\Nekrida\Routing\Middleware> Nekrida\Routing\RouteItem::getMiddlewares()





* Visibility: **public**




### getAfter

    array<mixed,\Nekrida\Routing\Middleware> Nekrida\Routing\RouteItem::getAfter()





* Visibility: **public**




### getView

    mixed Nekrida\Routing\RouteItem::getView()





* Visibility: **public**



