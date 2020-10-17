Nekrida\Core\Response
===============

Class Response




* Class name: Response
* Namespace: Nekrida\Core





Properties
----------


### $request

    protected \Nekrida\Core\Request $request





* Visibility: **protected**


### $headers

    protected array $headers = array()





* Visibility: **protected**
* This property is **static**.


### $httpStatus

    protected integer $httpStatus = 200





* Visibility: **protected**
* This property is **static**.


### $body

    protected string $body





* Visibility: **protected**


### $link

    protected string $link





* Visibility: **protected**


Methods
-------


### __construct

    mixed Nekrida\Core\Response::__construct(\Nekrida\Core\Request $request)

Response constructor.



* Visibility: **public**


#### Arguments
* $request **[Nekrida\Core\Request](Nekrida-Core-Request.md)**



### postRender

    string Nekrida\Core\Response::postRender($text)





* Visibility: **public**


#### Arguments
* $text **mixed**



### file

    \Nekrida\Core\Response Nekrida\Core\Response::file($link)

Respond file



* Visibility: **public**


#### Arguments
* $link **mixed**



### json

    \Nekrida\Core\Response Nekrida\Core\Response::json(array $parameters)

Generate json response



* Visibility: **public**


#### Arguments
* $parameters **array**



### render

    \Nekrida\Core\Response Nekrida\Core\Response::render($view, array $parameters)

Generate html page response with layout



* Visibility: **public**


#### Arguments
* $view **mixed** - &lt;p&gt;string&lt;/p&gt;
* $parameters **array**



### view

    \Nekrida\Core\Response Nekrida\Core\Response::view($view, array $parameters)

Generate html page response



* Visibility: **public**


#### Arguments
* $view **mixed** - &lt;p&gt;string&lt;/p&gt;
* $parameters **array**



### redirect

    \Nekrida\Core\Response Nekrida\Core\Response::redirect($link, array $options, integer $httpStatus)

Generates http redirect



* Visibility: **public**


#### Arguments
* $link **mixed**
* $options **array**
* $httpStatus **integer**



### generateUrl

    string|array<mixed,string>|null Nekrida\Core\Response::generateUrl($url, array $parameters)

Returns url filled with parameters



* Visibility: **public**


#### Arguments
* $url **mixed**
* $parameters **array**



### header

    mixed Nekrida\Core\Response::header($key, $value, boolean $stack)

Set header



* Visibility: **public**


#### Arguments
* $key **mixed** - &lt;p&gt;string&lt;/p&gt;
* $value **mixed** - &lt;p&gt;string&lt;/p&gt;
* $stack **boolean**



### status

    \Nekrida\Core\Response Nekrida\Core\Response::status($httpStatus)

Set http status



* Visibility: **public**


#### Arguments
* $httpStatus **mixed** - &lt;p&gt;int&lt;/p&gt;



### getStatus

    integer Nekrida\Core\Response::getStatus()





* Visibility: **public**
* This method is **static**.




### setStatus

    mixed Nekrida\Core\Response::setStatus($httpStatus)

Set http status



* Visibility: **public**
* This method is **static**.


#### Arguments
* $httpStatus **mixed** - &lt;p&gt;int&lt;/p&gt;



### getHeaders

    array Nekrida\Core\Response::getHeaders()





* Visibility: **public**
* This method is **static**.




### getBody

    mixed Nekrida\Core\Response::getBody()





* Visibility: **public**




### hasLink

    boolean Nekrida\Core\Response::hasLink()





* Visibility: **public**




### printLink

    mixed Nekrida\Core\Response::printLink()





* Visibility: **public**




### getView

    mixed Nekrida\Core\Response::getView($view)

Get real path to the view



* Visibility: **protected**


#### Arguments
* $view **mixed**


