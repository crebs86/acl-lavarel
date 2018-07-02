<?php

namespace Crebs86\Acl\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Crebs86\Acl\Facades\Acl;
use Crebs86\Acl\Models\Profile;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Acl::needs(auth()->check() && auth()->user()->isAdmin())->setted(['protect_register_form', 'protect_register_form_admin'], __('crebs::cp-messages.denies_access_login_form'));
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // profile data
            'full_name' => 'required|min:5|max:105',
            'address' => 'required|max:105',
            'sector' => 'required|max:55',
            'branch_line' => 'required|max:55',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Acl::needs(auth()->check() && auth()->user()->isAdmin())->setted(['protect_register_form', 'protect_register_form_admin'], __('crebs::cp-messages.denies_access_login_form'));
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_token' => str_random(55),
        ]);
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->branch_line = $data['branch_line'];
        $profile->address = $data['address'];
        $profile->sector = $data['sector'];
        $profile->full_name = $data['full_name'];
        $profile->save();

        $role = array(
            ['user_id' => $user->id, 'role_id' => '5']
        );

        DB::table('role_user')->insert($role);

        $user->sendVerificationEmail();
        return $user;
    }

    public function register(Request $request)
    {
        Acl::needs(auth()->check() && auth()->user()->isAdmin())->setted(['protect_register_form', 'protect_register_form_admin'], __('crebs::cp-messages.denies_access_login_form'));
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        if (auth()->check()):
            if (requireValidEmail()):
                return redirect('register')->with(["success" => __('crebs::cp-messages.admin_mail_check', ['email' => $request->email])]);
            else:
                return redirect('register')->with(["success" => __('crebs::cp-messages.user_register_no_mail_check', ['email' => $request->email])]);
            endif;
        endif;
        if (requireValidEmail()):
            return redirect(url('/login'))->with(["success" => __('crebs::cp-messages.user_mail_check', ['email' => $request->email])]);
        else:
            return redirect('register')->with(["success" => __('crebs::cp-messages.user_register_no_mail_check', ['email' => $request->email])]);
        endif;
    }

    /**
     * method needs() => needed condition for access
     * method setted() => condition on setting
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        Acl::needs(auth()->check() && auth()->user()->isAdmin())->setted(['protect_register_form', 'protect_register_form_admin'], __('crebs::cp-messages.denies_access_login_form'));
        return view('crebs::auth.register');
    }
}
