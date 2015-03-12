<?php
namespace Insider;

class Html
{
    public static function openTag($tag, $htmlOptions=array())
    {
        $options = self::getOptionsString($htmlOptions);
        return "<$tag $options>";
    }

    public static function tag($tag, $content=null, $htmlOptions=array(), $selfClosing=false)
    {
        $selfClosing = !isset($content) && $selfClosing;

        $options = self::getOptionsString($htmlOptions);

        if (isset($content))
            return "<$tag $options>$content</$tag>";
        else
            return "<$tag $options" .($selfClosing ? ' /' : "></$tag" ).">";
    }

    public static function closeTag($tag)
    {
        return "</$tag>";
    }

    public static function beginForm($action='', $method="POST", $htmlOptions=array())
    {
        $htmlOptions['method'] = $method;
        $htmlOptions['action'] = self::url($action);
        return self::openTag('form', $htmlOptions);
    }

    public static function endForm()
    {
        return "</form>";
    }

    public static function input($type, $value=null, $htmlOptions = array())
    {
        $htmlOptions['type'] = $type;
        $htmlOptions['value'] = $value;
        return self::tag('input', NULL, $htmlOptions, TRUE);
    }
    
    public static function textField($name, $value=null, $htmlOptions = array())
    {
        $htmlOptions['value'] = $value;
        $htmlOptions['name'] = $name;
        return self::input('text', $value, $htmlOptions, TRUE);
    }
    
    public static function hidden($name, $value=null, $htmlOptions = array())
    {
        $htmlOptions['value'] = $value;
        $htmlOptions['name'] = $name;
        return self::input('hidden', $value, $htmlOptions, TRUE);
    }
    
    public static function button($value=null, $htmlOptions = array())
    {
        return self::input('button', $value, $htmlOptions, TRUE);
    }
    
    public static function datepicker($name, $value=null, $htmlOptions = array())
    {
        if(!isset($htmlOptions['id']))
            $htmlOptions['id'] = $name.'_datepicker';
        $id = $htmlOptions['id'];
        
        $options = isset($htmlOptions['options'])? $htmlOptions['options'] : [];
        unset($htmlOptions['options']);
        $options = json_encode($options);
        
        $input = self::textField($name, $value, $htmlOptions, TRUE);
        return $input . self::tag('script', "\n(function($){\$( \"#$id\" ).datepicker($options);})(jQuery);\n");
    }
    
    public static function submit($value, $htmlOptions = array())
    {
        return self::input('submit', $value, $htmlOptions, TRUE);
    }

    public static function link($url, $text = NULL, $htmlOptions = array())
    {
        if (!isset($text))
            $text = $url;

        //$url = self::normalizeUrl($url);
        $htmlOptions['href'] =self::url($url);
        return self::tag('a', $text, $htmlOptions, TRUE);
    }

    public static function image($src, $htmlOptions = array())
    {
        $htmlOptions['src'] = $src;
        return self::tag('img', NULL, $htmlOptions, TRUE);
    }

    public static function textarea($text=NULL, $htmlOptions = array())
    {
        return self::openTag('textarea', $htmlOptions, TRUE)
            . (isset($text) ? $text : '' )
            . self::closeTag('textarea')
        ;
    }

    public static function label($text, $for = NULL, $htmlOptions = array())
    {
        if(isset($for))
            $htmlOptions['for'] = $for;
        if (isset($htmlOptions['required'])) {
            if($htmlOptions['required'])
                $text .= self::asterisk();
            unset($htmlOptions['required']);
        }
        return self::tag('label', $text, $htmlOptions);
    }

    public static function dropList($name, $value, $options = array(), $htmlOptions = array())
    {
        $htmlOptions['name'] = $name;
        $html = self::openTag('select', $htmlOptions);
        foreach($options as $key => $label)
        {
            $optHtmlOptions = array('value' => $key);
            if(isset($value) && $value==$key)
                $optHtmlOptions['selected'] = 'selected';

            $html .= self::tag('option', $label, $optHtmlOptions);
        }
        $html .= self::closeTag('select');
        return $html;
    }
    
    public static function radio($name, $value, $htmlOptions=array())
    {
        $htmlOptions['name'] = $name;
        return self::input('radio', $value, $htmlOptions);
    }
    
    public static function radioList($name, $value, $options = array(), $htmlOptions = array())
    {
        $br = isset($htmlOptions['breaker']) ? $htmlOptions['breaker'] : '&nbsp;&nbsp;&nbsp;';
        $wr = isset($htmlOptions['wrapper']) ? $htmlOptions['wrapper'] : 'span';
        unset($htmlOptions['breaker']);
        unset($htmlOptions['wrapper']);
        
        $htmlOptions['name'] = $name.'_wrapper';
        $htmlOptions['class'] = (isset($htmlOptions['class']) ? $htmlOptions['class'] : '') . '';
        
        $html = '';
        foreach($options as $key => $label)
        {
            $radHtmlOptions = array('value' => $key, 'class'=>'radio');
            if(isset($value) && $value==$key)
                $radHtmlOptions['checked'] = 'checked';

            $html .= self::tag($wr, self::radio($name, $key, $radHtmlOptions).'<span class="radio-label">'.$label.'</span>');
        }
        return self::tag('div', $html, $htmlOptions);
    }
    
