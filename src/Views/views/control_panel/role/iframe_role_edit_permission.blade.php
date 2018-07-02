<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 29/04/18
 * Time: 09:26
 */
?>
<link href="{{url('css/app.css')}}" rel="stylesheet">
<link href="{{asset('vendor/crebs86/acl-laravel/css/bootstrap.css')}}" rel="stylesheet">
<script src="{{url('js/app.js')}}" type="text/javascript"></script>
<div class="col col-sm-12 col-lg-10 offset-md-1">
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {!! session()->get('message')!!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h3>{!! __('crebs::interface.edit_permissions_role', ['rolename'=>$role->name])!!}</h3>
    <table class="table table-striped table-success table-bordered">
        <thead class="table-light text-dark">
        <tr>
            <th width="200">{{__('crebs::interface.permission')}}</th>
            <th>{{__('crebs::interface.description')}}</th>
            <th class="text-center">{{__('crebs::interface.change-status')}}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($rolePermission as $permission)
            <tr>
                <td class="bg bg-success">
                    {{$permission->name}}
                </td>
                <td>
                    {{$permission->label}}
                </td>

                <td class="text-center">
                    <a class="text-white" href="#" title="{{__('crebs::interface.remove_role')}}"
                       onclick="event.preventDefault();
                               document.getElementById({{$permission->id}}).submit();">
                        <span class="glyphicon glyphicon-check"></span>
                    </a>
                    <form action="{{ route('role-edit-permission-post-frame', [$role->name, Crypt::encryptString($role->id)]) }}"
                          method="POST"
                          style="display: none;" id="{{$permission->id}}">
                        {{csrf_field()}}
                        <input type="text" name="permission" value="{{Crypt::encryptString($permission->id)}}"
                               style="display: none;">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">
                    {{__('crebs::interface.role_no_permission')}}
                </td>
            </tr>
        @endforelse
        @forelse($permissions as $permission)
            @if(!in_array($permission->id, $arrayRolesPermissions))
                <tr class="table-danger text-muted">
                    <td>
                        {{$permission->name}}
                    </td>
                    <td>
                        {{$permission->label}}
                    </td>
                    <td class="text-center">
                        <a class="text-white" href="#" title="{{__('crebs::interface.add_role')}}"
                           onclick="event.preventDefault();
                                   document.getElementById({{$permission->id}}).submit();">
                            <span class="glyphicon glyphicon-unchecked"></span>
                        </a>
                        <form action="{{ route('role-edit-permission-post', [$role->name, Crypt::encryptString($role->id)]) }}"
                              method="POST"
                              style="display: none;" id="{{$permission->id}}">
                            {{csrf_field()}}
                            <input type="text" name="permission" value="{{Crypt::encryptString($permission->id)}}"
                                   style="display: none;">
                        </form>
                    </td>
                </tr>
            @endif
        @empty
        @endforelse
        </tbody>
    </table>
</div>
