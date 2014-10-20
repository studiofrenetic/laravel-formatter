<?php namespace SoapBox\Formatter\Test\Parsers;

use SoapBox\Formatter\Test\TestCase;
use SoapBox\Formatter\Parsers\Parser;
use SoapBox\Formatter\Parsers\CsvParser;

class CsvParserTest extends TestCase {

	private $simpleCsv = 'foo,boo
bar,far';

	public function testCsvParserIsInstanceOfParserInterface() {
		$parser = new CsvParser('');
		$this->assertTrue($parser instanceof Parser);
	}

    /**
     * @expectedException InvalidArgumentException
     */
	public function testConstructorThrowsInvalidExecptionWhenArrayDataIsProvided() {
		$parser = new CsvParser([0, 1, 3]);
	}

	public function testtoArrayReturnsCsvArrayRepresentation() {
		$expected = [['foo' => 'bar', 'boo' => 'far']];
		$parser = new CsvParser($this->simpleCsv);
		$this->assertEquals($expected, $parser->toArray());
	}

	public function testtoJsonReturnsJsonRepresentationOfNamedArray() {
		$expected = '[{"foo":"bar","boo":"far"}]';
		$parser = new CsvParser($this->simpleCsv);
		$this->assertEquals($expected, $parser->toJson());
	}

}
