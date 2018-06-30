<?php

namespace Crebs86\Acl\Controllers;
use App\Http\Controllers\Controller;
use Crebs86\Acl\Controllers\Util\Util;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crebs::home')->with(['title' => Util::buildBreadCumbs([])]);
    }
}
