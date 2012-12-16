<?php

/**
 * Formatter Bundle
 *
 * Port of the FuelPHP Formatter Bundle
 * http://fuelphp.com/
 *
 * @package Formatter
 * @version 1.0
 * @author  Daniel Berry <daniel@danielberry.me>
 * @license MIT License (see LICENSE.readme included in the bundle)
 *
 */

/**
 * Setup the Formatter namespace
 */
namespace Formatter;

use Config, Exception;

class FormatterException extends Exception {}

/**
 * The Formatter Class
 *
 * Makes it quick and easy to convert data between several different formats.
 *
 * @package  Formatter
 * @author   Daniel Berry <danielberrytn@gmail.com>
 *
 */
class Formatter
{

	/**
	 * Holds the data that we are converting
	 * @var array
	 */
	protected $_data = array();

	/**
	 * Returns an instance of the Formatter Bundle
	 * @param  mixex  $data      the data we are converting
	 * @param  [type] $from_type what we want to convert to
	 * @return Formatter
	 */
	public static function make($data = null, $from_type = null, $attributes = array())
	{
		return new self($data, $from_type, $attributes);
	}


	/**
	 * Should not be called directly. You should be using Formatter::make()
	 *
	 * Constructs our class and sets up some vars we will be using throughout
	 * the conversion process.
	 *
	 * @param mixed  $data        data we will be converting
	 * @param string $from_type  what we are converting form
	 */
	public function __construct($data = null, $from_type = null, $attributes = array())
	{
		// make sure we have data to convert to
		if (empty($data))
		{
			throw new FormatterException(__('formatter::formatter.no_data', array('from_type' => $from_type)));
		}

		// make sure our from type has been specified.
		if ($from_type !== null)
		{
			// check to make sure the method exists
			if (method_exists($this, "_from_{$from_type}"))
			{
				$data = call_user_func(array($this, '_from_' . $from_type), $data, $attributes);
			}
			else
			{
				throw new FormatterException(__('formatter::formatter.from_type_not_supported', array('from_type' => $from_type)));
			}
		}

		// set up our data.
		$this->_data = $data;
	}

	/**
	 * To array conversion
	 *
	 * Goes through the input and makes sure everything is either a scalar value or array
	 *
	 * @param   mixed  $data
	 * @return  array
	 */
	public function to_array($data = null)
	{
		if ($data === null)
		{
			$data = $this->_data;
		}

		$array = array();

		if (is_object($data) and ! $data instanceof \Iterator)
		{
			$data = get_object_vars($data);
		}

		if (empty($data))
		{
			return array();
		}

		foreach ($data as $key => $value)
		{
			if (is_object($value) or is_array($value))
			{
				$array[$key] = $this->to_array($value);
			}
			else
			{
				$array[$key] = $value;
			}
		}

		return $array;
	}

	/**
	 * To CSV conversion
	 *
	 * @param   mixed   $data
	 * @param   mixed   $delimiter
	 * @return  string
	 */
	public function to_csv($data = null, $attributes = null)
	{
		// let's get the config file
		$config = Config::get('formatter::formatter.csv');

		// csv format settings
		$newline = array_get($attributes, 'newline', array_get($config, 'newline', "\n"));
		$delimiter = array_get($attributes, 'delimiter', array_get($config, 'delimiter', ","));
		$enclosure = array_get($attributes, 'enclosure', array_get($config, 'enclosure', "\""));
		$escape = array_get($attributes, 'escape', array_get($config, 'escape', '\\'));

		// escape function
		$escaper = function($items) use($enclosure, $escape) {
			return array_map(function($item) use($enclosure, $escape) {
				return str_replace($enclosure, $escape.$enclosure, $item);
			}, $items);
		};

		if ($data === null)
		{
			$data = $this->_data;
		}

		if (is_object($data) and ! $data instanceof \Iterator)
		{
			$data = $this->to_array($data);
		}

		// Multi-dimensional array
		if (is_array($data) and self::is_multi($data))
		{
			$data = array_values($data);

			if (self::is_assoc($data[0]))
			{
				$headings = array_keys($data[0]);
			}
			else
			{
				$headings = array_shift($data);
			}
		}
		// Single array
		else
		{
			$headings = array_keys((array) $data);
			$data = array($data);
		}

		$output = $enclosure.implode($enclosure.$delimiter.$enclosure, $escaper($headings)).$enclosure.$newline;

		foreach ($data as $row)
		{
			$output .= $enclosure.implode($enclosure.$delimiter.$enclosure, $escaper((array) $row)).$enclosure.$newline;
		}

		return rtrim($output, $newline);
	}


	/**
	 * Serialize
	 *
	 * @param   mixed  $data
	 * @return  string
	 */
	public function to_serialized($data = null)
	{
		if ($data == null)
		{
			$data = $this->_data;
		}

		return serialize($data);
	}

	/**
	 * To JSON conversion
	 *
	 * @param   mixed  $data
	 * @param   bool   wether to make the json pretty
	 * @return  string
	 */
	public function to_json($data = null, $pretty = false)
	{
		if ($data == null)
		{
			$data = $this->_data;
		}

		// To allow exporting ArrayAccess objects like Orm\Model instances they need to be
		// converted to an array first
		$data = (is_array($data) or is_object($data)) ? $this->to_array($data) : $data;
		return $pretty ? static::pretty_json($data) : json_encode($data, JSON_NUMERIC_CHECK);
	}

