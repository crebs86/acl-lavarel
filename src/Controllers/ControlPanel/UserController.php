<?php

namespace Crebs86\Acl\Controllers\ControlPanel;

use Crebs86\Acl\Controllers\Util\Util;
use Crebs86\Acl\Models\Profile;
use Crebs86\Acl\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Crebs86\Acl\Facades\Acl;
use Illuminate\Support\Facades\Hash;
use Crebs86\Acl\Request\Profile as ReqProfile;

class UserController extends Controller
{
    use Notifiable;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth')->except('confirmRegistration');;
        $this->middleware('access')->except(['confirmRegistration', 'requestConfirmRegistration']);
        $this->middleware('active')->except('confirmRegistration');
    }

    public function index()
    {
        Acl::check(['user_manager', 'user_view'], false)->on();
        $users = $this->user->all();
        $roles = User::select('role_user.user_id as roleuserid', 'roles.name as rolename', 'roles.id as roleid', 'users.name', 'role_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->get();

        return view('crebs::control_panel.user.user_list')->with(['users' => $users,
            'title' => Util::buildBreadCumbs([], __('crebs::interface.users')), 'roles' => $roles]);
    }

    public function view(Request $request)
    {
        Acl::check(['user_manager', 'user_view'], false)->on();
        //recupera usuário
        $user = User::find(Crypt::decryptString($request->id));
        //recupera papéis
        $roles = $user->roles()->get();
        return view('crebs::control_panel.user.user_view')->with(['user' => $user, 'roles' => $roles,
            'title' => Util::buildBreadCumbs([__('crebs::interface.users') => route('user-index')], $user->name)]);
    }

    public function edit(Request $request)
    {
        $user_id = $request->id != null ? Crypt::decryptString($request->id) : auth()->user()->id;
        $user = $this->user->find($user_id);
        Acl::check(['user_edit', 'user_manager'])->self($user->profile);
        return view('crebs::control_panel.user.user_edit')
            ->with(['user' => $user, 'title' => Util::buildBreadCumbs([__('crebs::interface.users') => route('user-index'), $user->name => route('user-view', $request->id)], __('crebs::interface.edit'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * method used by user like administrator roles
     */
    public function editPassword(Request $request)
    {
        Acl::check('user_manager', false)->on();
        if (Crypt::decryptString($request->id) === Crypt::decryptString($request->_key)):
            $request->validate([
                'password' => 'required|between:6,255|confirmed',
            ]);
            $user = $this->user->find(Crypt::decryptString($request->_key));
            $user->password = bcrypt($request->get('password'));
            $user->save();
            return redirect()->back()->with(['message' => __('crebs::cp-messages.change_pass_success')]);
        endif;
        return redirect()->back()->with(['error' => __('crebs::interface.error')]);
    }

    private $email_nochanged = false;

    public function editUser(Request $request)
    {
        if (Crypt::decryptString($request->id) === Crypt::decryptString($request->_key)):
            $request->validate([
                'user_name' => 'required|between:5,105',
                'user_mail' => 'required|between:6,255|email|unique:users,email,' . Crypt::decryptString($request->_key),
            ]);
            $user = $this->user->find(Crypt::decryptString($request->_key));
            Acl::check(['user_edit', 'user_manager'])->self($user->profile);
            $this->email_nochanged = $user->email === $request->user_mail;

            if ($this->email_nochanged):
                $user->verified = $request->verified == null ? false : true;
            else:
                $user->email_token = str_random(55);
                $user->verified = false;
            endif;
            $user->email = $request->user_mail;
            $user->name = $request->user_name;
            $user->active = $request->active == null ? false : true;
            $user->save();
            if (!$this->email_nochanged):
                $this->resendEmailVerification(Crypt::decryptString($request->id));
            endif;
            return redirect()->back()->with(['message' => __('crebs::cp-messages.change_account_success')]);
        endif;
        return redirect()->back()->with(['error' => __('crebs::interface.error')]);
    }

    private function resendEmailVerification(int $id)
    {
        $user = $this->user->find($id);
        $user->sendVerificationEmail();
    }

    public function requestConfirmRegistration()
    {
        $user = $this->user->find(Auth::user()->id);
        $user->email_token = str_random(55);
        $user->save();
        $user->sendVerificationEmail();
        return redirect(route('home'))->with(['message' => __('crebs::cp-messages.user_mail_check', ['email' => $this->user->email])]);
    }

    /**
     * @param Request $request
     * @return view user_edit_role
     */
    public function editRoles(Request $request)
    {
        Acl::check('acl_manager', false);
        $user = $this->user->select('id', 'name')->find(Crypt::decryptString($request->id));
        return view('crebs::control_panel.user.user_edit_role')
            ->with(['user_id' => $request->id,
                'title' => Util::buildBreadCumbs([__('crebs::interface.users') => route('user-index'), $user->name => route('user-view', $request->id)], __('crebs::interface.user_edit_role'))]);
    }

    public function editRolesFrame(Request $request, Role $role)
    {
        Acl::check('acl_manager', false)->on();
        //recupera usuário
        $user = $this->user->find(Crypt::decryptString($request->user_id, env('APP_KEY')));
        //recupera papéis
        //dd($user);

        $roleUser = $user->roles()->get();
        $roles = $role->all();
        return view('crebs::control_panel.user.iframe_user_edit_role')
            ->with(['roles' => $roles, 'id' => Crypt::encryptString($request->user_id), 'roleUser' => $roleUser, 'arrayUserRoles' => Util::rolesArray($roleUser, $user), 'user' => $user]);
    }

    public function editRolesFrameAddPost(Request $request, Role $role)
    {
        Acl::checkAdminRoles('acl_manager', $role->where('id', $request->role)->first(), false);
        if (!Util::checkRoleStatus(Crypt::decryptString($request->user_id), $request->role)) {
            DB::table('role_user')->insert(
                ['user_id' => Crypt::decryptString($request->user_id), 'role_id' => $request->role]
            );
        }
        return redirect(route('user-edit-role-frame', [$request->user_id]))
            ->with(['message' => __('crebs::cp-messages.user_add_role')]);
    }

    public function editRolesFrameRemovePost(Request $request, Role $role)
    {
        Acl::checkAdminRoles('acl_manager', $role->where('id', $request->role)->first(), false);
        DB::table('role_user')->where(
            ['user_id' => Crypt::decryptString($request->user_id), 'role_id' => $request->role]
        )->delete();
        return redirect(route('user-edit-role-frame', [$request->user_id]))
            ->with(['message' => __('crebs::cp-messages.user_remove_role')]);
    }

    public function userShowRoles()
    {
        $user = $this->user->find(auth()->user()->id);
        Acl::check(['user_view', 'user_manager'])->self($user->profile);
        return view('crebs::control_panel.user.user_show_roles')->with(['user' => $user, 'title' => Util::buildBreadCumbs(["{$user->name}" => ''], __('crebs::interface.roles'))]);
    }

    /**
     * -----------------------
     * User Profile
     * -----------------------
     * @param Request $request
     */

    /**
     * @return view(form edit user profile)
     */
    public function userEditProfile(Request $request)
    {
        $user_id = $request->id != null ? Crypt::decryptString($request->id) : auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        Acl::check(['user_edit', 'user_manager'])->self($user->profile);
        return view('crebs::control_panel.user.user_edit_profile')->with(['user' => Auth::user(), 'profile' => $user->profile,
            'title' => Util::buildBreadCumbs([$user->name => route('user-view', Crypt::encryptString($user_id))], __('crebs::interface.edit_profile'))]);
    }

    /**
     * @param ReqProfile $request
     * @return view(form edit user profile - with message)
     */
    public function userEditProfilePost(ReqProfile $request)
    {
        $user = $request->id != null ? Crypt::decryptString($request->id) : auth()->user()->id;
        $profile = Profile::where('user_id', $user)->first();
        Acl::check(['user_edit', 'user_manager'])->self($profile);
        $profile->branch_line = $request->branch_line;
        $profile->full_name = $request->full_name;
        $profile->address = $request->address;
        $profile->sector = $request->sector;
        //$profile->avatar = $request->avatar;
        $profile->save();

        return redirect()->back()->with(['user' => Auth::user(), 'profile' => $profile, 'success' => __('crebs::cp-messages.profile_edited'),
            'title' => Util::buildBreadCumbs([__('crebs::interface.users') => route('user-profile')], __('crebs::interface.edit_profile'))]);
    }

    /**
     * @return view(user informations)
     * Profile
     * Roles
     */
    public function userProfile(Request $request)
    {
        $user_id = $request->user_id != null ? $request->user_id : auth()->user()->id;
        $user = User::where('id', $user_id)->first();//user
        $roles = $user->roles()->get();//roles
        Acl::check(['user_view', 'user_manager'])->self($user->profile);
        return view('crebs::control_panel.user.user_view')
            ->with(['user' => $user, 'roles' => $roles,
                'title' => Util::buildBreadCumbs([__('crebs::interface.users') => route('user-index')], $user->name)]);
    }

    /**
     * --------------------------
     * Confirmation valid mail
     * --------------------------
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmRegistration(Request $request)
    {
        $userCheck = User::where('email_token', $request->token)->first();
        if ($userCheck == true && Auth::check() && $userCheck->email == Auth::user()->email):
            $userCheck->verified = true;
            $userCheck->email_token = null;
            $userCheck->save();
            return redirect(route('home'))->with(['success' => __('crebs::cp-messages.account_verified')]);
        elseif ($userCheck == true && Auth::check() && $userCheck->email != Auth::user()->email):
            return redirect(route('home'))->with(['error' => __('crebs::cp-messages.user_logged_try_mail_verify')]);
        elseif ($userCheck == false && Auth::check()):
            return redirect(route('home'))->with(['error' => __('crebs::cp-messages.account_check_error_logged')]);
        elseif ($userCheck == false && !(Auth::check())):
            return redirect('/login')->with(['error' => __('crebs::cp-messages.account_check_error')]);
        elseif ($userCheck == true && !(Auth::check())):
            $userCheck->verified = true;
            $userCheck->email_token = null;
            $userCheck->save();
            return redirect(route('login'))->with(['success' => __('crebs::cp-messages.account_verified')]);
        endif;
        return redirect(route('login'))->with(['success' => __('crebs::cp-messages.account_check_error')]);
    }

    /**
     * -------------------------
     * change user password
     * -------------------------
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFormChangePass()
    {
        return view('crebs::auth.passwords.change_pass');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePass(Request $request)
    {
        if (!(Hash::check($request->get('password_current'), Auth::user()->password))) {
            return redirect()->back()->with("error", __('crebs::cp-messages.change_pass_no_matches'));
        }

        if (strcmp($request->get('password_current'), $request->get('password')) == 0) {
            return redirect()->back()->with("error", __('crebs::cp-messages.change_pass_same'));
        }

        $request->validate([
            'password_current' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = Auth::user();
        Acl::check(['user_edit', 'user_manager'])->self($user->profile);
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->back()->with("success", __('crebs::cp-messages.change_pass_success'));
    }

}
