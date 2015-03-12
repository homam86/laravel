<?php
namespace Insider;

use Insider\Html;
use Insider\iNUtil;

class iNTable
{
    /**
     * Used to get HTML string that used to represent a data in HTML table.
     * @param $config array contains several attributes:
     * <ul>
     * <li>header: array contains the text used as headers in table. </li>
     * <li>datasource: array contains the data to be displayed inside the table body, the
     * content of the array maybe objects or arrays. </li>
     * <li>columns (optional): array contains the name of attributes used to extract the data from
     * the datasource, if the datasource entries is an objects, then, the extraction is done by
     * getting the data as public attribute from the object, otherwise, if the datasource is a
     * collection of arrays, then the extraction is done via getting the value of the specified key
     * from the array. </li>
     * </ul>
     */
    public static function html($config)
    {
        $header = isset($config['header']) ? $config['header'] : null;
        $columns = isset($config['columns']) ? $config['columns'] : null;
        $datasource = isset($config['datasource']) ? $config['datasource'] : null;
        $htmlOptions = isset($config['htmlOptions']) ? $config['htmlOptions'] : array();
        $decorator = isset($config['decorator']) ? $config['decorator'] : array();
        
                
        echo Html::openTag('table', $htmlOptions);
        
        if(is_array($header))
        {
            $html = "";
            foreach ($header as $t)
                $html .= Html::tag('th', $t);
            
            echo Html::tag('thead', Html::tag('tr', $html));
        }
        
        if(!isset($columns))
        {
            throw new Exception('You must specifiy the columns attribute to determine which data to e displayed');
        }
        
        echo Html::openTag('tbody');
        try
        {
            foreach($datasource as $row)
            {
                $html = "";
                
                foreach($columns as $k)
                {
                    $data = isset($row[$k]) ? $row[$k] : (isset($row->$k) ? $row->$k : '');
                    if(isset($decorator[$k]))
                        $data = iNUtil::evaluateExpression($decorator[$k], array('data'=>$row));
                    $html .= Html::tag('td', $data);
                } 
                echo Html::tag('tr', $html);
                
            }
        }
        catch (Exception $x) {
            
        }
            
        echo Html::closeTag('tbody'); 
        
        echo Html::closeTag('table');        
        return ob_get_clean();
        
    }
}
