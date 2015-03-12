<?php
namespace Insider\Concept\Composers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;

use \Insider\Html;
use \Insider\iNFlash;

class ViewComposer
{
    protected $flashbox = '';
    protected $main_menu = array();
    protected $other_menu = array();
    
    public function __construct()
    {
        //$this->flashbox = $this->getFlashBox();
        $this->main_menu = $this->getMainMenuItems();
        $this->other_menu = $this->getOtherMenuItems();
    }
    
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('mainmenu', $this->main_menu);
        $view->with('othermenu', $this->other_menu);
        //$view->with('flashbox', $this->flashbox);
    }
    
    protected function getFlashBox()
    {
        $html = '';
        $messages = iNFlash::getFlashMessages();
        foreach ($messages as $m) {
            $html .= Html::tag('li', $m[1]);
        }
        
        return Html::tag('ul', $html);
    }
    
    
    public function getMainMenuItems()
    {
        return array(
            array('text'=>'Home', 'url'=>URL::to('/')),
            array('text'=>'Meal', 'url'=>URL::to('/meal')),
            array('text'=>'Menu', 'url'=>URL::to('/menu')),
            array('text'=>'Orders', 'url'=>URL::to('/order')),
            array('text'=>'Users', 'url'=>URL::to('/user')),
        );
    }
    
    public function getOtherMenuItems()
    {
        $menu = array();
        if (\Auth::guest())
        {
            $menu[] = array('text'=>'Login', 'url'=>'/auth/login');
            $menu[] = array('text'=>'Register', 'url'=>'/auth/register');
        }
        else
        {
            $menu['user'] = array('text'=>\Auth::user()->name, 'items' => array(
                array('text'=>'Profile', 'url'=>'/auth/profile'),
                array('text'=>'Message', 'url'=>'/auth/message'),
                array('text'=>'Logout', 'url'=>'/auth/logout'),
            ));
            
        }
        
        $menu[] = array('text'=>'Admin', 'url'=>Html::url('AdminController@getIndex'));
        
        return $menu;
    }
    
    public function getOtherMenuItems1()
    {
        $menu = array();
        if (\Auth::guest())
        {
            $menu[] = array('text'=>'Login', 'url'=>'/auth/login');
            $menu[] = array('text'=>'Register', 'url'=>'/auth/register');
        }
        else
        {
            $menu[] = array('text'=>'Logout', 'url'=>'/auth/logout');
            
        }
        
        $menu[] = array('text'=>'Admin', 'url'=>'/auth/admin');
        
        return $menu;
    }
    
    
}

?>