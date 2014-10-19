<?php namespace SoapBox\Formatter\Test;

use SoapBox\Formatter\Formatter;

class FormatterTest extends TestCase {

	public function testFormatterProvidesCsvConstant() {
		$expected = 'csv';
		$actual = Formatter::Csv;

		$this->assertEquals($expected, $actual);
	}

	public function testFormatterProvidesJsonConstant() {
		$expected = 'json';
		$actual = Formatter::Json;

		$this->assertEquals($expected, $actual);
	}

	public function testFormatterProvidesXmlConstant() {
		$expected = 'xml';
		$actual = Formatter::Xml;

		$this->assertEquals($expected, $actual);
	}

	public function testFormatterProvidesArrayConstant() {
		$expected = 'array';
		$actual = Formatter::Arr;

		$this->assertEquals($expected, $actual);
	}

    /**
     * @expectedException InvalidArgumentException
     */
	public function testFormatterMakeThrowsInvalidTypeException() {
		$formatter = Formatter::make('', 'blue');
	}

}
