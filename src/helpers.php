<?php

use Crebs86\Acl\Controllers\Util\ControlAccess;

if (!function_exists('have')) {
    /**
     * @param $permission
     * @param bool $needSuperAdmin
     * @return void
     */
    function have($permission, $needSuperAdmin = true)
    {
        $have = new ControlAccess();
        $have->check($permission, $needSuperAdmin)->on();
    }
}

if (!function_exists('can')) {
    /**
     * @param $permission
     * @param bool $needSuperAdmin
     * @return bool
     */
    function can($permission, $needSuperAdmin = true)
    {
        $can = new ControlAccess();
        return $can->check($permission, $needSuperAdmin)->get();
    }
}

if (!function_exists('own')) {
    /**
     * @param $permission
     * @param $collection
     * @return void
     */
    function own($permission, $collection)
    {
        $isOwn = new ControlAccess();
        $isOwn->check($permission)->self($collection);
    }
}
if (!function_exists('isOwn')) {
    /**
     * @param $permission
     * @param $collection
     * @return bool
     */
    function isOwn($permission, $collection)
    {
        $isOwn = new ControlAccess();
        return $isOwn->check($permission)->isOwn($collection);
    }
}
if (!function_exists('requireValidEmail')) {
    /**
     * @return bool
     */
    function requireValidEmail()
    {
        $setting = new \Crebs86\Acl\Controllers\ControlPanel\Setting();
        return $setting->getDBSettings(['validate_mail'])->cantDo();
    }
}
