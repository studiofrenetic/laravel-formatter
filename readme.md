Formatter Bundle
================

Laravel 4 Workbench Package based off the work done by @dberry37388 to create a Laravel 3 Bundle porterd from the FuelPHP Format class.  Thhis class helps you easily convert between various formats such as XML, JSON, CSV, etc...

I've also implemented the error handling code created by @rodrigore

Installation
------------

Not exactly sure... I used the Artisan Workbench to create a package in my Laravel 4 instance.

To learn more about packages read http://laravel.com/docs/packages

when you add this to your vendor directory, you will need to run `php artisan dump-autoload`

I'll try to make this installation better once I get more time.

Usage
-----
The best way to learn how to use Formatter is to look through the code, where you can familiarize yourself with all of the available methods.

###Calling Formatter
Formatter::make($data_to_convert, 'type of data')->to_the_format_you_want();

### Available Formats to Convert From
- Json
- Serialized Array
- XML
- CSV

### Available Formates to Convert To
- Json
- Serializaed Array
- XML
- CSV
- PHP Array
- PHP Export
- YAML

```
$json_string = '{"foo":"bar","baz":"qux"}';
$result = Formater::make($json_string, 'json')->to_array();

if ( empty(Formatter::$errors) ) {
	//show the results
	print_r(result);
} else {
	// Show the errors
	print_r(Formatter::$errors);
	return;
}

// Returns
Array
(
    [foo] => bar
    [baz] => qux
)
```