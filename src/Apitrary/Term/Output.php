<?php

namespace Apitrary\Term;

class Output
{

	private $_command;

	public function __construct($command)
	{
		$this->_command = $command;
	}

	public function output()
	{
		return $this->_command->render();
	}

}
