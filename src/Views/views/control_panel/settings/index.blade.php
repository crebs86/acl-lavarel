<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 25/06/18
 * Time: 20:36
 */
?>
@extends('crebs::layouts.panel_bt_40')
@section('content')
    @can('system_manager')
        <div class="container bg-dark">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card bg-dark text-white">
                        <div class="card-header">
                            <h3>
                                {{__('crebs::interface.settings')}}
                                <i class="fa fa-plus-circle" data-toggle="collapse" data-target="#form-role"
                                   aria-expanded="false"
                                   aria-controls="form-role">
                                </i>
                            </h3>
                        </div>
                        <div class="col col-sm-12 collapse
                            @if($errors->count() != 0)
                                show
                            @endif
                                " id="form-role">
                            <h2>{{__('crebs::interface.new_setting')}}</h2>
                            <form action="{{route('setting-new')}}" method="POST">
                                {{csrf_field()}}
                                @if($errors->count() != 0)
                                    <div class="form-group">
                                        <label for="name">{{__('crebs::interface.name')}}</label>
                                        @if($errors->has('name'))
                                            <input type="text" class="form-control is-invalid" id="name" name="name"
                                                   value="{{old('name')}}"
                                                   placeholder="{{__('crebs::interface.setting_name')}}"
                                                   maxlength="55" minlength="4" required>
                                            <div class="invalid-feedback">
                                                <strong>{{$errors->first('name')}}</strong>
                                            </div>
                                        @else
                                            <input type="text" class="form-control is-valid" id="name" name="name"
                                                   value="{{old('name')}}"
                                                   placeholder="{{__('crebs::interface.setting_name')}}"
                                                   maxlength="55" minlength="4" required>
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
                                                      placeholder="{{__('crebs::interface.setting_description')}}"
                                                      maxlength="175" minlength="10"
                                                      required>{{old('desc')}}</textarea>
                                            <div class="invalid-feedback">
                                                {{$errors->first('desc')}}
                                            </div>
                                        @else
                                            <textarea class="form-control is-valid" id="desc" name="desc"
                                                      placeholder="{{__('crebs::interface.setting_description')}}"
                                                      maxlength="175" minlength="10"
                                                      required>{{old('desc')}}</textarea>
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
                                               placeholder="{{__('crebs::interface.setting_name')}}"
                                               maxlength="55" minlength="4" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">{{__('crebs::interface.description')}}</label>
                                        <textarea class="form-control" id="desc" name="desc"
                                                  placeholder="{{__('crebs::interface.setting_description')}}"
                                                  maxlength="175" minlength="10" required></textarea>
                                    </div>
                                @endif
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary"
                                           value="{{__('crebs::interface.setting_new')}}">
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <label for="active">Current settings:</label>
                            <form method="post" action="{{route('setting-active-setting')}}">
                                {{csrf_field()}}
                                <select name="active" id="active">
                                    <option value="{{Crypt::encryptString($setting->id)}}">{{$setting->label}}</option>
                                    @foreach($settings as $value)
                                        <option value="{{Crypt::encryptString($value->id)}}">{{$value->label}}</option>
                                    @endforeach
                                    <input class="btn btn-primary" type="submit"
                                           value="{{__('crebs::interface.apply')}}">
                                </select>
                            </form>
                            <form method="post" action="{{route('setting-post')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{Crypt::encryptString($setting->id)}}">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="validate_mail"
                                           name="validate_mail" {{$setting->validate_mail == true ? 'checked' : ''}}>
                                    <label for="validate_mail">{{__('crebs::interface.need_valid_mail')}}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ac_account"
                                           name="ac_account" {{$setting->ac_account == true ? 'checked' : ''}}>
                                    <label for="ac_account">{{__('crebs::interface.active_account')}}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="protect_register_form"
                                           name="protect_register_form" {{$setting->protect_register_form == true ? 'checked' : ''}}>
                                    <label for="protect_register_form">{{__('crebs::interface.register_form_needs_auth')}}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="protect_register_form_admin"
                                           name="protect_register_form_admin" {{$setting->protect_register_form_admin == true ? 'checked' : ''}}>
                                    <label for="protect_register_form_admin">{{__('crebs::interface.register_form_needs_admin')}}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="menu_show_users"
                                           name="menu_show_users" {{$setting->menu_show_users == true ? 'checked' : ''}}>
                                    <label for="menu_show_users">{{__('crebs::interface.user_can_show_menu')}}</label>
                                </div>
                                <input type="submit" class="btn btn-success form-control"
                                       value="{{__('crebs::interface.btn_save')}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
