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
        <form action="{{route('role-edit-post', [$role->name, Crypt::encryptString($role->id)])}}"
              method="POST">
            {{csrf_field()}}
            <h2>{{__('crebs::interface.role_edit_form_title')}}</h2>
            @if($errors->count() != 0)
                <div class="form-group">
                    <label for="name">{{__('crebs::interface.name')}}</label>
                    @if($errors->has('name'))
                        <input type="text" class="form-control is-invalid" id="name" name="name"
                               value="{{old('name')}}"
                               placeholder="name"
                               maxlength="55" minlength="4" required>
                        <div class="invalid-feedback">
                            <strong>{{$errors->first('name')}}</strong>
                        </div>
                    @else
                        <input type="text" class="form-control is-valid" id="name" name="name"
                               value="{{old('name')}}"
                               placeholder="name"
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
                                  placeholder="Description Role"
                                  maxlength="175" minlength="10" required>{{old('desc')}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('desc')}}
                        </div>
                    @else
                        <textarea class="form-control is-valid" id="desc" name="desc" placeholder="Description Role"
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
                           value="{{$role->name}}"
                           placeholder="name"
                           maxlength="55" minlength="4" required>
                </div>
                <div class="form-group">
                    <label for="desc">{{__('crebs::interface.description')}}</label>
                    <textarea class="form-control" id="desc" name="desc" placeholder="Description Role"
                              maxlength="175" minlength="10" required>{{$role->label}}</textarea>
                </div>
            @endif
            <div class="text-right">
                <input type="submit" class="form-control btn btn-primary" value="{{__('crebs::interface.save')}}">
            </div>
        </form>
    </div>
@endsection