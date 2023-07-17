<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Joinedia') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="favicon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com'" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style type="text/css" media="print">
        @page {
            size: landscape;
        }
    </style>
</head>

<body @if (Auth::user() == true) class="" @else class="toggle-sidebar" @endif>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('home') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">{{ config('app.name', 'Joinedia') }}</span>
            </a>

            {{-- <i class="bi bi-list toggle-sidebar-btn"></i> --}}
            @if (Auth::user() == true)
                <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"
                        aria-expanded="{{ session('message') == true ? 'true' : '' }}">
                        <i class="bi bi-bell"></i>
                        @if (session('message') == true)
                            <span class="badge bg-primary badge-number">1</span>
                        @else
                            <span class="badge bg-primary badge-number">0</span>
                        @endif
                    </a><!-- End Notification Icon -->


                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications {{ session('message') == true ? 'show bg-success' : '' }}"
                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-25px, 35px);"
                        data-popper-placement="bottom-end">
                        @if (session('message') == true)
                            <li class="dropdown-header bg-success text-white">
                                {{ session('message') }}
                            </li>
                        @else
                            <li class="dropdown-header">
                                You have 0 new notifications
                            </li>
                        @endif
                    </ul><!-- End Notification Dropdown Items -->
                </li>
                <!-- End Notification Nav -->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        @if (Auth::user()->userimage == null)
                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="Profile"
                                class="rounded-circle">
                        @else
                            <img src="{{ asset('storage/userimage/' . Auth::user()->userimage) }}" alt="Profile"
                                class="rounded-circle">
                        @endif
                        <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                    </a><!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6 class="text-capitalize">{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('user/'. Auth::user()->id ) }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <div class="dropdown-item d-flex align-items-center">
                                <a class="text-dark w-100" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    {{ __('Logout') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </a>

                            </div>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            @else
                @endif
            </ul>
        </nav>
        <!-- End Icons Navigation -->
        @if (Auth::user() == true)
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    {{-- Sidebar Admin --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'nav-link' : 'collapsed' }}"
                            href="{{ url('/home') }}">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    @can('isSuperAdmin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('event') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('/event') }}">
                                <i class="bi bi-calendar-event"></i>
                                <span>Event</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('user') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('/user') }}">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('pendaftaran') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('pendaftaran') }}">
                                <i class="bi bi-grid"></i>
                                <span>Aktivitas</span>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            {{-- <a class="nav-link {{ Request::is('listpendaftar') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('listpendaftar') }}">
                                <i class="bi bi-grid"></i>
                                <span>List Pendaftar</span>
                            </a>
                        </li> --}}
                    @elsecan('isAdmin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('event') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('/event') }}">
                                <i class="bi bi-calendar-event"></i>
                                <span>Event</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('user') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('/user') }}">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('pendaftaran') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('pendaftaran') }}">
                                <i class="bi bi-grid"></i>
                                <span>Aktivitas</span>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('listpendaftar') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('listpendaftar') }}">
                                <i class="bi bi-grid"></i>
                                <span>List Pendaftar</span>
                            </a>
                        </li> --}}
                        {{-- Sidebar User --}}
                    @elsecan('isUser')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('event') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('/event') }}">
                                <i class="bi bi-grid"></i>
                                <span>Lists Event</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pendaftaran') ? 'nav-link' : 'collapsed' }}"
                                href="{{ url('pendaftaran') }}">
                                <i class="bi bi-grid"></i>
                                <span>Aktivitas</span>
                            </a>
                        </li>
                    @endcan
                    <!-- End Dashboard Nav -->
                    <li>
                        <div class="footer">
                            <div class="copyright">
                                &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
                            </div>
                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </aside>
        @endif

        <!-- End Sidebar-->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <main id="main" class="main section dashboard">
        {{ session('message') }}
        @yield('content')
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('scripts')
    <!-- Template Main JS File -->

    {{-- MIDTRANS --}}
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</body>

</html>
