<?php

namespace Apitrary\Command;

abstract class AbstractCommand
{
	const API_ENDPOINT = '';

	protected $_input;

	public function setInput($input)
	{
		$this->_input = $input;
	}

	public function prettyPrintProperties($object)
	{
		$properties = (array) $object;
		$return = '';

		foreach ($properties as $name => $value) {
			$return .= $name . ': ' . $value . PHP_EOL;
		}

		return $return;
	}
}
