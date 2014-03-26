<?php

use SoapBox\Formatter\Formatter;
//use Mockery as m;

class FormatterTest extends Orchestra\Testbench\TestCase {

	public function setUp() {
		parent::setUp();

		//$app = m::mock('AppMock');
		//$app->shouldReceive('instance')->once()->andReturn($app);

		//Illuminate\Support\Facades\Facade::setFacadeApplication($app);
		//Illuminate\Support\Facades\Config::swap($config = m::mock('ConfigMock'));
		//Illuminate\Support\Facades\Lang::swap($lang = m::mock('ConfigLang'));

		//$config->shouldReceive('get')->once()->with('logviewer::log_dirs')->andReturn(array('app' => 'app/storage/logs'));
		//$this->logviewer = new Logviewer('app', 'cgi-fcgi', '2013-06-01');
	}
	/**
	 * A basic functional test for JSON to Array conversion
	 *
	 * @return void
	 */
	public function testJsonToArray() {
		$data = '{"foo":"bar","bar":"foo"}';
		$result = Formatter::make($data, 'json')->to_array();
		$expected = array('foo'=>'bar', 'bar'=>'foo');
		$this->assertEquals($expected, $result);
	}

	/**
	 * A basic functional test for Array to JSON conversion
	 *
	 * @return void
	 */
	public function testArrayToJson() {
		$data = array('foo'=>'bar', 'bar'=>'foo');
		
		$result = Formatter::make($data)->to_json();
		$expected = '{"foo":"bar","bar":"foo"}';
		$this->assertEquals($expected, $result);
	}

	/**
	 * A basic functional test for testJSONToXMLToArrayToJsonToArray data to array
	 *
	 * @return void
	 */
	public function testJSONToXMLToArrayToJsonToArray() {
		$data = '{"foo":"bar","bar":"foo"}';
		
		$result = Formatter::make($data, 'json')->to_xml();
		$result = Formatter::make($result, 'xml')->to_array();
		$result = Formatter::make($result, 'array')->to_json();
		$result = Formatter::make($result, 'json')->to_array();
		
		$expected = array('foo'=>'bar', 'bar'=>'foo');
		
		$this->assertEquals($expected, $result);
	}

	/**
	 * A basic functional test for CSV data to array
	 *
	 * @return void
	 */
	public function testCSVToArray() {
		$data = "foo,bar,bing,bam,boom";
		$result = Formatter::make($data, 'csv')->to_array();
		$expected = array('foo'=>'bar', 'bar'=>'foo');
		var_dump($result);
		var_dump($expected);
		die('dead');
		$this->assertEquals($expected, $result);
	}

	/**
	 * A basic functional test for CSV data to array
	 *
	 * @return void
	 */
	public function testArrayToCSV() {
		$expected = array('foo'=>'bar', 'bar'=>'foo');
		$result = Formatter::make($data, 'array')->to_csv();
		var_dump($result);

		$expected = "foo,bar,bing,bam,boom";
		$this->assertEquals($expected, $result);
	}
}