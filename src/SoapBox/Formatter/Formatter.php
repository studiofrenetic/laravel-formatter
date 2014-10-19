<?php namespace SoapBox\Formatter;

use InvalidArgumentException;

class Formatter {
	/**
	 * Add class constants that help define input format
	 */
	const Csv  = 'csv';
	const Json = 'json';
	const Xml  = 'xml';
	const Arr  = 'array';

	private static $supportedTypes = [self::Csv, self::Json, self::Xml, self::Arr];

	/**
	 * Make: Returns an instance of formatter initialized with data and type
	 *
	 * @param mixed $data The data that formatter should parse
	 * @param string $type The type of data formatter is expected to parse
	 *
	 * @return Formatter
	 */
	public static function make($data, $type) {
		if (in_array($type, self::$supportedTypes)) {
			$parser = null;
			// switch ($type) {
			// 	case self::Csv:
			// 		$parser = new CsvParser($data);
			// 		break;
			// 	case self::Json:
			// 		$parser = new JsonParser($data);
			// 		break;
			// 	case self::Xml:
			// 		$parser = new XmlParser($data);
			// 		break;
			// 	case self::Arr:
			// 		$parser = new ArrayParser($data);
			// 		break;
			// }
			return new Formatter($parser, $type);
		}
		throw new InvalidArgumentException(
			'make function only accepts [csv, json, xml, array] for $type but ' . $type . ' was provided.'
		);
	}

	private function __construct($parser, $type) {

	}
}
