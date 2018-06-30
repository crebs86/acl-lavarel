<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 16/06/18
 * Time: 12:48
 */
?>
@extends('crebs::layouts.panel_bt_40')
@section('content')
    <div class="col col-sm-12">
        <table class="table table-striped table-dark table-bordered">
            <thead class="table-light text-dark">
            <tr>
                <th>{{__('crebs::interface.roles')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->roles as $role)
                <tr>
                    <td>
                        {{$role->name}}
                        <table class="table table-striped table-hover table-bordered text-dark">
                            <tbody class="table-danger">
                            @forelse($user->perm() as $perm)
                                @if($role->id === $perm->role_id)
                                    <tr>
                                        <td>
                                            {{$perm->name}}
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <h2>{{__('crebs::interface.profile_role_no_permission')}}</h2>
                            @endforelse
                            </tbody>
                        </table>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        <h2>{{__('crebs::interface.profile_user_no_role')}}</h2>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection