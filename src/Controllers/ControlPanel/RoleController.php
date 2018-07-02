<?php

namespace Crebs86\Acl\Controllers\ControlPanel;

use Crebs86\Acl\Facades\Acl;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Crebs86\Acl\Models\Role;
use Crebs86\Acl\Controllers\Util\Util;
use Crebs86\Acl\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use Crebs86\Acl\Request\Role as ReqRole;

class RoleController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware('auth');
        $this->middleware('access');
        $this->middleware('active');
    }

    /**
     * @return $this
     */
    public function index()
    {
        Acl::can('acl_view', false);
        $roles = $this->role->all();
        return view('crebs::control_panel.role.role_list')
            ->with(['roles' => $roles, 'title' => Util::buildBreadCumbs([], __('crebs::interface.roles'))]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function view(Request $request)
    {
        Acl::can('acl_view', false);
        $role = $this->role->where(['id' => Crypt::decryptString($request->id), 'name' => $request->name])->first();
        return view('crebs::control_panel.role.role_view')
            ->with(['role' => $role, 'permissions' => $role->permissions, 'title' => Util::buildBreadCumbs([__('crebs::interface.roles') => route('role-index')], __('crebs::interface.view_permissions_role', ['role_name' => $role->name]))]);
    }

    /**
     * @param ReqRole $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function new(ReqRole $request)
    {
        Acl::can('acl_manager');
        $role = new Role();
        $role->name = $request->name;
        $role->label = $request->desc;
        $role->save();
        return redirect(route('role-index'))->with(['message' => __('crebs::cp-messages.create_role_success', ['rolename' => $role->name])]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function edit(Request $request)
    {
        Acl::can('acl_manager');
        $role = $this->role->where(['id' => Crypt::decryptString($request->id), 'name' => $request->name])->first();
        return view('crebs::control_panel.role.role_edit')
            ->with(['role' => $role, 'title' => Util::buildBreadCumbs(['Roles' => route('role-index'), $role->name => route('role-view', [$request->name, $request->id])], __('crebs::interface.edit'))]);
    }

    /**
     * @param ReqRole $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editPost(ReqRole $request)
    {
        Acl::can('acl_manager');
        $role = $this->role->find(Crypt::decryptString($request->id));
        $role->name = $request->name;
        $role->label = $request->desc;
        $role->save();
        return redirect(route('role-index'))->with(['message' => __('crebs::cp-messages.edit_role_success', ['papel' => $role->name])]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        Acl::can('acl_manager');
        $role = $this->role->find(Crypt::decryptString($request->id));
        $role->delete();
        return redirect(route('role-index'))->with(['message' => __('crebs::cp-messages.remove_role_success', ['rolename' => $role->name])]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function editPermissions(Request $request)
    {
        Acl::can('acl_manager');
        $role = $this->role->select('id', 'name')->find(Crypt::decryptString($request->id));
        return view('crebs::control_panel.role.role_edit_permission')
            ->with(['name' => $request->name, 'id' => $request->id,
                'title' => Util::buildBreadCumbs([__('crebs::interface.roles') => route('role-index'), $role->name => route('role-view', [$role->name, Crypt::encryptString($role->id)])], __('crebs::interface.role_edit_permissions'))]);
    }

    /**
     * @param Request $request
     * @param Permission $permission
     * @return view()
     * 'permissions'=>$role deveria ser 'roles'=>$role, mas ficará assim até resolver o bug
     */
    public function editPermissionFrame(Request $request, Permission $permission)
    {
        Acl::can('acl_manager');
        //recupera usuário
        $role = $this->role->find(Crypt::decryptString($request->id));
        //recupera papéis
        $rolePermission = $role->permissions()->get();
        $permissions = $permission->all();
        return view('crebs::control_panel.role.iframe_role_edit_permission')
            ->with(['permissions' => $permissions, 'id' => $request->id, 'rolePermission' => $rolePermission, 'arrayRolesPermissions' => Util::rolesArray($rolePermission, $permissions), 'role' => $role,
                'title' => Util::buildBreadCumbs([], __('crebs::interface.roles'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editPermissionFrameAddPost(Request $request)
    {
        Acl::can('acl_manager');
        if (!Util::checkPermissionStatus(Crypt::decryptString($request->id), Crypt::decryptString($request->permission))) {
            DB::table('permission_role')->insert(
                ['role_id' => Crypt::decryptString($request->id), 'permission_id' => Crypt::decryptString($request->permission)]
            );
        }
        $permissionname = Permission::select('name')->find(Crypt::decryptString($request->permission));
        return redirect(route('role-edit-permission-frame', [$request->name, $request->id]))->with(['message' => __('crebs::cp-messages.role_add_permission', ['permissionname' => $permissionname->name])]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editPermissionFrameRemovePost(Request $request)
    {
        Acl::can('acl_manager');
        DB::table('permission_role')->where(
            ['role_id' => Crypt::decryptString($request->id), 'permission_id' => Crypt::decryptString($request->permission)]
        )->delete();
        $permissionname = Permission::select('name')->find(Crypt::decryptString($request->permission));
        return redirect(route('role-edit-permission-frame', [$request->name, $request->id]))
            ->with(['message' => __('crebs::cp-messages.role_remove_permission', ['permissionname' => $permissionname->name])]);
    }
}
