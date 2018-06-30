<?php

namespace Crebs86\Acl\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Util extends Controller
{
    public static function checkRoleStatus($userId, $roleId)
    {
        $numRows = DB::table('role_user')->where('role_id', $roleId)->where('user_id', $userId)->get();
        return $numRows->count() >= 1;
    }

    public static function checkPermissionStatus($roleId, $permissionId)
    {
        $numRows = DB::table('permission_role')->where('permission_id', $permissionId)->where('role_id', $roleId)->get();
        return $numRows->count() >= 1;
    }

    private static $protectedRoles = ['super-admin', 'admin'];

    private static $arrayUserRoles = [];

    /**
     * @param $roleUser
     * @param $user
     * @return array associeted roles
     */
    public static function rolesArray($roleUser, $user)
    {
        //pega as chaves dos papéis ja associado ao usuário e insere em um array
        foreach ($roleUser as $item) {
            if (!array_key_exists($item->id, $user)) {
                self::$arrayUserRoles[] = $item->id;
            }
        }
        return self::$arrayUserRoles;
    }

    /**
     * @var string
     */
    private static $breadCumb = "";

    /**
     * @param array $args
     * @param string $arg1
     * @return string
     */
    public static function buildBreadCumbs($args = [], $arg1 = "#")
    {
        foreach ($args as $arg => $key) {
            self::$breadCumb .= "<li class='breadcrumb-item'><a href='$key'>$arg</a></li>";
        }
        self::$breadCumb = self::$breadCumb . "<li class='breadcrumb-item active'>$arg1</li>";
        return self::$breadCumb;
    }
}
