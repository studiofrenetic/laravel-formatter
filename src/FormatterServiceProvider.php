<?php namespace SoapBox\Formatter;

use Illuminate\Support\ServiceProvider;
//use Whoops\Exception\Formatter as Formatter;
//use PhpSpec\Console\Formatter as Formatter;
//use phpDocumentor\Reflection\DocBlock\Tags\Formatter as Formatter;
//use Mdanter\Ecc\Serializer\PublicKey\Der\Formatter as Formatter;
//use Mdanter\Ecc\Serializer\Signature\Der\Formatter as Formatter;
//use Psy\Formatter\Formatter as Formatter;
use SoapBox\Formatter\Formatter as Formatter;
//use Whoops\Exception\Formatter as Formatter;
//use PhpSpec\Console\Formatter as Formatter;
//use phpDocumentor\Reflection\DocBlock\Tags\Formatter as Formatter;
//use Mdanter\Ecc\Serializer\PublicKey\Der\Formatter as Formatter;
//use Mdanter\Ecc\Serializer\Signature\Der\Formatter as Formatter;
//use Psy\Formatter\Formatter as Formatter;
use SoapBox\Formatter\Formatter as Formatter;

/**
 * Used to register Authroize with service providers, mainly for Laravel.
 */
class FormatterServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('soapbox/laravel-formatter');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['formatter'] = $this->app->share(function ($app) {
            return new Formatter;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['formatter'];
    }

}
