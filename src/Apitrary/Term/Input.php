<?php

namespace Apitrary\Term;

class Input
{
	private $_commands;

	public function __construct($argv)
	{
		$this->_argv = $argv;
		$this->_commands = new \SplObjectStorage();
	}

	public function attach(\Apitrary\Command\CommandInterface $command)
	{
		$this->_commands->attach($command);
	}

	public function getArguments()
	{
		return $this->_argv;
	}

	public function output()
	{
		print Color::head('Apitrary CLI Client' . PHP_EOL . PHP_EOL);

		if (count($this->_argv) === 1) {
			$help = '';
			foreach ($this->_commands as $command) {
				$help .= $command->help() . PHP_EOL;
			}
			return $help;
		}

		foreach ($this->_commands as $command) {
			if ($command->identifier() == $this->_argv[1]) {
				$command->setInput($this);
				$output = new Output($command);
				try {
					return $output->output();
				} catch (\Exception $e) {
					return Color::error($e->getMessage());
				}
			}
		}
	}
}