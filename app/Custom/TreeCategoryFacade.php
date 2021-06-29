<?php 

namespace App\Custom;

use Illuminate\Support\Facades\Facade;

class TreeCategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'treecategory';
    }
}