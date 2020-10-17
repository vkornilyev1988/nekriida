Nekrida\Routing\Router
===============

Class Router




* Class name: Router
* Namespace: Nekrida\Routing





Properties
----------


### $request

    protected \Nekrida\Core\Request $request





* Visibility: **protected**


Methods
-------


### __construct

    mixed Nekrida\Routing\Router::__construct(\Nekrida\Core\Request $request)

Router constructor.



* Visibility: **public**


#### Arguments
* $request **[Nekrida\Core\Request](Nekrida-Core-Request.md)**



### run

    \Nekrida\Core\Response Nekrida\Routing\Router::run()





* Visibility: **public**




### handle

    \Nekrida\Core\Response Nekrida\Routing\Router::handle()





* Visibility: **public**




### checkRestrictions

    boolean Nekrida\Routing\Router::checkRestrictions($values, $restrictions)

Checks if input values correspond to restrictions



* Visibility: **protected**


#### Arguments
* $values **mixed**
* $restrictions **mixed** - &lt;p&gt;array &lt;code&gt;name =&gt; Regex_string&lt;/code&gt;&lt;/p&gt;



### handleMiddleware

    boolean Nekrida\Routing\Router::handleMiddleware($middlewares, $param, $namespace)





* Visibility: **protected**


#### Arguments
* $middlewares **mixed**
* $param **mixed**
* $namespace **mixed**



### invoke

    boolean|mixed Nekrida\Routing\Router::invoke($func, $param, string $namespace)





* Visibility: **protected**


#### Arguments
* $func **mixed**
* $param **mixed**
* $namespace **string**



### notFound

    \Nekrida\Core\Response Nekrida\Routing\Router::notFound()





* Visibility: **protected**



