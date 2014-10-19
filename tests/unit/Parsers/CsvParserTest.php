<?php namespace SoapBox\Formatter\Test\Parsers;

use SoapBox\Formatter\Test\TestCase;
use SoapBox\Formatter\Parsers\ParserInterface;
use SoapBox\Formatter\Parsers\CsvParser;

class CsvParserTest extends TestCase {

	public function testCsvParserIsInstanceOfParserInterface() {
		$parser = new CsvParser('');
		$this->assertTrue($parser instanceof ParserInterface);
	}

    /**
     * @expectedException InvalidArgumentException
     */
	public function testConstructorThrowsInvalidExecptionWhenArrayDataIsProvided() {
		$parser = new CsvParser([0, 1, 3]);
	}

	public function testtoArrayReturnsCsvArrayRepresentation() {
		$expected = [['foo' => 'bar', 'boo' => 'far']];

		$csv = 'foo,boo
bar,far';
		$parser = new CsvParser($csv);

		$this->assertEquals($expected, $parser->toArray());
	}
}
