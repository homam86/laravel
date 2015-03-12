<?php
namespace Insider;

use \Session;

class iNFlash3
{
    protected $messages = array();
    
    protected function add($type, $message, $params=array())
    {
        $packet = array($type,  $message,  $params);
    }
    
    public function info($message, $params=array())
    {
        $this->add('info', $message, $params);
    }
    
    public function getMessages()
    {
        return $this->message;
    }
    
    public function html()
    {
        $html = '';
        foreach ($this->messages as $m) {
            $html .= Html::tag('li', $m[1]);
        }
        
        return Html::tag('ul', $html);
    }
}
