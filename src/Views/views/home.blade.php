@extends('crebs::layouts.panel_bt_40')
@section('content')
    <div class="container bg-dark">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card bg-dark text-white">
                    <div class="card-header">{{__('crebs::interface.control_panel')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->user()->verified() || Acl::verified())

                            <h2>{{__('crebs::interface.welcome',['username'=>auth()->user()->name])}}</h2>
                            {{__('crebs::interface.have_today')}}
                        @else
                            <p>This account is not activated. An confirmation email has been sent to your email
                                address
                                during account register.</p> <a href="{{ route('user-confirm-mail-resend') }}"
                                                                onclick="event.preventDefault();
                                                     document.getElementById('resend-form').submit();">
                                <button class="btn btn-success">Resend confirmation mail.</button>
                            </a>
                            <form id="resend-form" action="{{ route('user-confirm-mail-resend') }}" method="POST"
                                  style="display: none;">
                                {{csrf_field()}}
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
