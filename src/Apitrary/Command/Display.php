<?php

namespace Apitrary\Command;

use Apitrary\Term\Color;

class Display extends AbstractCommand implements CommandInterface
{
	public function render()
	{
		$argv = $this->_input->getArguments();

		if ($argv[2] == 'help') {
			return $this->usage();
		}

		if (!isset($argv[2])) {
			throw new \Exception('You need to provide entity you want to list');
		}

		$url = self::API_ENDPOINT . '/' . $argv[2];

		$request = new \Apitrary\Http\Request();
		$response = $request->send($url);

		$results = $response->result();
		$return = '';

		foreach ($results as $result) {
			$return .= Color::colorize('ID: ' . $result[0] . PHP_EOL, Color::FG_LIGHT_GREEN);
			$return .= $this->prettyPrintProperties($result[1]) . PHP_EOL;
		}

		return $return;
	}

	public function identifier()
	{
		return 'display';
	}

	public function help()
	{
		return Color::colorize('display', Color::FG_GREEN) . ' Display results from entity';
	}

	public function usage()
	{
		return 'apitrary display [ENTITY]' . PHP_EOL;
	}
}