	/**
	 * Return as a string representing the PHP structure
	 *
	 * @param   mixed  $data
	 * @return  string
	 */
	public function to_php($data = null)
	{
		if ($data == null)
		{
			$data = $this->_data;
		}

		return var_export($data, true);
	}

	/**
	 * Convert to YAML
	 *
	 * @param   mixed   $data
	 * @return  string
	 */
	public function to_yaml($data = null)
	{
		if ($data == null)
		{
			$data = $this->_data;
		}

		$data = (is_array($data) or is_object($data)) ? $this->to_array($data) : $data;

		return \Spyc::YAMLDump($data);
	}

	/**
	 * To XML conversion
	 *
	 * @param   mixed        $data
	 * @param   null         $structure
	 * @param   null|string  $basenode
	 * @return  string
	 */
	public function to_xml($data = null, $structure = null, $basenode = 'xml')
	{
		if ($data == null)
		{
			$data = $this->_data;
		}

		// turn off compatibility mode as simple xml throws a wobbly if you don't.
		if (ini_get('zend.ze1_compatibility_mode') == 1)
		{
			ini_set('zend.ze1_compatibility_mode', 0);
		}

		if ($structure == null)
		{
			$structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
		}

		// Force it to be something useful
		if ( ! is_array($data) and ! is_object($data))
		{
			$data = (array) $data;
		}

		foreach ($data as $key => $value)
		{
			// no numeric keys in our xml please!
			if (is_numeric($key))
			{
				// make string key...
				$key = (\Str::singular($basenode) != $basenode) ? \Str::singular($basenode) : 'item';
			}

			// replace anything not alpha numeric
			$key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

			// if there is another array found recrusively call this function
			if (is_array($value) or is_object($value))
			{
				$node = $structure->addChild($key);

				// recursive call if value is not empty
				if( ! empty($value))
				{
					$this->to_xml($value, $node, $key);
				}
			}

			else
			{
				// add single node.
				$value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, "UTF-8");

				$structure->addChild($key, $value);
			}
		}

		// pass back as string. or simple xml object if you want!
		return $structure->asXML();
	}

	/**
	 * Import JSON data
	 *
	 * @param   string  $string
	 * @return  mixed
	 */
	private function _from_json($string)
	{
		return json_decode(trim($string));
	}

	/**
	 * Import Serialized data
	 *
	 * @param   string  $string
	 * @return  mixed
	 */
	private function _from_serialize($string)
	{
		return unserialize(trim($string));
	}

	/**
	 * Import XML data
	 *
	 * @param   string  $string
	 * @return  array
	 */
	protected function _from_xml($string)
	{
		$_arr = is_string($string) ? simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA) : $string;
		$arr = array();

		// Convert all objects SimpleXMLElement to array recursively
		foreach ((array)$_arr as $key => $val)
		{
			$arr[$key] = (is_array($val) or is_object($val)) ? $this->_from_xml($val) : $val;
		}

		return $arr;
	}

	/**
	 * Import CSV data
	 *
	 * @param   string  $string
	 * @return  array
	 */
	protected function _from_csv($string, $attributes = array())
	{
		$data = array();

		// let's get the config file
		$config = Config::get('formatter::formatter.csv');

		// csv format settings
		$newline = array_get($attributes, 'newline', array_get($config, 'newline', "\n"));
		$delimiter or $delimiter = array_get($attributes, 'delimiter', array_get($config, 'delimiter', ","));
		$enclosure = array_get($attributes, 'enclosure', array_get($config, 'enclosure', "\""));
		$escape = array_get($attributes, 'escape', array_get($config, 'escape', '\\'));
		$regex_newline = array_get($attributes, 'regex_newline', array_get($config, 'regex_newline', '\n'));

		$rows = preg_split('/(?<='.preg_quote($enclosure).')'.$regex_newline.'/', trim($string));

		// Get the headings
		$headings = str_replace($escape.$enclosure, $enclosure, str_getcsv(array_shift($rows), $delimiter, $enclosure, $escape));

		foreach ($rows as $row)
		{
			$data_fields = str_replace($escape.$enclosure, $enclosure, str_getcsv($row, $delimiter, $enclosure, $escape));

			if (count($data_fields) == count($headings))
			{
				$data[] = array_combine($headings, $data_fields);
			}

		}

		return $data;
	}


	/**
	 * Checks if the given array is a multidimensional array.
	 *
	 * @param   array  $arr       the array to check
	 * @param   array  $all_keys  if true, check that all elements are arrays
	 * @return  bool   true if its a multidimensional array, false if not
	 */
	protected static function is_multi($arr, $all_keys = false)
	{
		$values = array_filter($arr, 'is_array');
		return $all_keys ? count($arr) === count($values) : count($values) > 0;
	}

	/**
	 * Checks if the given array is an assoc array.
	 *
	 * @param   array  $arr  the array to check
	 * @return  bool   true if its an assoc array, false if not
	 */
	public static function is_assoc($arr)
	{
		if ( ! is_array($arr))
		{
			throw new FormatterException('The parameter must be an array.');
		}

		$counter = 0;

		foreach ($arr as $key => $unused)
		{
			if ( ! is_int($key) or $key !== $counter++)
			{
				return true;
			}
		}
		return false;
	}
}