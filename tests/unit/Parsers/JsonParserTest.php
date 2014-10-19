<?php namespace SoapBox\Formatter\Test\Parsers;

use SoapBox\Formatter\Test\TestCase;
use SoapBox\Formatter\Parsers\ParserInterface;
use SoapBox\Formatter\Parsers\JsonParser;

class JsonParserTest extends TestCase {

	public function testJsonParserIsInstanceOfParserInterface() {
		$parser = new JsonParser('');
		$this->assertTrue($parser instanceof ParserInterface);
	}

	public function testtoArrayReturnsArrayRepresentationOfJsonObject() {
		$expected = ['foo' => 'bar'];
		$parser = new JsonParser('{"foo": "bar"}');
		$this->assertEquals($expected, $parser->toArray());
	}

}
