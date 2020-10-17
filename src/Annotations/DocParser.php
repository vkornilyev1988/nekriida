<?php

namespace Nekrida\Annotations;

class DocParser
{
	protected $array = [];

	public function __construct($doc) {
		$this->array = $this->parse($doc);
	}

	public function get($key) {
		if (isset($this->array[$key]))
			return $this->array[$key];
		return null;
	}

	public function getFirst($key) {
		if ( isset($this->array[$key])
			&& isset($this->array[$key][0]) )
			return $this->array[$key][0];
		return null;
	}

	public function has($key) {
		return array_key_exists($key,$this->array);
	}

	public function getMany($keys) {
		$array = [];
		foreach ($keys as $key) {
			$value = $this->get($key);
			if ($value)
				$array[$key] = $value;
		}
		return $array;
	}

	public function getAll() {
		return $this->array;
	}

	/**
	 * Parses the doc comments
	 * @param string $doc
	 * @return array Parsed doc comments split by parameters
	 */
	public function parse($doc) {
		//Remove unnecessary *'s
		$a = trim(substr($doc,3,strlen($doc)-5));

		//Split into rows
		$rows = explode("\n",$a);

		//@s started
		$ats = false;

		$result = [];
		$paramName = '';

		foreach ($rows as $item) {
			//Everything before @s is a description
			if (!$ats && strpos($item,'@'))
				$ats = true;
			//Remove *
			$firstStar = strpos($item,'*');
			$actualText = trim(substr($item,$firstStar + 2)); // Exclude space after *
			//Ignore empty lines
			if (!$actualText)
				continue;
			if (!$ats) {
				if (!isset($result['description']))
					$result['description'] = '';
				$result['description'] .= ($result['description'] ? "\n" : "") . $actualText;
			} else {
				//IF row starts with @
				//THEN It is a new parameter
				//ELSE It is a continue of the previous line
				if (strpos($actualText,'@') === 0) {
					//space between @param and value
					$firstSpace = strpos($actualText, ' ', 1);

					//Because if the 3rd parameter for the substr is null, the function returns empty string instead of the full string
					if ($firstSpace)
						$paramName = substr($actualText, 1, $firstSpace - 1);
					else
						$paramName = substr($actualText, 1);

					//Some parameters don't have values, they will have bool(true)
					$value = $firstSpace ? substr($actualText, strpos($actualText, ' ', 1) + 1) : true;

					$result[$paramName][] = $value;
				} else {
					$result[$paramName][count($result[$paramName]) - 1] .= "\n". $actualText;
				}
			}
		}
		return $result;
	}
}