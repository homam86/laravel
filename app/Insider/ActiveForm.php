<?php
namespace Insider;

class ActiveForm
{
    public static function getActiveName($model, $attribute)
    {
        $name = $model->getModelName();
        return "{$name}[$attribute]";
    }
    
    public static function getActiveId($model, $attribute)
    {
        
        $name = $model->getModelName();
        return "{$name}_$attribute";
    }
    
    public static function resolveNameId($model, $attribute, & $htmlOptions=array()) {
        
        if (!isset($htmlOptions['name']))
            $htmlOptions['name'] = self::getActiveName($model, $attribute);
            
        if (!isset($htmlOptions['id']))
            $htmlOptions['id'] = self::getActiveId($model, $attribute);
        
        return array($htmlOptions['name'], $htmlOptions['id']);
    }
    
    public static function label($model, $attribute, $htmlOptions=array())
    {
        $name = self::getActiveName($model, $attribute.'_label');
        $id = self::getActiveId($model, $attribute.'_label');
        
        if(!isset($htmlOptions['id'])) $htmlOptions['id'] = $id;
        if(!isset($htmlOptions['name'])) $htmlOptions['name'] = $name;
        if(!isset($htmlOptions['for'])) $htmlOptions['for'] = self::getActiveId($model, $attribute);
        
        $label = $model->getAttributeLabel($attribute);
        
        return Html::label($label, NULL, $htmlOptions);
    }
    
    public static function textField($model, $attribute, $htmlOptions=array())
    {
        list($name, $id) = self::resolveNameId($model, $attribute, $htmlOptions);
        $value = $model->$attribute;
        
        return Html::textField($name, $value, $htmlOptions);
    }
    
    public static function datepicker($model, $attribute, $htmlOptions=array())
    {
        list($name, $id) = self::resolveNameId($model, $attribute, $htmlOptions);
        $value = $model->$attribute;
        
        return Html::datepicker($name, $value, $htmlOptions);
    }
    
    public static function buttom($value, $htmlOptions = array())
    {
        return Html::buttom($value, $htmlOptions);
    }
    
    public static function submit($value, $htmlOptions = array())
    {
        return Html::submit($value, $htmlOptions);
    }
    
    public static function dropList($model, $attribute, $options=array(), $htmlOptions=array())
    {
        list($name, $id) = self::resolveNameId($model, $attribute, $htmlOptions);
        $value = $model->$attribute;
        
        return Html::dropList($name, $value, $options, $htmlOptions);
    }
    
    public static function radioList($model, $attribute, $options=array(), $htmlOptions=array())
    {
        list($name, $id) = self::resolveNameId($model, $attribute, $htmlOptions);
        $value = $model->$attribute;
        
        return Html::radioList($name, $value, $options, $htmlOptions);
    }
    
    public static function checkboxList($model, $attribute, $options=array(), $htmlOptions=array())
    {
        list($name, $id) = self::resolveNameId($model, $attribute, $htmlOptions);
        $values = $model->$attribute;
        
        return Html::checkboxList($name, $values, $options, $htmlOptions);
    }
    
    public static function begin($model, $action="", $method="POST", $htmlOptions=array())
    {
        if(!isset($htmlOptions['name']))
            $htmlOptions['name'] = $model->getModelName();
        
        return Html::beginForm($action, $method, $htmlOptions);
    }
    
    public static function end()
    {
        return Html::endForm();
    }
    
}
