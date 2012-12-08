<?php

namespace Apitrary\Command;

use Apitrary\Term\Color;

class Remove extends AbstractCommand implements CommandInterface
{
	public function render ()
	{
		$argv = $this->_input->getArguments();

		if (!isset($argv[2])) {
			throw new \Exception('You need to provide entity');
		}

		if ($argv[2] == 'help') {
			return $this->usage();
		}

		if (!isset($argv[3])) {
			throw new \Exception('You need to provide id');
		}

		$url = self::API_ENDPOINT . '/' . $argv[2] . '/' . $argv[3];
		$request = new \Apitrary\Http\Request();
		$response = $request->send($url, \Apitrary\Http\Request::VERB_DELETE);

		$return = 'Status code: ' . $response->statusCode() . PHP_EOL;
		$return .= 'Status message: ' . $response->statusMessage() . PHP_EOL;

		return $return;
	}

	public function identifier ()
	{
		return 'remove';
	}

	public function help ()
	{
		return Color::colorize('remove', Color::FG_GREEN) . '  Remove an object from the entity';
	}

	public function usage()
	{
		return 'apitrary remove [ENTITY] [ID]' . PHP_EOL;
	}

}
