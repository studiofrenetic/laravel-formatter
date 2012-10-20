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
 * Setup the Septu namespace
 */
// Autoload classes
Autoloader::namespaces(array(
    'Formatter' => Bundle::path('formatter'),
));

// Set the global alias for Sentry
Autoloader::alias('Formatter\\Formatter', 'Formatter');
Autoloader::alias('Formatter\\FormatterException', 'FormatterException');

Autoloader::map(array(
	'Spyc' => path('bundle').'formatter/vendors/spyc/spyc.php'
));