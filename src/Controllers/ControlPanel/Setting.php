<?php

namespace Crebs86\Acl\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Crebs86\Acl\Controllers\Util\Util;
use Crebs86\Acl\Facades\Acl;
use Crebs86\Acl\Models\Setting as SettingModel;
use Crebs86\Acl\Request\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Setting extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('access')->only('index');
        $this->middleware('active')->only('index');
    }

    public function index()
    {
        Acl::can('system_manager', false);
        $setting = SettingModel::where('active', true)->first();
        $settings = SettingModel::all(['id', 'label']);
        return view('crebs::control_panel.settings.index')
            ->with(['title' => Util::buildBreadCumbs([], __('crebs::interface.settings')), 'setting' => $setting, 'settings' => $settings]);
    }

    private $keys = [];
    private $settings = null;

    /**
     * @param array $keys
     * @return mixed => active settings
     */
    public function getDBSettings(array $keys)
    {
        $this->keys = $keys;
        $this->settings = SettingModel::where('active', true)->select($this->keys)->first();
        return $this;
    }

    /**
     * denies if action is protected and users no have privileges
     * need only true value
     * @return bool
     */
    public function cantDo()
    {
        foreach ($this->keys as $key => $value):
            if ($this->settings->$value == true):
                return true;
            endif;
        endforeach;
        return false;
    }

    /**
     * @var bool
     */
    private $status = true;

    /**
     * verify if user account was validate trough email
     * @return bool
     */
    public function checkIfIsVerified()
    {
        if (auth()->user()->verified() == false):
            $this->setRedirect('/home');
            $this->status = false;
        endif;
        return $this->status;
    }

    /**
     * verify if account is active
     * @return bool
     */
    public function checkIfIsActive()
    {
        if (auth()->user()->activedAccount() == false):
            $this->setRedirect('/logout', ["error" => __('crebs::cp-messages.active_account_autologout')]);
            $this->status = false;
        endif;
        return $this->status;
    }

    private $id = null;

    /**
     * set active settings
     * @param Settings $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setSettings(Request $request)
    {
        $this->id = Crypt::decryptString($request->id);
        $settings = SettingModel::find($this->id);
        $settings->validate_mail = $request->validate_mail == null ? false : true;
        $settings->ac_account = $request->ac_account == null ? false : true;
        $settings->protect_register_form = $request->protect_register_form == null ? false : true;
        $settings->protect_register_form_admin = $request->protect_register_form_admin == null ? false : true;
        $settings->menu_show_users = $request->menu_show_users == null ? false : true;
        $settings->update();
        $this->refreshSettings($this->id);
        return redirect(route('settings-index'))->with(['message' => __('crebs::cp-messages.settings_updated_success')]);
    }

    /**
     * @param int $setting
     * @return void
     */
    private function refreshSettings(int $setting)
    {
        SettingModel::where('id', '!=', $setting)
            ->update(['active' => false]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setActiveSettings(Request $request)
    {
        $this->id = Crypt::decryptString($request->active);
        SettingModel::where('id', $this->id)->update(['active' => true]);
        $this->refreshSettings($this->id);
        return redirect(route('settings-index'))
            ->with(['message' => __('crebs::cp-messages.settings_updated_success')]);
    }

    /**
     * @param Settings $settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newSetting(Settings $settings)
    {
        $setting = new SettingModel();
        $setting->name  = $settings->name;
        $setting->label = $settings->desc;
        $setting->active = false;
        $setting->save();
        return redirect(route('settings-index'))->with(['message' => __('crebs::cp-messages.settings_created_success', ['settingname'=>$setting->name])]);
    }

    /**
     * @var string
     */
    private $redirect = 'home';
    /**
     * @var array
     */
    private $msg = [];

    /**
     * @param string $redirect
     * @param array $msg
     */
    private function setRedirect(string $redirect, $msg = [])
    {
        $this->redirect = $redirect;
        $this->msg = $msg;
    }

    /**
     * define URL redirect
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirect;
    }

    /**
     * define message displayed
     * @param array $msg
     * @return array
     */
    public function msg($msg = [])
    {
        if ($msg != [] && $msg != null):
            $this->msg = $msg;
        endif;
        return $this->msg;
    }
}
