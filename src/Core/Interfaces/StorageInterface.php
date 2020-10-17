<?php


namespace Nekrida\Core\Interfaces;

use Nekrida\Core\Response;

/**
 * Interface StorageInterface
 * @package Nekrida\Core
 */
interface StorageInterface
{
	/**
	 * Deletes the file
	 * @param $link
	 * @return bool
	 */
	public function delete($link);

	/**
	 * Returns response with the header to force download the file or link to the file
	 *
	 * Use Response::file($link) to print the file
	 *
	 * @param $link string
	 * @return Response
	 */
	public function download($link,$name);

	/**
	 * Returns response with the header to the file or the file itself
	 *
	 * Use Response::file($link) to print the file
	 *
	 * @param $link string
	 * @return Response
	 */
	public function get($link);

	/**
	 * Replaces the file by new file.
	 * @param $file array $_FILES typed array
	 * @param $link string
	 */
	public function patch($file, $link);

	/**
	 * Uploads the file and returns the url to this file
	 * @param $file array $_FILES typed array
	 * @param array $options
	 * @param $storage string Name of the storage (configured at 'config/storage.php')
	 * @return bool|string returns file path or false on error
	 */
	public function put($file, $options, $storage);

	/**
	 * Returns real link to the object from the virtual link set in the configurations.
	 * @param string $link
	 * @return string
	 */
	public function url($link);
}