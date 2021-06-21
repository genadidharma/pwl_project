<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/toastify/toastify.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">

    <script src="{{asset('assets/vendors/toastify/toastify.js')}}"></script>
    <script src="{{asset('assets/js/extensions/toastify.js')}}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <div id="app">
        <!-- SIDEBAR -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{route('home')}}"><img src="{{asset('assets/images/logo/logo-text.png')}}" class="w-50 h-auto" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        @level('admin')
                        <li class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : ''}}">
                            <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub {{ request()->is('admin/pegawai/*') ? 'active' : ''}}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Pegawai</span>
                            </a>
                            <ul class="submenu {{ request()->is('admin/pegawai/*') ? 'active' : ''}}">
                                <li class="submenu-item {{ request()->routeIs('dokter.*') ? 'active' : ''}}">
                                    <a href="{{route('dokter.index')}}">Dokter</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('kasir.*') ? 'active' : ''}}">
                                    <a href="{{route('kasir.index')}}">Kasir</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub {{ request()->is('admin/barang-barang/*') ? 'active' : ''}}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>Barang</span>
                            </a>
                            <ul class="submenu {{ request()->is('admin/barang-barang/*') ? 'active' : ''}}">
                                <li class="submenu-item {{ request()->routeIs('kategori-barang.*') ? 'active' : ''}}">
                                    <a href="{{route('kategori-barang.index')}}">Kategori Barang</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('barang.*') ? 'active' : ''}}">
                                    <a href="{{route('barang.index')}}">Barang</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('stok.*') ? 'active' : ''}}">
                                    <a href="{{route('stok.index')}}">Stok</a>
                                </li>
                            </ul>
                        </li>
                        @endlevel

                        @level('admin')
                        <li class="sidebar-item {{ request()->routeIs('admin.pemeriksaan.*') ? 'active' : ''}}">
                            <a href="{{route('admin.pemeriksaan.index')}}" class='sidebar-link'>
                                <i class="bi bi-binoculars-fill"></i>
                                <span>Pemeriksaan</span>
                            </a>
                        </li>
                        @endlevel

                        @level('dokter')
                        <li class="sidebar-item {{ request()->routeIs('dokter.pemeriksaan.*') ? 'active' : ''}}">
                            <a href="{{route('dokter.pemeriksaan.index')}}" class='sidebar-link'>
                                <i class="bi bi-binoculars-fill"></i>
                                <span>Pemeriksaan</span>
                            </a>
                        </li>
                        @endlevel

                        @level('kasir')
                        <li class="sidebar-item has-sub {{ request()->is('kasir/transaksi/*') ? 'active' : ''}}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-bag-fill"></i>
                                <span>Transaksi</span>
                            </a>
                            <ul class="submenu {{ request()->is('kasir/transaksi/obat/*') ? 'active' : ''}} d-block">
                                <li class="submenu-item {{ request()->routeIs('transaksi.obat.*') ? 'active' : ''}}">
                                    <a href="{{route('transaksi.obat.index')}}">Transaksi Obat</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('transaksi.barang.*') ? 'active' : ''}}">
                                    <a href="{{route('transaksi.barang.index')}}">Transaksi Barang</a>
                                </li>
                            </ul>
                        </li>
                        @endlevel

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="navbar-nav ms-auto mb-2 mb-lg-0 dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{auth()->user()->nama}}</h6>
                                            <p class="mb-0 text-sm text-gray-600">
                                                @level('admin')
                                                Administrator
                                                @elselevel('dokter')
                                                Dokter
                                                @elselevel('kasir')
                                                Kasir
                                                @endlevel
                                            </p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{asset('assets/images/faces/1.jpg')}}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Halo, {{auth()->user()->nama}}!</h6>
                                    </li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

                @yield('content')

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Annisa, Genadi</p>
                        </div>
                        <div class="float-end">
                            <p>Mazer Template Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                                by <a href="https://ahmadsaugi.com">Saugi</a></p>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
    </div>
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>

    <script src="{{asset('assets/vendors/choices.js/choices.min.js')}}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

        let table2 = document.querySelector('#table2')
        let datataTable = new simpleDatatables.DataTable(table2, {
            searching: false
        })
    </script>

    <script src="{{asset('assets/js/extensions/counternumber.js')}}"></script>

    <script src="{{asset('assets/js/extensions/sweetalert2.js')}}"></script>
    <script src="{{asset('assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>

    @stack('scripts')

    <script>
        feather.replace()
    </script>

    <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>