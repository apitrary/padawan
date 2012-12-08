<?php

namespace Apitrary\Http;

class Response {

	private $_body;

	public function __construct($body)
	{
		$this->_body = json_decode($body);
	}

	public function __call($method, $params)
	{
		return isset($this->_body->{$method}) ? $this->_body->{$method} : null;
	}

	public function isError()
	{
		die(var_dump($this->_body));
	}

	public function getError()
	{

	}
}
