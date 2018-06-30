<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 01/06/18
 * Time: 17:58
 */

namespace Crebs86\Acl\Facades;

use Illuminate\Support\Facades\Facade;

class Acl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'acl';
    }
}