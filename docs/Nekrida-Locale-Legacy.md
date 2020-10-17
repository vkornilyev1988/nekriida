Nekrida\Locale\Legacy
===============

Class Legacy




* Class name: Legacy
* Namespace: Nekrida\Locale
* Parent class: [Nekrida\Core\Locale](Nekrida-Core-Locale.md)



Constants
----------


### LOCALE_TEXT_PATTERN1

    const LOCALE_TEXT_PATTERN1 = "/\{\# (.*?) \{ (.*?) \} \#\}/mu"





### LOCALE_TEXT_PATTERN2

    const LOCALE_TEXT_PATTERN2 = '/{\# (.*?) \#}/mu'





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


### localize

    string Nekrida\Locale\Legacy::localize(string $page, \Nekrida\Core\Request $request)

Returns localized string



* Visibility: **public**
* This method is **static**.


#### Arguments
* $page **string**
* $request **[Nekrida\Core\Request](Nekrida-Core-Request.md)**



### getLangPack

    array|false Nekrida\Core\Locale::getLangPack(\Nekrida\Core\Request $request)

Returns the locale file



* Visibility: **public**
* This method is **static**.
* This method is defined by [Nekrida\Core\Locale](Nekrida-Core-Locale.md)


#### Arguments
* $request **[Nekrida\Core\Request](Nekrida-Core-Request.md)**



### resetLocale

    mixed Nekrida\Core\Locale::resetLocale()

Clears the locale cache



* Visibility: **public**
* This method is **static**.
* This method is defined by [Nekrida\Core\Locale](Nekrida-Core-Locale.md)




### loadLangPack

    array|false Nekrida\Core\Locale::loadLangPack($locale)

Returns LangPack by requested locale



* Visibility: **protected**
* This method is **static**.
* This method is defined by [Nekrida\Core\Locale](Nekrida-Core-Locale.md)


#### Arguments
* $locale **mixed**



### detectClientLanguage

    array|false Nekrida\Core\Locale::detectClientLanguage($languagesHeader)





* Visibility: **protected**
* This method is **static**.
* This method is defined by [Nekrida\Core\Locale](Nekrida-Core-Locale.md)


#### Arguments
* $languagesHeader **mixed** - &lt;p&gt;array&lt;/p&gt;


