<?php
namespace Insider\Widgets;

use Insider\Html;

class iNWidget
{
    protected $_widget;
    
    public function __construct($name, $data=array())
    {
        $this->_widget = call_user_func_array('self::'.$name, $data);
    }
    
    public function html() {
        return $this->_widget;
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
        
        foreach($commands as $c)
        {
            echo Html::tag('li', Html::link($c['url'], $c['text']));
        }
        
        echo Html::closeTag('ul');
        echo Html::closeTag('div');
        
        return ob_get_clean();
    }
    
    public static function menu($items=array(), $htmlOptions=array())
    {
        ob_start();
        ob_implicit_flush(false);
        
        echo Html::openTag('ul', $htmlOptions);
        foreach($items as $m)
        {
            $text = $m['text'];
            $liOptions = array();
            $linkOptions = array();
            $url = isset($m['items']) ? '#' : $m['url'];
            
            if(isset($m['items']))
            {
                $liOptions = array('class'=>'dropdown');
                $text = $m['text'] . Html::tag('span', '', array('class'=>'caret'));
                $linkOptions = array(
                    'class'=>'dropdown-toggle',
                    'data-toggle'=>'dropdown',
                    'role'=>'button',
                    'aria-expanded'=>'false',
                );
                
            }
            
            echo Html::openTag('li', $liOptions);
            echo Html::link($url, $text , $linkOptions);
            if(isset($m['items']))
                echo self::menu($m['items'], array('class'=>'dropdown-menu', 'role'=>'menu',));
            echo Html::closeTag('li');
            
        }
        echo Html::closeTag('ul');
        return ob_get_clean();
    }
    
    public static function flash()
    {
        
    }
}
