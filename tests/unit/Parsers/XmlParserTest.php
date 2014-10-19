<?php namespace SoapBox\Formatter\Test\Parsers;

use SoapBox\Formatter\Test\TestCase;
use SoapBox\Formatter\Parsers\ParserInterface;
use SoapBox\Formatter\Parsers\XmlParser;

class XmlParserTest extends TestCase {

	public function testXmlParserIsInstanceOfParserInterface() {
		$parser = new XmlParser('');
		$this->assertTrue($parser instanceof ParserInterface);
	}

}
