<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 01/06/18
 * Time: 18:03
 */

namespace Crebs86\Acl\Controllers\Util;

use Crebs86\Acl\Facades\Acl;
use Crebs86\Acl\Controllers\ControlPanel\Setting;
use Illuminate\Support\Facades\Gate;

class ControlAccess
{

    private $suffix = "";
    private $errorCode = "";

    private $valid = false;
    private $role;
    public $message;

    private $needIsAdmin = true;

    public function __construct()
    {
        $this->suffix = config('cre_acl.self_suffix');
        $this->errorCode = config('cre_acl.unauthorized');
        $this->message = config('cre_acl.default_message');
    }

    /**
     ** false if user not authorized...
     * ... or is not a super admin when this is necessary
     * @param string|array $role
     * @param bool $needIsSAdmin
     * @return $this
     */
    public function checkRoles($roles, bool $needIsSAdmin = true)
    {
        $this->needIsAdmin = $needIsSAdmin;
        if (is_array($roles)):
            foreach ($roles as $key => $value):
                if ($this->functionCheck($value)):
                    $this->valid = true;
                endif;
            endforeach;
            $this->role = $roles;
            return $this;
        else:
            if ($this->functionCheck($roles)):
                $this->role = $roles;
                $this->valid = true;
                return $this;
            endif;
        endif;
        $this->role = $roles;
        $this->valid = false;
        return $this;
    }

    /**
     * @param string $role
     * @return bool
     */
    private function functionCheck(string $role)
    {
        if (Gate::allows($role) && $this->needIsAdmin === true):
            return auth()->user()->isSAdmin() === true;
        elseif (Gate::allows($role)):
            return true;
        endif;
    }

    /**
     * @param string $role
     * @param bool $needIsSAdmin
     * abort if cannot
     */
    public function can($roles, bool $needIsSAdmin = true)
    {
        $this->needIsAdmin = $needIsSAdmin;
        if (is_array($roles)):
            foreach ($roles as $key => $value):
                if ($this->functionCheck($value)):
                    $this->valid = true;
                endif;
            endforeach;
        else:
            if ($this->functionCheck($roles)):
                $this->valid = true;
            endif;
        endif;
        $this->on();
    }

    /**
     * check role
     */
    public function on()
    {
        if (!$this->valid):
            abort($this->errorCode, $this->message);
        endif;
    }

    /**
     * @return bool
     */
    public function get()
    {
        return $this->valid;
    }

    /**
     * @param $own
     */
    public function self($own)
    {
        if ($this->valid === false):

            if (is_array($this->role)):
                foreach ($this->role as $key => $value):
                    $this->role[] = $value . $this->suffix;
                endforeach;
            endif;
            $this->valid = $own->user_id === auth()->user()->id &&
                $this->checkRoles($this->role, false)->get();
        endif;
        $this->on();
    }

    /**
     * security for create admin and super-admin roles
     * @param string $role
     * @param $roleSet
     * @param bool $needIsSAdmin
     */
    public function checkAdminRoles(string $role, $roleSet, bool $needIsSAdmin = true)
    {
        if ($roleSet->name == 'admin' && !\Illuminate\Support\Facades\Auth::user()->isSAdmin() ||
            $roleSet->name == 'super-admin' && !\Illuminate\Support\Facades\Auth::user()->isSAdmin()):
            abort($this->errorCode);
        endif;
        Acl::checkRoles($role, $needIsSAdmin);
    }

    /**
     * @var bool
     */
    private $setting = false;

    /**
     * check system config and if user cant do the action
     * @param array $keys
     * @param string $message
     * @return void
     */
    public function setted(array $keys, string $message = "")
    {
        $this->message = $message;
        $settings = new Setting();
        if ($this->setting == false && $settings->getDBSettings($keys)->cantDo()):
            abort($this->errorCode, $this->message);
        endif;
    }

    /**
     * @param $need => receive bool condition
     * @return $this
     */
    public function needs($need = false)
    {
        $this->setting = $need;
        return $this;
    }

    public function verified()
    {
        $setting = new Setting();
        return !$setting->getDBSettings(['validate_mail'])->cantDo();
    }
}