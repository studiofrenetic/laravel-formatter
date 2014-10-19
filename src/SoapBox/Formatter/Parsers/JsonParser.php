<?php namespace SoapBox\Formatter\Parsers;

class JsonParser extends ParserInterface {

	private $json;

	public function __construct($data) {
		$this->json = json_decode(trim($data));
	}

	public function toArray() {
		return (array) $this->json;
	}

}
