Nekrida\Core\Request
===============

Class Request
Read-only class containing user input




* Class name: Request
* Namespace: Nekrida\Core





Properties
----------


### $url

    protected string $url





* Visibility: **protected**


### $domain

    protected string $domain





* Visibility: **protected**


### $guid

    protected string $guid





* Visibility: **protected**


### $get

    protected array $get





* Visibility: **protected**


### $post

    protected array $post





* Visibility: **protected**


### $server

    protected array $server





* Visibility: **protected**


### $session

    protected array $session





* Visibility: **protected**


### $cookie

    protected array $cookie





* Visibility: **protected**


### $files

    protected array $files





* Visibility: **protected**


### $input

    protected array $input





* Visibility: **protected**


### $cache

    protected array $cache = array()





* Visibility: **protected**


Methods
-------


### get

    array|null Nekrida\Core\Request::get(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### post

    array|null Nekrida\Core\Request::post(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### server

    array|null Nekrida\Core\Request::server(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### session

    array|null Nekrida\Core\Request::session(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### cookie

    array|null Nekrida\Core\Request::cookie(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### files

    array|null Nekrida\Core\Request::files(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### input

    array|null Nekrida\Core\Request::input(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### cache

    array|null Nekrida\Core\Request::cache(null|string $key)





* Visibility: **public**


#### Arguments
* $key **null|string**



### url

    array|null Nekrida\Core\Request::url()





* Visibility: **public**




### guid

    array|null Nekrida\Core\Request::guid()





* Visibility: **public**




### domain

    array|null Nekrida\Core\Request::domain()





* Visibility: **public**




### method

    array|null Nekrida\Core\Request::method()





* Visibility: **public**




### setGet

    \Nekrida\Core\Request Nekrida\Core\Request::setGet($get)





* Visibility: **public**


#### Arguments
* $get **mixed**



### setPost

    \Nekrida\Core\Request Nekrida\Core\Request::setPost($post)





* Visibility: **public**


#### Arguments
* $post **mixed**



### setServer

    \Nekrida\Core\Request Nekrida\Core\Request::setServer($server)





* Visibility: **public**


#### Arguments
* $server **mixed**



### setSession

    \Nekrida\Core\Request Nekrida\Core\Request::setSession($session)





* Visibility: **public**


#### Arguments
* $session **mixed**



### setCookie

    \Nekrida\Core\Request Nekrida\Core\Request::setCookie($cookie)





* Visibility: **public**


#### Arguments
* $cookie **mixed**



### setFiles

    \Nekrida\Core\Request Nekrida\Core\Request::setFiles($files)





* Visibility: **public**


#### Arguments
* $files **mixed**



### setInput

    \Nekrida\Core\Request Nekrida\Core\Request::setInput($input)





* Visibility: **public**


#### Arguments
* $input **mixed**



### setDomain

    \Nekrida\Core\Request Nekrida\Core\Request::setDomain($domain)





* Visibility: **public**


#### Arguments
* $domain **mixed**



### setUrl

    \Nekrida\Core\Request Nekrida\Core\Request::setUrl(string $url)





* Visibility: **public**


#### Arguments
* $url **string**



### setGUID

    \Nekrida\Core\Request Nekrida\Core\Request::setGUID($guid)





* Visibility: **public**


#### Arguments
* $guid **mixed**



### setCache

    \Nekrida\Core\Request Nekrida\Core\Request::setCache($key, $value)





* Visibility: **public**


#### Arguments
* $key **mixed**
* $value **mixed**



### getValueByKey

    null Nekrida\Core\Request::getValueByKey($array, $key)





* Visibility: **protected**


#### Arguments
* $array **mixed** - &lt;p&gt;array&lt;/p&gt;
* $key **mixed** - &lt;p&gt;string&lt;/p&gt;


