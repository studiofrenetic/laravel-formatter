<?php namespace SoapBox\Formatter\Parsers;

/**
 * Parser Interface
 *
 * This interface describes the abilities of a parser which is able to transform
 * inputs to the object type.
 */
interface ParserInterface {
	/**
	 * asObject takes in $data and transforms it into a php object
	 *
	 * @param mixed $data The input sharing a type with the parser.
	 *
	 * @return stdClass An object representation of the input data.
	 */
	public function asObject($data);
}
