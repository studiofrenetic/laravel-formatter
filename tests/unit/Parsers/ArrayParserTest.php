<?php namespace SoapBox\Formatter\Test\Parsers;

use SoapBox\Formatter\Test\TestCase;
use SoapBox\Formatter\Parsers\ParserInterface;
use SoapBox\Formatter\Parsers\ArrayParser;

class ArrayParserTest extends TestCase {

	public function testArrayParserIsInstanceOfParserInterface() {
		$parser = new ArrayParser('');
		$this->assertTrue($parser instanceof ParserInterface);
	}

}
