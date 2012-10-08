<?php

class Formatter_Format_Task
{
	public function __construct()
	{
		// let's create a fake array
		// for ($i=0; $i < 10; $i++) { 
		// 	$this->array['field_'.rand(1, 10)] = range(rand(4,100), rand(10,20));
		// }
		// 
		$this->array = array(
			'home_1' => array(
				'address1' => '220 Hale St.',
				'city'     => 'San Antonio',
				'state'    => 'TX'
			),

			'home_2' => array(
				'address1' => '223 Hale St.',
				'city'     => 'San Antonio',
				'state'    => 'TX'
			),

			'home_3' => array(
				'address1' => '224 Hale St.',
				'city'     => 'San Antonio',
				'state'    => 'TX'
			),

			'home_4' => array(
				'address1' => '225 Hale St.',
				'city'     => 'San Antonio',
				'state'    => 'TX'
			),
		);

		$results = DB::connection('logs')
			->table('billing_previews')
			->where_user_id(3)
			->take(2)
			->get();

		$this->obj = $results;
	}

	public function run()
	{
		return 'Choose a task';
	}

	public function from_json_to_array()
	{
		// $csv = Formatter::make($this->ob)->to_csv();
		// $array = Formatter::make($this->obj)->to_array();

		$data = Formatter::make($this->obj)->to_xml();

		echo($data);
	}


}