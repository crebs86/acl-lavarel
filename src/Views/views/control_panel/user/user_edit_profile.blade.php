<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 10/04/18
 * Time: 21:25
 */
?>
@extends('crebs::layouts.panel_bt_40')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('crebs::interface.user_profile')}}</div>
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <b>{!! session()->get('success')!!}</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{route('user-edit-profile-post', Crypt::encryptString($profile->user_id))}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="full_name">{{__('crebs::interface.full_name')}}</label>
                                <input type="text"
                                       class="form-control {{$errors->has('full_name') ? 'is-invalid' : ''}}"
                                       id="full_name" name="full_name"
                                       value="{{old('full_name') !== null ? old('full_name'): $profile->full_name}}"
                                       placeholder="Full Name"
                                       maxlength="105" minlength="5" required>
                                @if ($errors->has('full_name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">{{__('crebs::interface.address')}}</label>
                                <input type="text"
                                       class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                                       id="address" name="address"
                                       value="{{old('address') !== null ? old('address') : $profile->address}}"
                                       placeholder="Address"
                                       maxlength="105" minlength="2" required>
                                @if ($errors->has('address'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sector">{{__('crebs::interface.sector')}}</label>
                                <input type="text"
                                       class="form-control {{$errors->has('sector') ? 'is-invalid' : ''}}"
                                       id="sector" name="sector"
                                       value="{{old('sector') !== null ? old('sector') : $profile->sector}}"
                                       placeholder="Sector"
                                       maxlength="55" minlength="2" required>
                                @if ($errors->has('sector'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('sector') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="branch">{{__('crebs::interface.branch')}}</label>
                                <input type="text"
                                       class="form-control {{$errors->has('branch_line') ? 'is-invalid' : ''}}"
                                       id="branch" name="branch_line"
                                       value="{{old('branch_lina') !== null ? old('branch_line') : $profile->branch_line}}"
                                       placeholder="Branch Line"
                                       maxlength="55" minlength="1" required>
                            </div>
                            @if ($errors->has('branch_line'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('branch_line') }}</strong>
                                </span>
                            @endif
                            <input type="submit" class="btn btn-primary form-control"
                                   value="{{__('crebs::interface.save')}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
