<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title' , 'QRservice')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/homepage.css')}}">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">

    <!-- Estilos Datatables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <!-- Link css -->
    <link rel="stylesheet" href="{{ asset('css/elementos.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link profile" data-toggle="dropdown" href="#">
                        Perfil
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                @if(Auth::user()->photo)
                                <img src="{{ asset( Auth::user()->photo) }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                @else
                                    <img class="img-size-50 mr-3 img-circle"  src="{{ asset('img/photo/phtoto_default.jpeg') }}" alt="Default profile picture">
                                @endif
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}" class="dropdown-item dropdown-footer">Editar Perfil</a>
                        <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer">Cerrar Sesión</a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{asset('img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">QR service</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->photo)
                            <img src="{{ asset( Auth::user()->photo) }}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img class="img-circle elevation-2" src="{{ asset('img/photo/phtoto_default.jpeg') }}" alt="Default profile picture">
                        @endif

                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="{{route('dashboard')}}" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Pagina principal
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @can('user.index')
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            @endcan
                            <ul class="nav nav-treeview">
                                @can('user.index')
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar usuarios</p>
                                    </a>
                                </li>
                                @endcan
                                @can('user.create')
                                <li class="nav-item">
                                    <a href="{{ route('user.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear un usuario</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item">
                            @can('ficha.index')
                                <a href="{{ route('ficha.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-file-alt"></i>
                                    <p>
                                        Fichas
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            @endcan
                            <ul class="nav nav-treeview">
                                @can('ficha.index')
                                    <li class="nav-item">
                                        <a href="{{ route('ficha.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar fichas</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('ficha.create')
                                    <li class="nav-item">
                                        <a href="{{ route('ficha.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear una ficha</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>



                        <li class="nav-item">
                            @can('program.index') <!-- Verificar si el usuario tiene permiso para listar programas -->
                            <a href="#" class="nav-link">
                                <i class="fas fa-book nav-icon"></i>
                                <p>
                                    Programas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('programa.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Programas</p>
                                    </a>
                                </li>
                                @can('program.create')
                                <li class="nav-item">
                                    <a href="{{ route('programa.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear un Programa</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                            @endcan
                        </li>



                        <li class="nav-item">
                            @can('attendance.index') <!-- Verificar si el usuario tiene permiso para listar asistencias -->
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-check"></i>
                                <p>
                                    Asistencia
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('attendance.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar asistencias</p>
                                    </a>
                                </li>
                                @can('attendance.create') <!-- Verificar si el usuario tiene permiso para crear asistencias -->
                                <li class="nav-item">
                                    <a href="{{ route('attendance.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear una asistencia</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                            @endcan
                        </li>



                        <li class="nav-item">
                            @can('excuse.index') <!-- Verificar si el usuario tiene permiso para listar excusas -->
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Excusas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('excuse.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar excusas</p>
                                    </a>
                                </li>
                                @can('excuse.create') <!-- Verificar si el usuario tiene permiso para crear excusas -->
                                <li class="nav-item">
                                    <a href="{{ route('excuse.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear una excusa</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                            @endcan
                        </li>



                        <li class="nav-item">
                            @can('timeTable.index')
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-calendar"></i>
                                <p>
                                    Horarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('timeTable.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar horarios</p>
                                    </a>
                                </li>
                                @can('timeTable.create') <!-- Verificar si el usuario tiene permiso para crear horarios -->
                                <li class="nav-item">
                                    <a href="{{ route('timeTable.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear un horario</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                            @endcan
                        </li>

                        @can('permission.index')
                        <span class="segurity">Seguridad</span>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-lock"></i>
                                <p>
                                    Permisos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('permission.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar permisos</p>
                                    </a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    @can('permission.create')
                                    <a href="{{ route('permission.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear permisos</p>
                                    </a>
                                    @endcan
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            @can('role.index')
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-users"></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Roles</p>
                                    </a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    @can('role.create')
                                    <a href="{{ route('role.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Roles</p>
                                    </a>
                                    @endcan
                                </li>
                            </ul>
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

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')  }} "></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('dist/js/adminlte.min.js')  }} "></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<!-- Estilos Datatables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Dashboard js -->
<script src="{{ asset('js/dashboard.js') }}"></script>

    <!-- Dashboard js -->
    @yield('js')


</body>

</html>
