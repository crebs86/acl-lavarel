<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 22/04/18
 * Time: 19:11
 */
?>
@extends('crebs::layouts.panel_bt_40')
@section('content')
    <div class="col col-sm-12">
        <form action="{{route('permission-edit-post', [$permission->name, Crypt::encryptString($permission->id)])}}" method="POST">
            {{csrf_field()}}
            @if($errors->count() != 0)
                <div class="form-group">
                    <label for="desc">{{__('crebs::interface.description')}}</label>
                    @if($errors->has('name'))
                        <input type="text" class="form-control is-invalid" id="name" name="name"
                               value="{{old('name')}}"
                               placeholder="{{__('crebs::interface.permission_name')}}"
                               maxlength="55" minlength="5" required>
                        <div class="invalid-feedback">
                            <strong>{{$errors->first('name')}}</strong>
                        </div>
                    @else
                        <input type="text" class="form-control is-valid" id="name" name="name"
                               value="{{old('name')}}"
                               placeholder="{{__('crebs::interface.permission_name')}}"
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
                                  placeholder="{{__('crebs::interface.permission_desc')}}"
                                  maxlength="175" minlength="10" required>{{old('desc')}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('desc')}}
                        </div>
                    @else
                        <textarea class="form-control is-valid" id="desc" name="desc"
                                  placeholder="{{__('crebs::interface.permission_desc')}}"
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
                    <label for="desc">{{__('crebs::interface.name')}}</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{$permission->name}}"
                           placeholder="{{__('crebs::interface.permission_name')}}"
                           maxlength="55" minlength="5" required>
                </div>
                <div class="form-group">
                    <label for="desc">{{__('crebs::interface.description')}}</label>
                    <textarea class="form-control" id="desc" name="desc"
                              placeholder="{{__('crebs::interface.permission_desc')}}"
                              maxlength="175" minlength="10" required>{{$permission->label}}</textarea>
                </div>
            @endif
            <div class="text-right">
                <input type="submit" class="form-control btn btn-primary" value="{{__('crebs::interface.save')}}">
            </div>
        </form>
    </div>
@endsection
