<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;


/**
 * View composers are callbacks or class methods that are called when a view is rendered.
 * It is used if bind data to a view each time that view is rendered.
 * 
 * @author Houmam
 */
class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        // Using class based composers:
        View::composer('*', 'Insider\Concept\Composers\ViewComposer');

		View::composer('dashboard', function()
        {

        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
