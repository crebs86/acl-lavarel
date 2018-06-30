<?php
use Illuminate\Routing\Route;

/**
 * @param string $role
 * @param int $errorCode
 */
function checkRoles(string $role, int $errorCode, bool $needIsSAdmin=true)
{
    $cRole = new \App\Http\Controllers\Controller();
    if (!$cRole->authorize($role) ||
        auth()->user()->isSAdmin() == false &&
        auth()->user()->isSAdmin() !== $needIsSAdmin):
        abort($errorCode);
    endif;
}

/**
 * @param string $role
 * @param int $errorCode
 * @param $roleSet
 */
function checkAdminRoles(string $role, int $errorCode, $roleSet,  bool $needIsSAdmin=true)
{
    if ($roleSet->name == 'admin' && !\Illuminate\Support\Facades\Auth::user()->isSAdmin() || $roleSet->name == 'super-admin' && !\Illuminate\Support\Facades\Auth::user()->isSAdmin()):
        abort($errorCode);
    endif;
    checkRoles($role, $errorCode, $needIsSAdmin);
}

function testes()
{


}

function serErrors()
{

}