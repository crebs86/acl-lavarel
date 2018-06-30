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
    <div class="col col-sm-12">
        <h3>
            <a href="{{route('user-edit', Crypt::encryptString($user->id))}}" title="{{__('crebs::interface.edit')}}"
               class="text-white">
                {{__('crebs::interface.profile_edit_info')}} <span class="glyphicon glyphicon-edit"></span>
            </a>
        </h3>
        <span>
        <p>{{__('crebs::interface.user')}}: <span class="font-weight-bold">{{$user->name}}</span></p>
        <p>{{__('crebs::interface.email')}}:  <span class="font-weight-bold">{{$user->email}}</span></p>
        <p>{{__('crebs::interface.pass')}}: **********</p>
    </span>
    </div>
    <div class="col col-sm-12">
        @can('acl_manager')
            <h3>
                <a href="{{route('user-edit-roles', Crypt::encryptString($user->id, env('APP_KEY')))}}"
                   title="{{__('crebs::interface.edit_role_user')}}" class="text-white">
                    {{__('crebs::interface.edit_user_role')}} <span class="glyphicon glyphicon-edit text-white"></span>
                </a>
            </h3>
        @else
            <h3 class="text-white">
                {{__('crebs::interface.user_role')}}
            </h3>
        @endcan
        <table class="table table-striped table-dark table-bordered">
            <thead class="table-light text-dark">
            <tr>
                <th>{{__('crebs::interface.roles')}}</th>
                <th>{{__('crebs::interface.description')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <td class="bg bg-danger">
                        {{$role->name}}
                    </td>
                    <td>
                        {{$role->label}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        {{__('crebs::interface.user_no_role')}}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <hr>
    </div>
    <div class="col col-sm-12">
        <h3>{{__('crebs::interface.user_profile')}}
            @can('user-edit')
                <a href="{{route('edit-profile', Crypt::encryptString($user->id, env('APP_KEY')))}}"
                   title="{{__('crebs::interface.edit_user_profile')}}">
                    <span class="glyphicon glyphicon-edit text-dark"></span>
                </a>
            @endcan
        </h3>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {!! session()->get('success')!!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if($user->profile != null)
            <p>Avatar </p>
            <p>{{__('crebs::interface.full_name')}}: <strong>{{$user->profile->full_name}}</strong></p>
            <p>{{__('crebs::interface.branch')}}: <strong>{{$user->profile->branch_line}}</strong></p>
            <p>{{__('crebs::interface.address')}}: <strong>{{$user->profile->address}}</strong></p>
            <p>{{__('crebs::interface.sector')}}: <strong>{{$user->profile->sector}}</strong></p>
        @else
            <h4>No Profile</h4>
        @endif
    </div>
@endsection