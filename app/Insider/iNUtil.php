<?php
namespace Insider;

class iNUtil
{
    /**
     * Evaluates a PHP expression or callback under the context of this component.
     *
     * Valid PHP callback can be class method name in the form of
     * array(ClassName/Object, MethodName), or anonymous function (only available in PHP 5.3.0 or above).
     *
     * If a PHP callback is used, the corresponding function/method signature should be
     * <pre>
     * function foo($param1, $param2, ..., $component) { ... }
     * </pre>
     * where the array elements in the second parameter to this method will be passed
     * to the callback as $param1, $param2, ...; and the last parameter will be the component itself.
     *
     * If a PHP expression is used, the second parameter will be "extracted" into PHP variables
     * that can be directly accessed in the expression. See {@link http://us.php.net/manual/en/function.extract.php PHP extract}
     * for more details. In the expression, the component object can be accessed using $this.
     *
     * A PHP expression can be any PHP code that has a value. To learn more about what an expression is,
     * please refer to the {@link http://www.php.net/manual/en/language.expressions.php php manual}.
     *
     * @param mixed $_expression_ a PHP expression or PHP callback to be evaluated.
     * @param array $_data_ additional parameters to be passed to the above expression/callback.
     * @return mixed the expression result
     * 
     * @note used in Yii framework
     */
    public static function evaluateExpression($_expression_,$_data_=array())
    {
        if(is_string($_expression_))
        {
            extract($_data_);
            return eval('return '.$_expression_.';');
        }
        else
        {
            $_data_[]=$this;
            return call_user_func_array($_expression_, $_data_);
        }
    }
    
    public static function portlet($title, $commands=null)
    {
        ob_start();
        ob_implicit_flush(false);
        
        if(isset($title) && isset($commands))
            echo Html::tag('div', $title, array('class'=>''));
        else if(!isset($commands))
            $commands = $title;
        
        echo Html::openTag('div', array('class'=>''));
        echo Html::openTag('ul');
        
        if(is_array($commands))
            foreach($commands as $c)
            {
                echo Html::tag('li', Html::link($c['url'], $c['text']));
            }
        
        echo Html::closeTag('ul');
        echo Html::closeTag('div');
        
        return ob_get_clean();
    }
}
