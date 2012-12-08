<?php

namespace Apitrary\Command;

use Apitrary\Term\Color;

class Show extends AbstractCommand implements CommandInterface
{
	public function render()
	{
		$argv = $this->_input->getArguments();

		if (isset($argv[2]) && $argv[2] == 'help') {
			return $this->usage();
		}

		$request = new \Apitrary\Http\Request();
		$response = $request->send(self::API_ENDPOINT . '/');
		$schemas = $response->schema();

		$return = \Apitrary\Term\Color::head('Following entities exist:' . PHP_EOL);

		foreach ($schemas as $schema) {
			$return .= $schema . PHP_EOL;
		}

		return $return;
	}

	public function help()
	{
		return Color::colorize('show	', Color::FG_GREEN) . '    List available entities';
	}

	public function identifier()
	{
		return 'show';
	}

	public function usage()
	{
		return 'apitrary show' . PHP_EOL;
	}
}
