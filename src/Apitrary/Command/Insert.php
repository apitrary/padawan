<?php

namespace Apitrary\Command;

use Apitrary\Term\Color;

class Insert extends AbstractCommand implements CommandInterface
{
	public function render()
	{
		$argv = $this->_input->getArguments();

		if ($argv[2] == 'help') {
			return $this->usage();
		}

		if (!isset($argv[2])) {
			throw new \Exception('Please provide an entity name');
		}

		if (count($argv) < 4) {
			throw new \Exception('You need to provide data');
		}

		$url = self::API_ENDPOINT . '/' . $argv[2];

		array_shift($argv);
		array_shift($argv);
		array_shift($argv);

		$data = $this->_prepareData($argv);
		$request = new \Apitrary\Http\Request();
		$request->setData($data);
		$response = $request->send($url, \Apitrary\Http\Request::VERB_POST);

		$return = 'Status code: ' . $response->statusCode() . PHP_EOL;
		$return .= '_id: ' . $response->result()->_id . PHP_EOL;
		$return .= 'Status message: ' . $response->statusMessage() . PHP_EOL;

		return $return;
	}

	public function identifier()
	{
		return 'insert';
	}

	public function help()
	{
		return Color::colorize('insert', Color::FG_GREEN) . '  Insert data into entity';
	}

	public function usage()
	{
		return 'apitrary insert [ENTITY] [KEY:VALUE]' . PHP_EOL;
	}

	private function _prepareData($data)
	{
		$parsed = array();

		foreach ($data as $row) {
			$parts = explode(':', $row);
			if (count($parts) !== 2) {
				throw new \Exception('Please provide your data in following format "name:value"');
			}
			$parsed[$parts[0]] = $parts[1];
		}

		return $parsed;
	}
}
