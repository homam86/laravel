<?php
namespace App\Http\Controllers;

use View;
use App\Models\Meal;

use Insider\iNFlash;
use Insider\Concept\Facades\WebPage;

class MealController extends Controller
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
		
        parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$meals = Meal::all();
		
		\Debugbar::addMessage('Another message', 'mylabel');
		
		return View::make('meal.index', array('meals' => $meals));
	}
	
	public function anyUpdate($id)
	{
		$model = Meal::find($id);
		if(!isset($model))
			\App::abort(404);
		
		if(\Request::isMethod('post') && isset($_POST['Meal']))
		{
			$model->populate($_POST['Meal']);
			
			if($model->save())
				iNFlash::info('Your changes are saved successfuly');
		}
		
		WebPage::addMenuItem('portlet', array(
			'index' => array('text' => 'Index', 'url' => 'meal/index'),
			'view' => array('text' => 'View Meal', 'url' => 'meal/view/'.$id),
			'create' => array('text' => 'Create Meal', 'url' => 'meal/create'),
		));
		
		
		return View::make('meal.update', array(
			'id' => $id,
			'model' => $model,
			'flashbox' => iNFlash::html(),
		));
	}
	
	public function anyCreate()
	{
		$model = new Meal();
		
		if(\Request::isMethod('post') && isset($_POST['Meal']))
		{
			$model->populate($_POST['Meal']);
			if($model->save()) {
				iNFlash::info('Your new meal is created successfuly' .time());
				return redirect()->action('MealController@anyUpdate', [$model->id]);
			}
		}
		
		
		
		WebPage::addMenuItem('portlet', array(
			'index' => array('text' => 'Index', 'url' => 'meal/index'),
			'create' => array('text' => 'Create Meal', 'url' => 'meal/create'),
		));
		
		return View::make('meal.create', array(
			'model' => $model,
			'flashbox' => iNFlash::html(),
		));
	}

}
