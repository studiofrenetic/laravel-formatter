<?php namespace SoapBox\Formatter\Parsers;

class ArrayParser implements ParserInterface {

	private $array;

	public function __construct($data) {
		$this->array = $data;
	}

}
