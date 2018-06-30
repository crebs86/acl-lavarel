<?php

namespace Crebs86\Acl\Controllers\ControlPanel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControlPanel extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('access');
        $this->middleware('active');
    }

    public function userProfile(){
        return view('control_panel.user_profile')->with(['roles' => auth()->user()->roles]);
    }

    public function userView(Request $id){
        return $id->id;
    }

}
