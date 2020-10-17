<?php


namespace Nekrida\Storage;


use Nekrida\Core\Config;
use Nekrida\Core\Response;
use Nekrida\Core\Storage;
use Nekrida\Core\Interfaces\StorageInterface;

/**
 * Class LocalStorage
 * @package Nekrida\Storage
 */
class LocalStorage implements StorageInterface
{

	/**
	 * Deletes the file
	 * @param $link
	 * @return bool
	 */
	public function delete($link)
	{
		return unlink($this->url($link));
	}

	/**
	 * Returns response with the header to force download the file or link to the file
	 *
	 * Use Response::file($link) to print the file
	 *
	 * @param string $link
	 * @param string $name file name for downloader
	 * @return Response
	 */
	public function download($link, $name)
	{
		// TODO: Implement download() method.
	}

	/**
	 * Returns response with the header to the file or the file itself
	 *
	 * Use Response::file($link) to print the file
	 *
	 * @param string $link
	 * @return Response
	 */
	public function get($link)
	{
		// TODO: Implement get() method.
	}

	/**
	 * Replaces the file by new file.
	 * @param $file array $_FILES typed array
	 * @param $link string
	 * @return bool
	 */
	public function patch($file, $link)
	{
		// TODO: Implement patch() method.
		$realLink = $this->url($link);

		//TODO: Throw FileSystemAccessDeniedException
		return move_uploaded_file($file['tmp_name'],$realLink);
	}

	/**
	 * Uploads the file and returns the url to this file
	 * @param $file array $_FILES typed array
	 * @param array $options
	 * @param $storage string Name of the storage (configured at 'config/storage.php')
	 * @return bool|string returns file path or false on error
	 */
	public function put($file, $options, $storage)
	{
		// TODO: Implement put() method.
		if ($file['error'] != 0) return false;

		// {name} and {ext}
		$options['name'] = $file['name'];
		$ext = strpos($file['name'],'.');
		$options['ext'] = $ext ? '' : substr($file['name'],$ext - 1);

		$uploadFile = preg_replace_callback('/{(\w+)}/', function ($matches) use ($options, $storage) {
			$this->fillName($matches[1],$storage,$options);
		}, Config::get("storage/{$storage}/fileTemplate"));

		$uploadDir = preg_replace_callback('/{(\w+)}/', function ($matches) use ($options, $storage) {
			$this->fillName($matches[1],$storage,$options);
		}, Config::get("storage/{$storage}/directory"));

		$root = Config::get("storage/{$storage}/root");

		if (!file_exists($root))
			//TODO: Throw FileSystemAccessDeniedException
			mkdir($root.'/'.$uploadDir,0777,true);

		if (!move_uploaded_file($file['tmp_name'],$root.'/'.$uploadDir.'/'.$uploadFile))
			//TODO: Throw FileSystemAccessDeniedException
			return false;
		return Storage::STORAGE_PREFIX.$storage.'://'.$uploadDir.'/'.$uploadFile;
	}

	protected function fillName($match, $storage, $options) {
		if (isset($options[$match]))
			return $options[$match];
		if (Config::get("storage/{$storage}/random/{$match}")) {
			$size = Config::get("storage/{$storage}/random/{$match}/size");
			$symbols = Config::get("storage/{$storage}/random/{$match}/symbols");
			return $this->genRandomString($size,$symbols);
		}

		//TODO: Throw ParameterNotFoundException because it can cause an error when we create the directory
		return '';
	}

	protected function genRandomString($size,$symbols) {
		$str = '';
		$symbolsMax = count($symbols) - 1;
		for ($i = 0; $i < $size; $i++)
			$str .= $symbols[rand(0,$symbolsMax)];
		return $str;
	}

	/**
	 * Returns real link to the object from the virtual link set in the configurations.
	 * @param string $link
	 * @return string
	 */
	public function url($link)
	{
		$storage = Storage::getStorageName($link);
		$root = Config::get("storage/{$storage}/root");
		$url = $root.'/'.substr($link,strpos($link,'://'));

		return $url;
	}
}