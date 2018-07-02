@extends('crebs::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('crebs::interface.register') }}</div>

                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {!! session()->get('success')!!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('crebs::interface.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('crebs::interface.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('crebs::interface.pass') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('crebs::interface.pass-confirm') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <hr>
                        <form action="{{route('user-edit-profile-post')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="full_name">{{__('crebs::interface.full_name')}}</label>
                                <input type="text"
                                       class="form-control {{$errors->has('full_name') ? 'is-invalid' : ''}}"
                                       id="full_name" name="full_name"
                                       value="{{old('full_name')}}"
                                       placeholder="Full Name"
                                       maxlength="105" minlength="5" required>
                                @if ($errors->has('full_name'))
                                    <span class="text-danger">
                                            <strong>{{ $errors->profile->first('full_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">{{__('crebs::interface.address')}}</label>
                                <input type="text"
                                       class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                                       id="address" name="address"
                                       value="{{old('address')}}"
                                       placeholder="Address"
                                       maxlength="105" minlength="1" required>
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
                                       value="{{old('sector')}}"
                                       placeholder="Sector"
                                       maxlength="55" minlength="1" required>
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
                                       value="{{old('branch_line')}}"
                                       placeholder="Branch Line"
                                       maxlength="55" required>
                                @if ($errors->has('branch_line'))
                                    <span class="text-danger">
                                            <strong>{{ $errors->first('branch_line') }}</strong>
                                        </span>
                                @endif
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary form-control">
                                    {{ __('crebs::interface.register-btn') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
