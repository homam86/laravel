<?php namespace App\Http\Controllers;

use View;
use App\Models\Menu;
use App\Models\Meal;
use App\Models\MenuMeal;
use Insider\Concept\Facades\WebPage;

class MenuController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}
	
	public function getIndex()
	{
		$menus = Menu::all();
	
		WebPage::addMenuItem('portlet', array(
			'index' => array('text' => 'Index', 'url' => 'menu/index'),
			'create' => array('text' => 'Create Menu', 'url' => 'menu/create'),
			'orders' => array('text' => 'Orders', 'url' => '/'),
		));
		
		return View::make('menu.index', array(
			'datasource' => $menus,
		));
	}

	public function anyCreate()
	{
		$model = new Menu();
		//$model->date = time();
		
		WebPage::linkScript('jquery', asset('jquery/jquery-1.11.2.min.js'));
		WebPage::linkScript('jqueryui', asset('jquery/jquery-ui.min.js'));
		WebPage::linkStylesheet('jqueryui', asset('jquery/jquery-ui.min.css'));
		
		if(\Request::isMethod('post') && isset($_POST['Menu']))
		{
			$model->populate([
				'date' => $_POST['Menu']['date'],
				'note' => $_POST['Menu']['note'],
			]);
			
			if($model->save())
			{
				//iNFlash::info('Your new meal is created successfuly' .time());
				//$meals = array();
				//foreach($_POST['Menu']['items'] as $meal_id)
				//	$meals[] = new MenuMeal([
				//		'meal_id'=>$meal_id
				//	]);
				
				$model->meals()->attach($_POST['Menu']['items']);
					
				return redirect()->action('MenuController@getView', [$model->id]);
			}
		}
		
			
		return View::make('menu.create', array(
			'model' => $model,
		));
	}

	public function anyUpdate($id)
	{
		$model = Menu::find($id);
		if(!isset($model))
			\App::abort(404);
		
		WebPage::linkScript('jquery', asset('jquery/jquery-1.11.2.min.js'));
		WebPage::linkScript('jqueryui', asset('jquery/jquery-ui.min.js'));
		WebPage::linkStylesheet('jqueryui', asset('jquery/jquery-ui.min.css'));
		
		if(\Request::isMethod('post') && isset($_POST['Menu']))
		{
			$model->populate([
				'date' => $_POST['Menu']['date'],
				'note' => $_POST['Menu']['note'],
			]);
			
			if($model->save())
			{
				$model->meals()->attach($_POST['Menu']['items']);
					
				return redirect()->action('MenuController@getView', [$model->id]);
			}
		}
		
			
		return View::make('menu.update', array(
			'model' => $model,
		));
	}
	
	
	public function getView($id)
	{
		$model = Menu::find($id);
		if(!isset($model))
			\App::abort(404);
		
		WebPage::addMenuItem('portlet', array(
			'index' => array('text' => 'Index', 'url' => 'menu/index'),
			'update' => array('text' => 'Update', 'url' => 'menu/update/'.$id),
			'create' => array('text' => 'Create', 'url' => 'menu/create'),
			'orders' => array('text' => 'Orders', 'url' => '/'),
		));
			
		return View::make('menu.view', array(
			'model' => $model,
		));
	}

}
