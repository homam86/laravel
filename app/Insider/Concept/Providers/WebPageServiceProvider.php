<?php namespace Insider\Concept\Providers;

use Illuminate\Support\ServiceProvider;
use \Insider\Concept\Facades\WebPage as WebPage;

class WebPageServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		WebPage::addMenuItem('main', array(
			'home' => array('text'=>'Home', 'url'=>'/'),
			'meal' => array('text'=>'Meal', 'url'=>'/meal'),
            'menu' => array('text'=>'Menu', 'url'=>'/menu'),
            'order' => array('text'=>'Orders', 'url'=>'/order'),
            'user' => array('text'=>'Users222', 'url'=>'/user'),
		));
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind( 'webpage', function(){
			return new \Insider\Concept\WebPageModel();
		});
		
	}

}
