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
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
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
    <div class="" id="printableArea">
        <div class="pagetitle">
            <h1>Detail Event</h1>
        </div>
        <section class="card info-card sales-card">
            <div class="row g-0 card-body">
                <div class="col">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="fw-bold">{{ $item->event->eventname }}</h3>
                            <hr>
                            <table class="table table-borderless">
                                <tr>
                                    <td><i class="bi bi-calendar"></i></td>
                                    <td>Tanggal Dan Waktu Pelaksanaan</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($item->event->eventdate)->formatLocalized('%A, %d %B %Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-geo-alt"></i></td>
                                    <td>Tempat</td>
                                    <td>:</td>
                                    <td>{{ $item->event->eventlocation }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-flag"></i></td>
                                    <td>Penyelenggara</td>
                                    <td>:</td>
                                    <td>{{ $item->event->eventorganizer }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-list-nested"></i></td>
                                    <td>Tipe Event</td>
                                    <td>:</td>
                                    <td class="text-capitalize">
                                        @if ($item->event->eventtype == 'gratis' || $item->event->eventtype == 'Gratis')
                                            Gratis
                                        @elseif ($item->event->eventtype == 'berbayar' || $item->event->eventtype == 'Berbayar')
                                            Berbayar | @currency($item->event->eventprice)
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bookmark"></i></td>
                                    <td>Kategori Event</td>
                                    <td>:</td>
                                    <td class="text-capitalize">{{ $item->event->eventkategori }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bookmark"></i></td>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td class="text-capitalize">{{ $item->email }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bookmark"></i></td>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td class="text-capitalize">{{ $item->username }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bookmark"></i></td>
                                    <td>Nomer Tiket</td>
                                    <td>:</td>
                                    <td class="text-capitalize">{{ $item->nomertiket }}</td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
</body>

</html>
