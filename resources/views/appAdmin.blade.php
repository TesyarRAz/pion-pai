<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/sb-admin/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/perum.png') }}" rel="icon" type="image/png">

    {{-- data table --}}
    <link rel="stylesheet" href="{{ asset('vendor/DataTables-1.12.1/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Buttons-2.2.3/css/buttons.bootstrap4.min.css') }}">

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.6.2-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('vendor/DataTables-1.12.1/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables-1.12.1/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables-1.12.1/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('vendor/Buttons-2.2.3/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/Buttons-2.2.3/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/Buttons-2.2.3/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/Buttons-2.2.3/js/buttons.print.min.js') }}"></script>

    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript">
    $.fn.select2.defaults.set("theme", "bootstrap4");
    </script>

    <script type="text/javascript">
        $.extend($.fn.dataTable.defaults, {
            scrollX: true,
        });
    </script>
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.member') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pion <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Pengelolaan') }}
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is(['admin/member/*', 'admin/member']) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.member') }}">
                    <i class="fas fa-user"></i>
                    <span>{{ __('Kelola User') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is(['admin/informasi/*', 'admin/informasi']) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.informasi.index') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>{{ __('Kelola Informasi Guru') }}</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is(['admin/mapel/*', 'admin/mapel']) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.mapel.index') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>{{ __('Kelola Mapel') }}</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is(['admin/gurumapel/*', 'admin/gurumapel']) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.gurumapel.index') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>{{ __('Kelola Guru Mapel') }}</span>
                </a>
            </li>

            <!-- Nav Item - Profile -->
            <li class="nav-item {{ request()->is(['admin/absensi/*', 'admin/absensi']) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.absensi') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>{{ __('Kelola Absensi') }}</span>
                </a>
            </li>

            
            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Pengaturan') }}
            </div>

            <li class="nav-item {{ request()->is(['admin/setting/*', 'admin/setting']) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.setting.index') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>{{ __('Aplikasi') }}</span>
                </a>
            </li>

            <!-- Nav Item - About -->
            {{-- <li class="nav-item ">
                <a class="nav-link" href="">
                    <i class="fas fa-dollar-sign"></i>
                    <span>{{ __('Riwayat Absensi') }}</span>
                </a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="">
                                </figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MBCorp {{ now()->year }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href=""
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="get" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/sb-admin/sb-admin-2.min.js') }}"></script>
</body>

</html>
