<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 29/04/18
 * Time: 09:29
 */
?>
@extends('crebs::layouts.panel_bt_40')
@section('content')
    <link href="{{asset('vendor/crebs86/acl-laravel/css/bootstrap.css')}}" rel="stylesheet">
    <div class="col col-sm-12">
        <div class="embed-responsive embed-responsive-21by9">
            <iframe src="{{route('role-edit-permission-frame', [$name, $id])}}" class="embed-responsive-item"></iframe>
        </div>
    </div>
@endsection