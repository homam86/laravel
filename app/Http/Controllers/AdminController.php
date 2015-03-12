<?php
namespace App\Http\Controllers;

use View;

use Insider\iNFlash;
use Insider\Concept\Facades\WebPage;

class AdminController extends Controller
{

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
		
		iNFlash::info('You did not prepare  the menu fo today. You can do it from <a href="#">here</a>.');
		WebPage::addMenuItem('portlet', array(
			'new_menu' => array('text' => 'New Menu', 'url'=>'MenuController@anyCreate'),
		));
		
		return View::make('admin.index', array());
	}
	
	

}
