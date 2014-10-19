<?php namespace SoapBox\Formatter\Parsers;

class JsonParser implements ParserInterface {

	private $json;

	public function __construct($data) {
		$this->json = json_decode(trim($data));
	}

}
