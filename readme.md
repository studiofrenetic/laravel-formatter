Formatter Bundle
================

Laravel Bundle ported from the FuelPHP Format class, that helps you easily convert between various formats such as XML, JSON, CSV, etc...

Installation
------------
Using artisan to install the bundle

```
php artisan bundle:install formatter
```

Or you can clone the bundle straight from github. Run the following command inside your bundles folder:

```
git clone git@github.com:dberry37388/laravel-formatter.git formatter
```

Add the Following to your application/bundles.php file:

```
'formatter' => array('auto' => true) // you can leave out the auto => true
```

That's it, Formatter should now be installed and ready to go!

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
print_r(Formater::make($json_string, 'json')->to_array());

// Returns
Array
(
    [foo] => bar
    [baz] => qux
)
```