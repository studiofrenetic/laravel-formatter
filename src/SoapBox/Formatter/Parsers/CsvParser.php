<?php namespace SoapBox\Formatter\Parsers;

use League\Csv\Reader;

class CsvParser implements ParserInterface {

	private $csv;

	public function __construct($data) {
		$this->csv = Reader::createFromString($data);
	}

}
