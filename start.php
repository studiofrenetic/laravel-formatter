<?php

/**
 * Formatter Bundle
 *
 * Notice of Copyright
 * ===================
 *
 * Copyright (c) 2012 Daniel Berry (daniel.berry@cwlake.com)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), 
 * to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * 
 * @package Formatter
 * @version 1.0
 * @author  Daniel Berry <daniel.berry@cwlake.com>
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