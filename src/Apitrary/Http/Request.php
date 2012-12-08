<?php

namespace Apitrary\Http;

class Request {

	const VERB_POST = 'POST';
	const VERB_DELETE = 'DELETE';

	private $_data;

	public function send($url, $verb = null)
	{
		$options = array(
			'X-Api-Key: af9207ac17bb71292081b308c445c8c4701d537b7c0efe610cc47646369760cd',
			'Content-Type: application/json',
			'Accept: application/json',
			'User-Agent: Apitrary CLI Client',
		);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $options);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if (!empty($this->_data)) {
			switch ($verb) {
				case self::VERB_POST:
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->_data));
					break;
				case self::VERB_DELETE:
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
					break;
				default:
					throw new \Exception('Cannot set data for current verb');
			}
		}

		$response = curl_exec($ch);

		// TODO Improve! Do not rely on response body, validate headers.

		if (preg_match('#html.*404.*\/html#', $response)) {
			throw new \Exception($response);
		}

		return new Response($response);
	}

	public function setData(array $data)
	{
		$this->_data = $data;
	}
}