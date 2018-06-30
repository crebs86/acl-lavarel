<?php

namespace Crebs86\Acl\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Crebs86\Acl\Models\Permission;
use Crebs86\Acl\Controllers\Util\Util;
use Crebs86\Acl\Facades\Acl;
use Crebs86\Acl\Request\Permission as ReqPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->middleware('auth');
        $this->middleware('access');
        $this->middleware('active');
    }

    /**
     * list Permissions
     * @return $this
     */
    public function index()
    {

        Acl::can('acl_view', false);
        $permissions = $this->permission->all('id', 'name', 'label')->sortBy('name');
        return view('crebs::control_panel.permissions.permission_list')
            ->with(['permissions' => $permissions, 'title' => Util::buildBreadCumbs([], __('crebs::interface.permissions'))]);
    }

    /**
     * Create Permission
     * @param ReqPermission $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPermissionPost(ReqPermission $req)
    {
        Acl::can('acl_manager');
        $permission = new Permission();
        $permission->name = $req->name;
        $permission->label = $req->desc;
        $permission->save();
        return redirect(route('permission-index'))
            ->with(['message' => __('crebs::cp-messages.create_permission_success', ['permissionname'=>$permission->name])]);
    }

    /**
     * Edit Permission Form
     * @param Request $request
     * @return $this
     */
    public function edit(Request $request)
    {
        Acl::can('acl_manager');
        $permission = $this->permission->select('id', 'label', 'name')->where(['id' => Crypt::decryptString($request->id)])->first();
        return view('crebs::control_panel.permissions.permission_edit')
            ->with(['title' => Util::buildBreadCumbs([__('crebs::interface.permissions') => route('permission-index')], __('crebs::interface.edit_permissions', ['permissionname'=>$permission->name])), 'permission' => $permission]);
    }

    /**
     * Edit Permission Save
     * @param ReqPermission $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editPost(ReqPermission $request)
    {
        Acl::can('acl_manager');
        $permission = $this->permission->find(Crypt::decryptString($request->id));
        if ($permission != null):
            $permission->name = $request->name;
            $permission->label = $request->desc;
            $permission->save();
        else:
            abort(400, 'Error');
        endif;
        return redirect(route('permission-index'))
            ->with(['message' => __('crebs::cp-messages.edit_permissions_success', ['permissionname'=>$request->name])]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        Acl::can('acl_manager');
        $permission = $this->permission->find(Crypt::decryptString($request->id));
        if ($permission != null):
            $permission->delete();
        else:
            abort(400, 'Errou');
        endif;
        return redirect(route('permission-index'))
            ->with(['message' => __('crebs::cp-messages.remove_permission_success', ['permissionname'=>$permission->name])]);
    }

}
