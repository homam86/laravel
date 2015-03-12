<?php namespace App\Models;

use App\Models\Meal;

class Menu extends \Insider\Concept\ActiveRcord {

	public $timestamps = true;
    protected $table = 'menus';

	public function __construct($attributes=array())
	{
		
        $this->setDefaultValues([
            'date'=>date(IN_DATE_FORMAT)
        ]);
		
		parent::__construct($attributes);
	}
	
    
    /**
     * Define One To Many relationship.
     */
    public function meals()
    {
        return $this->belongsToMany('Meal', 'menu_meals', 'menu_id', 'meal_id');
    }
	
	public function lunch($fetch_id_only=false)
	{
		if($fetch_id_only)
			return $this->getMealsId('Lunch');
		
		return $this->meals()->where('type', '=', 'Lunch')->get();
	}
	
	public function snack($fetch_id_only=false)
	{
		if($fetch_id_only)
			return $this->getMealsId('Snack');
		
		return $this->meals()->where('type', '=', 'Snack')->get();
	}
	
	public function dinner($fetch_id_only=false)
	{
		if($fetch_id_only)
			return $this->getMealsId('Dinner');
		
		return $this->meals()->where('type', '=', 'Dinner')->get();
	}
	
	public function getMealsId($type)
	{
		$result = \DB::table('menu_meals')
			->join('meals', 'meals.id', '=', 'menu_meals.meal_id')
			->where('menu_meals.menu_id', '=', $this->id)
			->where('meals.type', '=', $type)
			->get(array('meals.id'))
		;
		return array_map(function($o){return $o->id; }, $result);
	}
}
