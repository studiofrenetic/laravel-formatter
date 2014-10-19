<?php namespace SoapBox\Formatter\Parsers;

use Spyc;

/**
 * Parser Interface
 *
 * This interface describes the abilities of a parser which is able to transform
 * inputs to the object type.
 */
abstract class ParserInterface {

	/**
	 * Constructor is used to initialize the parser
	 *
	 * @param mixed $data The input sharing a type with the parser
	 */
	abstract public function __construct($data);

	/**
	 * Used to retrieve a (php) array representation of the data encapsulated within our Parser.
	 *
	 * @return array
	 */
	abstract public function toArray();

	/**
	 * Return a json representation of the data stored in the parser
	 *
	 * @return string A json string representing the encapsulated data
	 */
	public function toJson() {
		return json_encode($this->toArray());
	}

	/**
	 * Return a yaml representation of the data stored in the parser
	 *
	 * @return string A yaml string representing the encapsulated data
	 */
	public function toYaml() {
		return Spyc::YAMLDump($this->toArray());
	}
}
