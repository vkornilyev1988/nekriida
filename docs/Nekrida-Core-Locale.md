Nekrida\Core\Locale
===============

Class Locale




* Class name: Locale
* Namespace: Nekrida\Core





Properties
----------


### $lang

    protected array $lang





* Visibility: **protected**
* This property is **static**.


### $locale

    protected string $locale





* Visibility: **protected**
* This property is **static**.


Methods
-------


### getLangPack

    array|false Nekrida\Core\Locale::getLangPack(\Nekrida\Core\Request $request)

Returns the locale file



* Visibility: **public**
* This method is **static**.


#### Arguments
* $request **[Nekrida\Core\Request](Nekrida-Core-Request.md)**



### resetLocale

    mixed Nekrida\Core\Locale::resetLocale()

Clears the locale cache



* Visibility: **public**
* This method is **static**.




### loadLangPack

    array|false Nekrida\Core\Locale::loadLangPack($locale)

Returns LangPack by requested locale



* Visibility: **protected**
* This method is **static**.


#### Arguments
* $locale **mixed**



### detectClientLanguage

    array|false Nekrida\Core\Locale::detectClientLanguage($languagesHeader)





* Visibility: **protected**
* This method is **static**.


#### Arguments
* $languagesHeader **mixed** - &lt;p&gt;array&lt;/p&gt;