    public static function checkbox($name, $value, $htmlOptions=array())
    {
        $htmlOptions['name'] = $name."[$value]";
        return self::input('checkbox', $value, $htmlOptions);
    }
    
    public static function checkboxList($name, $values, $options = array(), $htmlOptions = array())
    {
        if(!is_array($values))
            $values = [$values];
            
        $br = isset($htmlOptions['breaker']) ? $htmlOptions['breaker'] : '&nbsp;&nbsp;&nbsp;';
        $wr = isset($htmlOptions['wrapper']) ? $htmlOptions['wrapper'] : 'span';
        unset($htmlOptions['breaker']);
        unset($htmlOptions['wrapper']);
        
        $wrHOpt = array('class'=>'opt-wrap',);
        
        $html = '';
        foreach($options as $key => $label)
        {
            $elemHtmlOptions = array('value' => $key, 'class'=>'check');
            if(in_array($key, $values)) {
                $wrHOpt['class'] .= ' checked';
                $elemHtmlOptions['checked'] = 'checked';
            }

            $html .= self::tag($wr, self::checkbox($name, $key, $elemHtmlOptions).'<span class="checkbox-label">'.$label.'</span>', $wrHOpt);
        }
        return self::tag('div', $html, $htmlOptions);
    }

    protected static function getOptionsString($options=array())
    {
        $return = array();
        foreach($options as $key => $val)
            $return[] = "$key=\"$val\"";

        return implode(' ', $return);
    }

    /**
     * @param $css array that contains CSS attribute=>values, in this case, the result is string
     * contains the CSS string that can be inserted inside 'style' attributes for an HTML element.
     * @return string
     */
    public static function getCss( $css)
    {
        $return = array();
        foreach ($css as $k => $v)
            $return[] = "$k:$v";
        return implode(';', $return);
    }

    /**
     * @param $object array of arrays, where each sub-array contains the CSS attribute=>values with
     * an extra entry named '#selector', in this case, we use the '#selector' value to create a CSS
     * block to be inserted inside <style> block.
     * @return string
     */
    public static function getCssBlock( $blocks )
    {
        $return = array();
        foreach ($blocks as $b)
        {
            if(!isset($b['#selector']))
                continue; // error;
            $selector = $b['#selector'];
            unset ($b['#selector']);
            $css = self::getCss($b);

            $return[] = "$selector { $css }";
        }

        return implode("\n", $return);
    }

    public static function registerScriptUrl($src)
    {
        return self::tag('script', NULL, array(
            'type' => 'text/javascript',
            'src' => $src,
        ));
    }
    

	public static function normalizeUrl($url)
	{
        $isFullUrl = false
            || strpos($url, 'http')!==false
            || strpos($url, 'www')!==false
            || strpos($url, '.')!==false    // it maybe: '.com', '.net', ... , '.html',...
        ;
        
        if(!$isFullUrl)
            $url = \URL::to('/'.ltrim($url, '/'));
		return $url;
	}
    
    public static function asterisk($color="#EF1313")
    {
        return ' <span style="color:'.$color.';font-weight:normal">*</span>';
    }
    
    
    /**
     * A generic function used to generate URL of any kind of inputs: route, Contriler@action,
     * action or an absolute url.
     */
    public static function url($url, $params=array())
	{
        if(!isset($url) || $url=='')
            return \Request::url();
        
        if(is_array($url)) {
            die($url);
            $tmp = $url[0];
            $p = array_slice($url, 1);
            $params = array_merge($p, $params);
            $url = $tmp;
        }

        $pos = strpos($url, '#');
        if ($pos === 0)
            return substr($url, 1); // just remove the # and do nothing with url
        
        
        
        $pos = strpos($url, '@');
        if ($pos !== false) {
            
            return \Illuminate\Support\Facades\URL::action($url, $params);
            
        }
        
        return \Illuminate\Support\Facades\URL::to('/'.ltrim($url, '/'), $params);

	}
    
    public static function csrf($encrypt = true)
    {
        $token = csrf_token();
        
        if($encrypt)
            $token = app('Illuminate\Encryption\Encrypter')->encrypt($token);
            
        return $token;
    }
    
    public static function csrfField($encrypt = true)
    {        
        return self::hidden('_token', csrf_token());
    }

}
