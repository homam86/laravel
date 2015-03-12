<?php

namespace Insider\Concept;

use Illuminate\Database\Eloquent\Model;

class ActiveRcord extends Model {

	public $timestamps = false;
	
	/**
	 * Create a new Eloquent model instance.
	 */
	public function __construct(array $attributes = array())
	{
		parent::__construct($attributes);
	}
	
	protected function setDefaultValues($attributes=array())
	{
		$this->setRawAttributes(array_merge($this->attributes, $attributes), true);
	}
	
	public function getModelName()
	{
		$name = get_class($this);
		$pos = strrpos($name, '\\');
		if($pos !== false)
			$name = substr($name, $pos+1);
		return $name;
	}
	
	public function populate($data = array())
	{
		foreach($data as $attr => $value)
			$this->$attr = $value;
	}
	
	public function attributeLabels()
	{
		return array();
	}
	
	public function g($attribute) {
		return $this->$attribute;
	}
	
	/**
	 * @notice: from Yii framework
	 */
	public function getAttributeLabel($attribute)
	{
		$labels=$this->attributeLabels();
		if(isset($labels[$attribute]))
			return $labels[$attribute];
		else
			return $this->generateAttributeLabel($attribute);
	}
	
	/**
	 * Generates a user friendly attribute label. This is done by replacing underscores or
	 * dashes with blanks and changing the first letter of each word to upper case.
	 * For example, 'department_name' or 'DepartmentName' becomes 'Department Name'.
	 * @notice: from Yii framework
	 */
	public function generateAttributeLabel($name)
	{
		return ucwords(trim(strtolower(str_replace(array('-','_','.'),' ',preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name)))));
	}

}
