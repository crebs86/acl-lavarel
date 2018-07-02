<?php

namespace App;

use Crebs86\Acl\Models\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Crebs86\Acl\Models\Role;
use Crebs86\Acl\Models\Permission;

use Crebs86\Acl\Notifications\VerifyEmail;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_token', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function perm()
    {
        return
            DB::table('role_user')
                ->where('user_id', '=', auth()->user()->id)
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->join('permission_role', 'permission_role.role_id', '=', 'role_user.role_id')
                ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                ->get();
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }


    /**
     * @var array user roles
     */
    private $diff_roles = [];

    /**
     * @param $roles => needed roles
     * @return bool
     */
    public function hasAdminsRoles($roles)
    {
        if (is_array($roles) || is_object($roles)):
            foreach ($this->roles as $key => $value):
                $this->diff_roles[] = $value->name;
            endforeach;
            return array_intersect($this->diff_roles, $roles) == true;
        endif;
        return $this->roles->contains('name', $roles);
    }

    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)):
            return !!$roles->intersect($this->roles)->count();
        endif;
        return $this->roles->contains('name', $roles);
    }

    /**
     * @param $roles
     * @return mixed
     */
    public function hasAnyRolesId($roles)
    {
        if (is_array($roles) || is_object($roles)):
            return $roles->intersect($this->roles)->count();
        endif;
        return $this->roles->contains('id', $roles);
    }/**/

    /**
     * @return bool
     */
    public function isSAdmin()
    {
        return $this->hasAnyRoles('super-admin');
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasAdminsRoles(['super-admin', 'admin']);
    }

    /**
     * @return bool
     */
    public function verified()
    {
        return $this->verified == true;
    }

    /**
     * @return bool
     */
    public function activedAccount()
    {
        return $this->active == true;
    }

    /**
     * @return  void
     */
    public function sendVerificationEmail()
    {
        if (requireValidEmail()):
            $this->notify(new VerifyEmail($this));
        endif;
    }
}
