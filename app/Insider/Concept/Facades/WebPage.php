<?php namespace Insider\Concept\Facades;

use Illuminate\Support\Facades\Facade;

class WebPage extends Facade
{
    protected static function getFacadeAccessor() { return 'webpage'; }
}