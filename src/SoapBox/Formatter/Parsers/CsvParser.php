<?php namespace SoapBox\Formatter\Parsers;

class CsvParser implements ParserInterface {

	public function __construct($data) {
		$this->data = $data;
	}

	public function asObject() {
	}

}
