<?php namespace SoapBox\Formatter\Parsers;

use InvalidArgumentException;
use League\Csv\Reader;

class CsvParser extends ParserInterface {

	private $csv;

	public function __construct($data) {
		if (is_string($data)) {
			$this->csv = Reader::createFromString($data);
		} else {
			throw new InvalidArgumentException(
				'CsvParser only accepts (string) [csv] for $data.'
			);
		}
	}

	public function toArray() {
		$temp = $this->csv->jsonSerialize();

		$headings = $temp[0];

		$result = [];
		for ($i = 1; $i < count($temp); ++$i) {
			$row = [];
			for ($j = 0; $j < count($headings); ++$j) {
				$row[$headings[$j]] = $temp[$i][$j];
			}
			$result[] = $row;
		}

		return $result;
	}
}
