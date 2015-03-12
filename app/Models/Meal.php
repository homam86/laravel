<?php namespace App\Models;

use App\Models\Menu;

class Meal extends \Insider\Concept\ActiveRcord {

	public $timestamps = false;
    protected $table = 'meals';
    
    public function __construct(array $attributes = array())
    {
        
        parent::__construct($attributes);
        
    }
    
    /**
     * Define One To Many relationship.
     */
    public function menus()
    {
        return $this->belongsToMany('Menu', 'menu_meals', 'meal_id', 'menu_id');
    }
    
    
    public static function getLunchDishes()
    {
        return self::getMealOptions('Lunch');
    }
    
    public static function getDinnerDishes()
    {
        return self::getMealOptions('Dinner');
    }
    
    public static function getSnackDishes()
    {
        return self::getMealOptions('Snack');
    }
    
    public static function getMealOptions($type=null)
    {
        if(isset($type))
            $meals = self::where('type', '=', $type)->get();
        else
            $meals = self::all();
        
        $options = array();
        foreach($meals as $m)
            $options[$m->id] = $m->name;
            
        return $options;
    }

}
