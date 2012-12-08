<?php

namespace Apitrary\Command;

interface CommandInterface {
	public function render();
	public function identifier();
	public function help();
}
