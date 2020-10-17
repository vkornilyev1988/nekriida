Nekrida\Routing\Route
===============

Class Route




* Class name: Route
* Namespace: Nekrida\Routing





Properties
----------


### $routes

    protected array<mixed,\Nekrida\Routing\RouteItem> $routes = array()





* Visibility: **protected**
* This property is **static**.


### $currentRoute

    protected \Nekrida\Routing\RouteItem $currentRoute





* Visibility: **protected**
* This property is **static**.


Methods
-------


### importFromCache

    mixed Nekrida\Routing\Route::importFromCache()





* Visibility: **public**
* This method is **static**.




### importFromTemplate

    mixed Nekrida\Routing\Route::importFromTemplate($filesRegex)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $filesRegex **mixed**



### getRoutes

    array<mixed,\Nekrida\Routing\RouteItem> Nekrida\Routing\Route::getRoutes()





* Visibility: **public**
* This method is **static**.




### setCurrentRoute

    mixed Nekrida\Routing\Route::setCurrentRoute(\Nekrida\Routing\RouteItem $currentRoute)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $currentRoute **[Nekrida\Routing\RouteItem](Nekrida-Routing-RouteItem.md)**



### addRoute

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::addRoute(\Nekrida\Routing\RouteItem $route)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $route **[Nekrida\Routing\RouteItem](Nekrida-Routing-RouteItem.md)**



### nameRoute

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::nameRoute(\Nekrida\Routing\RouteItem $route, $name)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $route **[Nekrida\Routing\RouteItem](Nekrida-Routing-RouteItem.md)**
* $name **mixed**



### route

    \Nekrida\Routing\RouteItem|null Nekrida\Routing\Route::route(boolean|string $name)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $name **boolean|string**



### serialize

    mixed Nekrida\Routing\Route::serialize()





* Visibility: **public**
* This method is **static**.




### match

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::match(array<mixed,string> $methods, string $url, string|callable $callback)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $methods **array&lt;mixed,string&gt;** - &lt;p&gt;array of methods&lt;/p&gt;
* $url **string**
* $callback **string|callable**



### any

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::any(string $url, string|callable $callback)

Any methods



* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string**
* $callback **string|callable**



### delete

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::delete(string $url, string|callable $callback)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string**
* $callback **string|callable**



### get

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::get(string $url, string|callable $callback)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string**
* $callback **string|callable**



### patch

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::patch(string $url, string|callable $callback)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string**
* $callback **string|callable**



### post

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::post(string $url, string|callable $callback)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **string**
* $callback **string|callable**



### put

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::put($url, $callback)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **mixed**
* $callback **mixed**



### domain

    \Nekrida\Routing\RouteGroup Nekrida\Routing\Route::domain($domain)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $domain **mixed**



### middleware

    \Nekrida\Routing\RouteGroup Nekrida\Routing\Route::middleware($middleware)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $middleware **mixed**



### xnamespace

    \Nekrida\Routing\RouteGroup Nekrida\Routing\Route::xnamespace($namespace)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $namespace **mixed**



### prefix

    \Nekrida\Routing\RouteGroup Nekrida\Routing\Route::prefix($prefix)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $prefix **mixed**



### getCurrentRoute

    \Nekrida\Routing\RouteItem Nekrida\Routing\Route::getCurrentRoute()





* Visibility: **public**
* This method is **static**.



