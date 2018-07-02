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
    <div class="col col-sm-12 col-lg-10 offset-md-1">
        <form action="{{route('user-edit-account', request('id'))}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_key" value="{{request('id')}}">
            <div class="form-group">
                <label for="user_name">{{__('crebs::interface.user_name')}}</label>
                <input type="text"
                       class="form-control {{$errors->has('user_name') ? 'is-invalid' : ''}}"
                       id="user_name" name="user_name"
                       value="{{old('user_name') !== null ? old('user_name'): $user->name}}"
                       placeholder="{{__('crebs::interface.user_name')}}"
                       maxlength="105" minlength="5" required>
                @if ($errors->has('user_name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                @endif
                <label for="user_mail">{{__('crebs::interface.email')}}</label>
                <input type="email"
                       class="form-control {{$errors->has('user_mail') ? 'is-invalid' : ''}}"
                       id="user_mail" name="user_mail"
                       value="{{old('user_mail') !== null ? old('user_mail'): $user->email}}"
                       placeholder="{{__('crebs::interface.mail')}}"
                       maxlength="105" minlength="5" required>
                @if ($errors->has('user_mail'))
                    <span class="text-danger">
                    <strong>{{ $errors->first('user_mail') }}</strong>
                </span>
                @endif
                @if(can(['user_edit', 'user_manager'], false))
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="active" id="active" {{$user->active == true ? 'checked' : ''}}>
                    <label class="form-check-label" for="active">{{__('crebs::interface.active')}}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                           name="verified" id="verified" {{$user->verified == true ? 'checked' : ''}}>
                    <label class="form-check-label" for="verified">{{__('crebs::interface.verified')}}</label>
                </div>
                @endif
                <br>
                <input type="submit" class="form-control btn btn-danger" value="{{__('crebs::interface.btn_save')}}">
            </div>
        </form>
    </div>
    <div class="col col-sm-12">
        <hr>
        @if(!(auth()->user()->isAdmin()))
            <form action="{{route('change-pass-post', request('id'))}}" method="post">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="password_current"
                           class="col-md-4 col-form-label text-md-right">{{ __('crebs::interface.pass-current') }}</label>

                    <div class="col-md-6">
                        <input id="password_current" type="password"
                               class="form-control{{ $errors->has('password_current') ? ' is-invalid' : '' }}"
                               name="password_current" required>

                        @if ($errors->has('password_current'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_current') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-md-4 col-form-label text-md-right">{{ __('crebs::interface.pass-new') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm"
                           class="col-md-4 col-form-label text-md-right">{{ __('crebs::interface.pass-confirm-new') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('crebs::interface.btn-change-pass') }}
                        </button>
                    </div>
                </div>
            </form>
        @else
            <form action="{{route('user-edit-pass', request('id'))}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="_key" value="{{request('id')}}">
                <div class="form-group">
                    <label for="password">{{__('crebs::interface.pass-new')}}</label>
                    <input type="password"
                           class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                           id="password" name="password"
                           placeholder="{{__('crebs::interface.pass')}}"
                           maxlength="255" minlength="6" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <br>
                    <label for="password_confirmation">{{__('crebs::interface.pass-confirm-new')}}</label>
                    <input type="password"
                           class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}"
                           id="password_confirmation" name="password_confirmation"
                           placeholder="{{__('crebs::interface.pass-confirm-new')}}"
                           maxlength="255" minlength="5" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                    @endif
                    <br>
                    <input type="submit" class="form-control btn btn-danger"
                           value="{{__('crebs::interface.btn_save')}}">
                </div>
            </form>
        @endif
    </div>
@endsection
