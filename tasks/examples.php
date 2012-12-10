<?php

class Formatter_Examples_Task
{
	public function __construct()
	{
		// just a simple sample array that we will use for our examples
		$this->_sample_array = array(
			array(
				'first_name' => 'Daniel',
				'last_name'  => 'Berry',
				'email'      => 'danielberrytn@gmail.com',
				'state'      => 'TX'
			),
			array(
				'first_name' => 'John',
				'last_name'  => 'Doe',
				'email'      => 'john.doe@fakepeople.com',
				'state'      => 'AL'
			),

			array(
				'first_name' => 'Jane',
				'last_name'  => 'Doe',
				'email'      => 'jane.doe@fakepeople.com',
				'state'      => 'TN'
			),

			array(
				'first_name' => 'James',
				'last_name'  => 'Smith',
				'email'      => 'james.smith@fakepeople.com',
				'state'      => 'OK'
			),
		);


		// path to our example files
		$this->_example_file_path = Bundle::path('formatter').'files/';
	}

	/**
	 * Default run functio.
	 * This does nothing other than tells you to look at the code examples here in this file.
	 *
	 * @return void
	 */
	public function run()
	{
		echo 'Look through the examples and choose a task to run to view the results.';
	}

	/**
	 * Converts a standard PHP array to JSON
	 *
	 * @return string  our json encoded string
	 */
	public function array_to_json()
	{
		$results = Formatter::make($this->_sample_array)->to_json();

		echo $results;
	}


	/**
	 * Converts our PHP array to XML
	 *
	 * @return string  our generated XML
	 */
	public function array_to_xml()
	{
		$results = Formatter::make($this->_sample_array)->to_xml();

		echo $results;
	}


	/**
	 * Converts our PHP array to usable PHP code
	 *
	 * @return string  our generated array code.
	 */
	public function array_to_php()
	{
		$results = Formatter::make($this->_sample_array)->to_php();

		echo $results;
	}

	/**
	 * Converts our PHP array to CSV
	 *
	 * @return string  our generated CSV
	 */
	public function array_to_csv()
	{
		$results = Formatter::make($this->_sample_array)->to_csv();

		echo $results;
	}

	/**
	 * Fetches a JSON file and then converts it to an array if the 
	 * file exists.
	 *
	 * @return array
	 */
	public function json_to_array()
	{

		// dd($this->_example_file_path);
		// we will use the Laravel's File class to fetch our JSON file.
		$file_path = $this->_example_file_path.'example_json.json';

		if ( file_exists($file_path))
		{
			$file = File::get($file_path);

			if ( ! empty($file))
			{
				$results = Formatter::make($file, 'json')->to_array();

				print_r($results);
			}
		}
		else
		{
			echo 'Sorry, but the file you requested does not exist.';
		}
	}


	/**
	 * Fetches a XML file and then converts it to an array if the 
	 * file exists.
	 *
	 * @return array
	 */
	public function xml_to_array()
	{

		// dd($this->_example_file_path);
		// we will use the Laravel's File class to fetch our JSON file.
		$file_path = $this->_example_file_path.'example_xml.xml';

		if ( file_exists($file_path))
		{
			$file = File::get($file_path);

			if ( ! empty($file))
			{
				$results = Formatter::make($file, 'xml')->to_array();

				print_r($results);
			}
		}
		else
		{
			echo 'Sorry, but the file you requested does not exist.';
		}
	}


	/**
	 * Fetches a CSV file and then converts it to an array if the 
	 * file exists.
	 *
	 * NOTE:: default configuration values for the CSV such as
	 * escape cahrater, newline, enclosure, etc... Are stored in the
	 * bundle's config file.
	 *
	 * If you have a specific case, you can pass custom config attributes
	 * as a third paramter to the make(). Example
	 *
	 * $custom_config = array(
	 * 	'enclosure' => '*'
	 * );
	 *
	 * Formatter::make($csv_data, 'csv', $custom_config);
	 *
	 * @return array
	 */
	public function csv_to_array()
	{

		// dd($this->_example_file_path);
		// we will use the Laravel's File class to fetch our JSON file.
		$file_path = $this->_example_file_path.'example_csv.csv';

		if ( file_exists($file_path))
		{
			$file = File::get($file_path);

			if ( ! empty($file))
			{
				$results = Formatter::make($file, 'csv')->to_array();

				print_r($results);
			}
		}
		else
		{
			echo 'Sorry, but the file you requested does not exist.';
		}
	}
}