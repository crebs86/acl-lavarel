<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'middleware' => 'web'
    ], function () {

    /**
     * ------------------------------------- *
     *  Auth routes
     * ------------------------------------- *
     */
    Route::get('login', 'Crebs86\Acl\Controllers\Auth\LoginController@showLoginForm')->name('login');
    /**
     * User login and logout
     */
    Route::post('login', 'Crebs86\Acl\Controllers\Auth\LoginController@login');
    Route::post('logout', 'Crebs86\Acl\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('logout', 'Crebs86\Acl\Controllers\Auth\LoginController@logout');
    /**
     * User register
     */
    Route::get('register', 'Crebs86\Acl\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Crebs86\Acl\Controllers\Auth\RegisterController@register');
    /**
     * Password Reset
     */
    Route::get('password/reset', 'Crebs86\Acl\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Crebs86\Acl\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Crebs86\Acl\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Crebs86\Acl\Controllers\Auth\ResetPasswordController@reset')->name('reset');
    /**
     * ------------------------------------- *
     * Control Panel Controllers
     * ------------------------------------- *
     */
    Route::get('home', 'Crebs86\Acl\Controllers\HomeController@index')->name('home');
    Route::prefix('controlPanel')->group(function () {
        Route::get('userProfile', 'Crebs86\Acl\Controllers\ControlPanel\UserController@userProfile')->name('user-profile');
        Route::get('userProfileEdit', 'Crebs86\Acl\Controllers\ControlPanel\UserController@userEditProfile')->name('user-profile-edit');
    });
    /**
     * ---------------------------- *
     * UserController
     * ---------------------------- *
     */
    Route::prefix('controlPanel/users')->group(function () {
        /**
         * ------------------------ *
         * User Account
         * ------------------------ *
         */
        Route::get('/', 'Crebs86\Acl\Controllers\ControlPanel\UserController@index')->name('user-index');
        Route::get('/view/{id?}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@view')->name('user-view');
        Route::get('/edit/{id?}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@edit')->name('user-edit');
        Route::get('/viewRoles', 'Crebs86\Acl\Controllers\ControlPanel\UserController@userShowRoles')->name('user-show-roles');
        /**
         * ------------------------- *
         * User Edit Roles
         * ------------------------- *
         */
        Route::get('/edit/roles/{id?}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@editRoles')->name('user-edit-roles');
        Route::get('/edit/roles/frame/{user_id?}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@editRolesFrame')->name('user-edit-role-frame');
        Route::post('/edit/roles/frame/add/{user_id}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@editRolesFrameAddPost')->where('id', '[0-9]+')->name('user-edit-role-frame-post');
        Route::post('/edit/roles/frame/remove/{user_id}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@editRolesFrameRemovePost')->where('id', '[0-9]+')->name('user-edit-role-frame-remove-post');
        /**
         * ------------------------- *
         * User Edit Profile
         * ------------------------- *
         */
        Route::get('/edit/profile/{id?}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@userEditProfile')->name('edit-profile');
        Route::post('/edit/profile/{id?}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@userEditProfilePost')->name('user-edit-profile-post');
        /**
         * --------------------------- *
         * Change Password
         * --------------------------- *
         */
        Route::get('/changePass', 'Crebs86\Acl\Controllers\ControlPanel\UserController@showFormChangePass')->name('change-pass');
        Route::post('/changePass', 'Crebs86\Acl\Controllers\ControlPanel\UserController@changePass')->name('change-pass-post');

        Route::get('/confirmRegistration/{token}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@confirmRegistration')->name('user-confirm-mail');
        Route::post('/requestConfirmRegistration', 'Crebs86\Acl\Controllers\ControlPanel\UserController@requestConfirmRegistration')->name('user-confirm-mail-resend');
        /**
         * ------------------------- *
         * User Edit
         * ------------------------- *
         */
        Route::post('edit/user/pass/{id}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@editPassword')->name('user-edit-pass');
        Route::post('edit/user/account/{id}', 'Crebs86\Acl\Controllers\ControlPanel\UserController@editUser')->name('user-edit-account');
    });
    /**
     * ------------------------------------- *
     *RoleController
     * ------------------------------------- *
     */
    Route::prefix('controlPanel/roles')->group(function () {
        Route::get('/', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@index')->name('role-index');
        Route::post('/new', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@new')->name('role-new');
        Route::get('/view/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@view')->name('role-view');
        Route::post('/delete', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@delete')->name('role-delete');
        Route::get('/edit/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@edit')->name('role-edit');
        Route::post('/edit/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@editPost')->name('role-edit-post');
        Route::get('/edit/permissions/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@editPermissions')->name('role-edit-permission');
        Route::get('/edit/permissions/frame/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@editPermissionFrame')->name('role-edit-permission-frame');
        Route::post('/edit/permissions/frame/add/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@editPermissionFrameAddPost')->name('role-edit-permission-post');
        Route::post('/edit/permissions/frame/remove/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\RoleController@editPermissionFrameRemovePost')->name('role-edit-permission-post-frame');
    });
    /**
     * ------------------------------------- *
     * PermissionController
     * ------------------------------------- *
     */
    Route::prefix('controlPanel/permissions')->group(function () {
        Route::get('/', 'Crebs86\Acl\Controllers\ControlPanel\PermissionController@index')->name('permission-index');
        Route::post('/add', 'Crebs86\Acl\Controllers\ControlPanel\PermissionController@addPermissionPost')->name('add-permission');
        Route::get('/edit/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\PermissionController@edit')->name('permission-edit');
        Route::post('/edit/{name}/{id}', 'Crebs86\Acl\Controllers\ControlPanel\PermissionController@editPost')->name('permission-edit-post');
        Route::post('/delete', 'Crebs86\Acl\Controllers\ControlPanel\PermissionController@delete')->name('permission-delete');
    });
    /**
     * ------------------------------------- *
     * Settings
     * ------------------------------------- *
     */
    Route::prefix('controlPanel/settings')->group(function () {
        Route::get('/', 'Crebs86\Acl\Controllers\ControlPanel\Setting@index')->name('settings-index');
        Route::post('/', 'Crebs86\Acl\Controllers\ControlPanel\Setting@setSettings')->name('setting-post');
        Route::post('setActiveSetting', 'Crebs86\Acl\Controllers\ControlPanel\Setting@setActiveSettings')->name('setting-active-setting');
        Route::post('new', 'Crebs86\Acl\Controllers\ControlPanel\Setting@newSetting')->name('setting-new');
    });
});
