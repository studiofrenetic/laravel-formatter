<?php namespace SoapBox\Formatter;

use Illuminate\Support\ServiceProvider;

class FormatterServiceProvider extends ServiceProvider {

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
	public function boot() {
		$this->package('SoapBox/formatter');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->app['formatter'] = $this->app->share(function($app) {
			return new Formatter;
		});

		$this->app->booting(function() {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Formatter', 'SoapBox\Formatter\Facades\Formatter');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return array('formatter');
	}

}