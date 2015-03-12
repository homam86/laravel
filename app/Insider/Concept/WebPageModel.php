<?php namespace Insider\Concept;

class WebPageModel {
    
    protected $menus = array();
    
    protected $header = array();
    
    public function getMenu($menu)
    {
        if($menu=='user')
            $this->rebuildUserMenuItems(); // build the menu now.
        
        return isset($this->menus[$menu]) ? $this->menus[$menu] : null;
    }
    
    public function linkScript($id, $path, $condition=null)
    {
        $this->header['script'][$id] = array('path' => $path, 'cond' => $condition);
    }
    
    public function linkStylesheet($id, $path, $condition=null)
    {
        $this->header['stylesheet'][$id] = array('path' => $path, 'cond' => $condition);
    }
    
    public function getHeader()
    {
        $header = '';
        foreach ($this->header as $key => $items)
        {
            foreach ($items as $it)
            {
                $link = "";
                
                if($key=='script')
                    $link = '<script src="'.$it['path'].'"></script>';
                    
                else if($key=='stylesheet')
                    $link = '<link rel="stylesheet" href="'.$it['path'].'">';
                
                
                if(isset($it['cond'])) $header .= "<!--[if {$it['cond']}]>\n    ";
                $header .= '    '.$link."\n";
                if(isset($it['cond'])) $header .= "<![endif]-->\n";
            }
        }
        
        return $header;
    }
    
    /**
     * Add a single item or multi-items to the specified menu.
     * @param $menu string the menu name (e.g. admin, main, context)
     * @param $data array contains a menu-item data (id, text, url) or an array
     * of arrays, while the sub arrays contains the menu-item data, and it should
     * be kayed by the item-id.
     * The item id help to modify the menu-item content (change its text or url).
     */
    public function addMenuItem($menu, $data)
    {
        if(!isset($this->menus[$menu]))
            $this->menus[$menu] = [];
            
        if(!isset($data['text']) && !(isset($data['url']) || isset($data['items']))) {
            $this->menus[$menu] = array_merge($this->menus[$menu], $data);
        }
        else
            $this->menus[$menu][isset($data['id']) ? $data['id'] : null] = $data;
    }
    
    
	
	protected function rebuildUserMenuItems()
    {
        $menu = array();
        if (\Auth::guest())
        {
            $menu['login'] = array('text'=>'Login', 'url'=>'/auth/login');
            $menu['register'] = array('text'=>'Register', 'url'=>'/auth/register');
        }
        else
        {
            $menu['account'] = array('text'=>\Auth::user()->name, 'items' => array(
                'profile' => array('text'=>'Profile', 'url'=>'/auth/profile'),
                'message' => array('text'=>'Message', 'url'=>'/auth/message'),
                'logout' => array('text'=>'Logout', 'url'=>'/auth/logout'),
            ));
            
        }
        
        $menu['admin'] = array('text'=>'Admin', 'url'=>'AdminController@getIndex');
        
        $this->addMenuItem('user', $menu);
    }
    
}
