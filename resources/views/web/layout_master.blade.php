@php
    $routeName = \Illuminate\Support\Facades\Route::currentRouteName()
@endphp
    <!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(mix('frontend/assets/css/fontawesome/css/all.min.css'))}}">
    <link rel="stylesheet" href="{{ asset(mix('frontend/assets/css/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('frontend/assets/css/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('frontend/assets/css/adminlte.min.css'))}}">
    <link rel="stylesheet" href="{{asset(mix('frontend/assets/css/style-custom.css'))}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @notifyCss
    <title>Dashboard | Sistema de ponto</title>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                        class="fas fa-cog"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
        @include('notify::messages')
        <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @php
                       if(Auth::user()->cover):
                      $cover = Storage::url(Auth::user()->cover);
                      else:
                      $cover = asset('frontend/assets/img/avatar.png');
                  endif
                    @endphp
                    <img src="{{$cover}}" style="max-width: 40px; max-height: 40px" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('app.home')}}"
                       class="d-block">{{Str::upper(Auth::user()->name)}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('app.home')}}" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            <p>
                                Registrar Ponto
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('app.month-report')}}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Relatório Mensal
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('app.general-report')}}" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Relatório Gerencial
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('app.users.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuários
                            </p>
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- /.sidebar-menu -->

        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                @if($routeName == 'app.home')
                    <div class="row justify-content-around">
                        <div class="col-lg-3 col-6 mt-3">
                            <!-- small card -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 {{$activeClock === 'workedHours' ? 'active-clock' : ''}}>{{$workedHours}}</h3>

                                    <p>Horas Trabalhadas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 mt-3">
                            <!-- small card -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 {{$activeClock === 'exitTime' ? 'active-clock' : ''}}>{!! $exitTime  !!}</h3>

                                    <p>Hora de Saida</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @yield('breadcrumb')
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                @yield('content')

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5 class="text-center">Perfil</h5>
            <p class="mt-2"><strong>Nome:</strong> <small>{{Auth::user()->name}}</small></p>
            <p class="mt-2"><strong>Email:</strong> <small>{{Auth::user()->email}}</small></p>
            <p class="mt-2"><strong>Acesso:</strong> <small class="badge {{Auth::user()->is_admin == true ? 'badge-success' : 'badge-danger'}}">Admin</small></p>

        </div>
        <div class="p-3 ">
            <a href="{{route('app.logout')}}" class="btn btn-danger col-12"><i class="fa fa-sign-out-alt"></i> SAIR</a>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Edson Lima
        </div>
        <!-- Default to the left -->
        Copyright &copy; {{date('Y')}} Todos os direitos reservados.
    </footer>
</div>
<!-- ./wrapper -->

<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/adminlte.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $("#data-table").dataTable({
            responsive: true,
            "pageLength": 25,
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "r",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
        });
    })
</script>
@notifyJs
@hasSection('js')
    @yield('js')
@endif
</body>
</html>
