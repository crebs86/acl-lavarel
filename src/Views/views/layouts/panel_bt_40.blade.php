<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{getenv('APP_NAME')}} :: Painel de Controle</title>
    <!-- Bootstrap core CSS-->
    <link href="{{asset('vendor/crebs86/acl-laravel/css/app.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/crebs86/acl-laravel/panel/vendor/font-awesome/css/font-awesome.min.css')}}"
          rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{asset('vendor/crebs86/acl-laravel/panel/css/sb-admin.min.css')}}" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('home')}}">{{getenv('APP_NAME')}}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        @if(auth()->user()->verified() || Acl::verified())
            <ul class="navbar-nav navbar-sidenav" id="accordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{route('home')}}">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">{{__('crebs::interface.panel')}}</span>
                    </a>
                </li>
                @can('acl_view')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                        <a class="nav-link" href="{{route('role-index')}}">
                            <i class="fa fa-fw fa-sitemap"></i>
                            <span class="nav-link-text">{{__('crebs::interface.roles')}}</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                        <a class="nav-link" href="{{route('permission-index')}}">
                            <i class="fa fa-fw fa-unlock"></i>
                            <span class="nav-link-text">{{__('crebs::interface.permissions')}}</span>
                        </a>
                    </li>
                @endcan
                @if(can(['user_view', 'user_manager'], false))
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                           href="#collapseComponents"
                           data-parent="#accordion">
                            <i class="fa fa-fw fa-users"></i>
                            <span class="nav-link-text">{{__('crebs::interface.users')}}</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseComponents">
                            <li>
                                <a href="{{route('user-index')}}">
                                    <i class="fa fa-fw fa-list"></i>
                                    {{__('crebs::interface.list')}}
                                </a>
                            </li>
                            @if(can(['user_create', 'user_manager'], false))
                                <li>
                                    <a class="nav-link-text" href="/register">
                                        <i class="fa fa-fw fa-user-plus"></i>
                                        {{__('crebs::interface.register')}}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti"
                       data-parent="#accordion">
                        <i class="fa fa-fw fa-user-circle-o"></i>
                        <span class="nav-link-text">{{__('crebs::interface.account')}}</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseMulti">
                        <li>
                            <a href="{{route('change-pass')}}">
                                <i class="fa fa-fw fa-exchange"></i>
                                {{__('crebs::interface.change-pass')}}
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user-show-roles')}}">
                                <i class="fa fa-fw fa-address-book"></i>
                                {{__('crebs::interface.roles')}}
                            </a>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">
                                <i class="fa fa-fw fa-address-card-o"></i>
                                {{__('crebs::interface.profile')}}
                            </a>
                            <ul class="sidenav-third-level collapse" id="collapseMulti2">
                                <li>
                                    <a href="{{route('user-profile')}}">
                                        <i class="fa fa-fw fa-search"></i>
                                        {{__('crebs::interface.show')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('user-profile-edit')}}">
                                        <i class="fa fa-fw fa-edit"></i>
                                        {{__('crebs::interface.edit')}}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @if(can('system_manager', false))
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                    <a class="nav-link" href="{{route('settings-index')}}">
                        <i class="fa fa-fw fa-wrench"></i>
                        <span class="nav-link-text">{{__('crebs::interface.settings')}}</span>
                    </a>
                </li>
                @endif
            </ul>
        @endif
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
                    <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
                    <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>David Miller</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty
                            awesome! These messages clip off when they reach the end of the box so they don't
                            overflow over to the sides!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Jane Smith</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I was wondering if you could meet for an appointment at
                            3:00 instead of 4:00. Thanks!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>John Doe</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I've sent the final files over to you for review. When
                            you're able to sign off of them let me know and we can discuss distribution.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
                    <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">New Alerts:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All
                            systems are online.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All
                            systems are online.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All
                            systems are online.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all alerts</a>
                </div>
            </li>
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0 mr-lg-2">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Buscar por...">
                        <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal">
                    {{auth()->user()->name}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper bg-secondary">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}">{{__('crebs::interface.panel')}}</a>
            </li>
            {!! $title or ' / #'!!}
        </ol>
        <div class="row">
            <div class="col col-sm-12">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {!! session()->get('success')!!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {!! session()->get('message')!!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {!! session()->get('error')!!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
    </div>
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright ©2018-{{date('Y')}} - ACL Laravel v0.9</small>
            </div>
        </div>
    </footer>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">You are ready to end your current session?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/crebs86/acl-laravel/panel/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/crebs86/acl-laravel/panel/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/crebs86/acl-laravel/panel/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('vendor/crebs86/acl-laravel/panel/js/sb-admin.min.js')}}"></script>
</div>
</body>
</html>
