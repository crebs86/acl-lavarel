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
        @can('acl_manager')
            @if(auth()->user()->isSAdmin())
                <h2 class="text-white">{{__('crebs::interface.new')}}
                    <button class="btn btn-lg bg-transparent text-white" data-toggle="collapse"
                            data-target="#form-role"
                            aria-expanded="false" aria-controls="form-role">
                        <i class="glyphicon glyphicon-plus-sign">
                        </i>
                    </button>
                </h2>
                <div class="col col-sm-12 collapse
                @if($errors->count() != 0)
                        show
                @endif
                        " id="form-role">
                    <h2>{{__('crebs::interface.new_role')}}</h2>
                    <form action="{{route('role-new')}}" method="POST">
                        {{csrf_field()}}
                        @if($errors->count() != 0)
                            <div class="form-group">
                                <label for="name">{{__('crebs::interface.name')}}</label>
                                @if($errors->has('name'))
                                    <input type="text" class="form-control is-invalid" id="name" name="name"
                                           value="{{old('name')}}"
                                           placeholder="{{__('crebs::interface.role_name')}}"
                                           maxlength="55" minlength="5" required>
                                    <div class="invalid-feedback">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </div>
                                @else
                                    <input type="text" class="form-control is-valid" id="name" name="name"
                                           value="{{old('name')}}"
                                           placeholder="{{__('crebs::interface.role_name')}}"
                                           maxlength="55" minlength="5" required>
                                    <div class="valid-feedback">
                                        @if($errors->count() > 0)
                                            OK!
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="desc">{{__('crebs::interface.description')}}</label>
                                @if($errors->has('desc'))
                                    <textarea class="form-control is-invalid" id="desc" name="desc"
                                              placeholder="{{__('crebs::interface.role_description')}}"
                                              maxlength="175" minlength="10" required>{{old('desc')}}</textarea>
                                    <div class="invalid-feedback">
                                        {{$errors->first('desc')}}
                                    </div>
                                @else
                                    <textarea class="form-control is-valid" id="desc" name="desc"
                                              placeholder="{{__('crebs::interface.role_description')}}"
                                              maxlength="175" minlength="10" required>{{old('desc')}}</textarea>
                                    <div class="valid-feedback">
                                        @if($errors->count() > 0)
                                            <strong>OK!</strong>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="form-group">
                                <label for="name">{{__('crebs::interface.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="{{__('crebs::interface.role_name')}}"
                                       maxlength="55" minlength="5" required>
                            </div>
                            <div class="form-group">
                                <label for="desc">Descrição</label>
                                <textarea class="form-control" id="desc" name="desc"
                                          placeholder="{{__('crebs::interface.role_description')}}"
                                          maxlength="175" minlength="10" required></textarea>
                            </div>
                        @endif
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary"
                                   value="{{__('crebs::interface.btn_new_role')}}">
                        </div>
                    </form>
                    @endif
                </div>
                @endcan
                <table class="table table-striped table-dark table-bordered">
                    <thead class="table-light text-dark">
                    <tr>
                        <th>{{__('crebs::interface.role')}}</th>
                        <th>{{__('crebs::interface.description')}}</th>
                        <th>{{__('crebs::interface.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @can('acl_view')
                        @foreach($roles as $role)
                            <tr>
                                <td class="bg bg-danger" width="150">
                                    <a href="{{route('role-view', [ $role->name, Crypt::encryptString($role->id)])}}"
                                       class="text-white font-weight-bold" title="visualizar {{$role->name}}">
                                        {{$role->name}}
                                    </a>
                                </td>
                                <td>{{$role->label}}</td>
                                <td class="text-center" width="80">
                                    <a href="{{route('role-view', [ $role->name, Crypt::encryptString($role->id)])}}"
                                       title="Ver Detalhes do Papel">
                                        <i class="glyphicon glyphicon-search text-success"></i>
                                    </a>
                                    @if(auth()->user()->isSAdmin())
                                        <a href="{{route('role-edit', [ $role->name, Crypt::encryptString($role->id)])}}">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#modal"
                                           onclick="setaDadosModal('{{Crypt::encryptString($role->id)}}', '{{$role->name}}')"
                                           title="{{__('crebs::interface.delete')}}">
                                            <i class="glyphicon glyphicon-trash text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endcan
                    </tbody>
                </table>
    </div>
    @can('acl_manager')
        <div id="modal" tabindex="-1" role="dialog" aria-labelledby="labelDelete" aria-hidden="true"
             class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="panel-body">
                            <p>{!! __('crebs::interface.role_delete_quest')!!}</p>
                            <form id="modalDelete" method="post"
                                  action="{{route('role-delete')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" id="id">
                                <input type="submit" class="btn btn-danger" value="{{__('crebs::interface.delete')}}">
                                <a class="btn btn-primary text-white" value="{{__('crebs::interface.cancel')}}"
                                   data-dismiss="modal">{{__('crebs::interface.cancel')}}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function setaDadosModal(id, name) {
                document.getElementById('id').value = id;
                document.getElementById('permission').innerHTML = name;
            }
        </script>
    @endcan
@endsection
