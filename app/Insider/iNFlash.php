<?php
namespace Insider;

use \Session;

class iNFlash
{
    //protected static __counter__ = 0;
    const __counter__ = '!!--fCount--!!';
    const __prefix__ = '!!--inflash--!!#';
    const __breaker__ = '!!#|#!!';
    
    protected static function add($type, $message, $params=array())
    {
        $n = self::getN()+1;
        
        
        $packet = implode(self::__breaker__, array(
            $type,
            $message,
            json_encode($params)
        ));
        
        self::setN($n);
        
        Session::flash(self::getMID($n), $packet);
    }
    
    public static function info($message, $params=array())
    {
        self::add('info', $message, $params);
    }
    
    public static function warn($message, $params=array())
    {
        self::add('warn', $message, $params);
    }
    
    public static function getFlashMessages()
    {
        $collection = array();
        $n = self::getN();
        for($i=1; $i <= self::getN(); $i++)
        {
            $packet =  Session::get(self::getMID($i), NULL);
            if(!isset($packet)) continue;
            
            $collection[] = explode(self::__breaker__, $packet);
            
        }
        
        
        return $collection;
    }
    
    protected static function getMID($n)
    {
        $k = self::__prefix__ . $n;
        return $k;
    }
    
    protected static function getN()
    {
        return Session::get(self::__counter__, 0);
    }
    
    protected static function setN($n)
    {
        return Session::set(self::__counter__, $n);
    }
    
    public static function html()
    {        
        $html = '';
        $messages = iNFlash::getFlashMessages();
        foreach ($messages as $m) {
            $html .= Html::tag('div', $m[1], array('class'=>$m[0]));
        }
        
        self::setN(0);
        
        return $html;
    }
}
