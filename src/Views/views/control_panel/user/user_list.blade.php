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
    <link href="{{asset('vendor/crebs86/acl-laravel/css/bootstrap.css')}}" rel="stylesheet">
    <table class="table table-striped table-dark table-bordered">
        <thead class="table-light text-dark">
        <tr>
            <th width="200">{{__('crebs::interface.users')}}</th>
            <th>{{__('crebs::interface.roles')}}</th>
            <th class="text-center">{{__('crebs::interface.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="font-weight-bold">
                <td class="bg bg-danger">
                    {{$user->name}}
                </td>
                <td>
                    @forelse($roles as $role)
                        @if($user->id == $role->roleuserid)
                            |
                            <a href="{{route('role-view', [$role->rolename, Crypt::encryptString($role->roleid)])}}"
                               class="text-white">{{$role->rolename}}</a>
                        @else
                        @endif
                    @empty
                    @endforelse
                </td>
                <td width="150" class="text-center">
                    <a href="{{route('user-view', [Crypt::encryptString($user->id)])}}"
                       title="{{__('crebs::interface.show')}}">
                        <i class="glyphicon glyphicon-search text-success"></i>
                    </a>
                    @can('user_edit_role')
                        <a href="{{route('user-edit-roles', [Crypt::encryptString($user->id)])}}"
                           title="{{__('crebs::interface.edit_role_user')}}">
                            <i class="glyphicon glyphicon-lock"></i>
                        </a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection