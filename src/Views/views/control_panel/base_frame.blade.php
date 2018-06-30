<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 21/04/18
 * Time: 09:09
 */
?>
@extends('crebs::layouts.panel_bt_40')
@section('content')
    <link href="{{asset('vendor/crebs86/acl-laravel/css/bootstrap.css')}}" rel="stylesheet">
    <div class="col col-sm-12">
        <div>
            <iframe src="{{action($action)}}
            @if(isset($arg1))
                    /{{$arg1}}
            @endif
            @if(isset($arg2))
                    /{{$arg2}}
            @endif
            @if(isset($arg3))
                    /{{$arg3}}
            @endif
                    " width="100%" height="380px" frameborder="0">

            </iframe>
        </div>
    </div>
@endsection
