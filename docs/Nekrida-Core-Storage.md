Nekrida\Core\Storage
===============

Class Storage




* Class name: Storage
* Namespace: Nekrida\Core



Constants
----------


### STORAGE_PREFIX

    const STORAGE_PREFIX = "st@"







Methods
-------


### getDriver

    mixed Nekrida\Core\Storage::getDriver($storage)





* Visibility: **protected**
* This method is **static**.


#### Arguments
* $storage **mixed**



### delete

    boolean Nekrida\Core\Storage::delete($link)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $link **mixed**



### download

    mixed Nekrida\Core\Storage::download($link, $name, $mimeType)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $link **mixed**
* $name **mixed**
* $mimeType **mixed**



### get

    mixed Nekrida\Core\Storage::get($link, $mimeType)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $link **mixed**
* $mimeType **mixed**



### put

    mixed Nekrida\Core\Storage::put($file, $storage, array $options)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $file **mixed**
* $storage **mixed**
* $options **array**



### url

    string Nekrida\Core\Storage::url($link)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $link **mixed**



### getStorageName

    mixed Nekrida\Core\Storage::getStorageName($url)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $url **mixed**


