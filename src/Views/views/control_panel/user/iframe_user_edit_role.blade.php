<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 11/04/18
 * Time: 19:31
 */
?>
<link href="{{url('css/app.css')}}" rel="stylesheet">
<link href="{{asset('vendor/crebs86/acl-laravel/css/bootstrap.css')}}" rel="stylesheet">
<script src="{{url('js/app.js')}}" type="text/javascript"></script>
<div class="col col-sm-12 col-lg-10 offset-md-1">
    <h3>{!! __('crebs::interface.user_edit_role_title', ['username'=> $user->name])!!}</h3>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {!! session()->get('message')!!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table table-striped table-success table-bordered">
        <thead class="table-light text-dark">
        <tr>
            <th width="200">{{__('crebs::interface.role')}}</th>
            <th>{{__('crebs::interface.description')}}</th>
            <th class="text-center">{{__('crebs::interface.change-status')}}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($roleUser as $role)
            <tr>
                <td class="bg bg-success">
                    {{$role->name}}
                </td>
                <td>
                    {{$role->label}}
                </td>

                <td class="text-center">
                    @if($role->name=="super-admin" && auth()->user()->isSAdmin() || $role->name=="admin" && auth()->user()->isSAdmin())
                        <a class="text-white" href="#"
                           title="{{__('crebs::interface.user_role_remove')}}"
                           onclick="event.preventDefault();
                                   document.getElementById({{$role->id}}).submit();">
                            <span class="glyphicon glyphicon-check"></span>
                        </a>
                        <form action="{{ route('user-edit-role-frame-remove-post', Crypt::encryptString( $user->id)) }}"
                              method="POST" style="display: none;" id="{{$role->id}}">
                            {{csrf_field()}}
                            <input type="text" name="role" value="{{$role->id}}" style="display: none;">
                        </form>
                    @elseif($role->name !='admin' && $role->name != 'super-admin')
                        <a class="text-white" href="#"
                           title="{{__('crebs::interface.user_role_remove')}}"
                           onclick="event.preventDefault();
                                   document.getElementById({{$role->id}}).submit();">
                            <span class="glyphicon glyphicon-check"></span>
                        </a>
                        <form action="{{ route('user-edit-role-frame-remove-post', Crypt::encryptString($user->id)) }}"
                              method="POST" style="display: none;" id="{{$role->id}}">
                            {{csrf_field()}}
                            <input type="text" name="role" value="{{$role->id}}" style="display: none;">
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">
                    {{__('crebs::interface.user_no_roles')}}
                </td>
            </tr>
        @endforelse
        @forelse($roles as $role)
            @if(!in_array($role->id, $arrayUserRoles))
                @if($role->name=="super-admin" && auth()->user()->isSAdmin() || $role->name=="admin" && auth()->user()->isSAdmin())
                    <tr class="table-danger text-muted">
                        <td>
                            {{$role->name}}
                        </td>
                        <td>
                            {{$role->label}}
                        </td>
                        <td class="text-center">
                            <a class="text-white" href="#"
                               title="{{__('crebs::interface.user_role_add')}}"
                               onclick="event.preventDefault();
                                       document.getElementById({{$role->id}}).submit();">
                                <span class="glyphicon glyphicon-unchecked"></span>
                            </a>
                            <form action="{{ route('user-edit-role-frame-post', Crypt::encryptString($user->id)) }}"
                                  method="POST" style="display: none;" id="{{$role->id}}">
                                {{csrf_field()}}
                                <input type="text" name="role" value="{{$role->id}}" style="display: none;">
                            </form>
                        </td>
                    </tr>
                @elseif($role->name !='admin' && $role->name != 'super-admin')
                    <tr class="table-danger text-muted">
                        <td>
                            {{$role->name}}
                        </td>
                        <td>
                            {{$role->label}}
                        </td>
                        <td class="text-center">
                            <a class="text-white" href="#"
                               title="{{__('crebs::interface.user_role_add')}}"
                               onclick="event.preventDefault();
                                       document.getElementById({{$role->id}}).submit();">
                                <span class="glyphicon glyphicon-unchecked"></span>
                            </a>
                            <form action="{{ route('user-edit-role-frame-post', Crypt::encryptString($user->id)) }}"
                                  method="POST" style="display: none;" id="{{$role->id}}">
                                {{csrf_field()}}
                                <input type="text" name="role" value="{{$role->id}}" style="display: none;">
                            </form>
                        </td>
                    </tr>
                @endif
            @endif
        @empty
        @endforelse
        </tbody>
    </table>
</div>
