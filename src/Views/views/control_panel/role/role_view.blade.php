<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 11/04/18
 * Time: 19:31
 */
?>
@extends('crebs::layouts.panel_bt_40')
@section('content')
    @can('acl_view')
    <link href="{{asset('vendor/crebs86/acl-laravel/css/bootstrap.css')}}" rel="stylesheet">
    <div class="col col-sm-12">
        <h2>{{__('crebs::interface.view_role', ['rolename'=>$role->name])}}
            @if(auth()->user()->isSAdmin())
            <a href="{{route('role-edit-permission', [$role->name, Crypt::encryptString($role->id)])}}" title="Adicionar/Remover Permissões">
                <span class="glyphicon glyphicon-edit text-white"></span>
            </a>
            @endif
        </h2>
        <table class="table table-striped table-dark table-bordered">
            <thead class="table-light text-dark">
            <tr>
                <th width="150">{{__('crebs::interface.permission')}}</th>
                <th>{{__('crebs::interface.description')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td class="bg bg-danger">{{$permission->name}}</td>
                    <td>{{$permission->label}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endcan
@endsection