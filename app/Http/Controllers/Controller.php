<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;


abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	
	protected $mainmenu = array();
	
	protected $flash;
	
	public function __construct()
	{
		$this->init();
	}
	
	public function init()
	{
		//$this->mainmenu = array(
		//	array('Home', '/'),
		//	array('Yemeks', '/yemek'),
		//);
	}

}
