@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Home</h1>
    </div>
    <section class="py-3 card info-card sales-card">
        <div class="card-body">
            <div class="text-center mb-4">
                <div class="text-capitalize mb-3 h2">
                    <span class="align-baseline">Wellcome</span>
                    @if (Auth::user()->role == 'admin')
                        <span class="align-baseline fw-bold rounded">
                            <i class="typed"></i>
                        </span>
                    @elseif(Auth::user()->role == 'superadmin')
                        <span class="align-baseline fw-bold rounded">
                            <i class="typed"></i>
                        </span>
                    @else
                        <span class="align-baseline fw-bold rounded">
                            <i class="typed"></i>
                        </span>
                    @endif
                </div>
                @if (Auth::user()->role == 'admin')
                    <div class="row">
                        <span class="text-capitalize text-black badge rounded col-md text-wrap">
                            {!! $quote !!}
                        </span>
                    </div>
                @elseif(Auth::user()->role == 'superadmin')
                    <div class="row">
                        <span class="text-capitalize text-black badge rounded col-md text-wrap">
                            {!! $quote !!}
                        </span>
                    </div>
                @else
                    <div class="row">
                        <span class="text-capitalize text-black badge rounded col-md text-wrap">
                            {!! $quote !!}
                        </span>
                    </div>
                @endif
                {{-- show quotes --}}
            </div>
            @if (Auth::user()->role == 'user')
                {{-- Tampilan User --}}
                <p>Tampilan user</p>
            @else
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Quick Action</h6>
                        </li>

                        <li><a class="dropdown-item" href="{{ route('user.create') }}">Add User</a></li>
                        <li><a class="dropdown-item" href="{{ route('event.create') }}">Add Event</a></li>
                        <li><a class="dropdown-item" href="/">Go to Landing Page</a></li>
                    </ul>
                </div>
                {{-- Tampilan Admin & SuperAdmin --}}
                <section class="row">
                    {{-- card total event --}}
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Event</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div class="ps-3 row">
                                        <h6>{{ $eventCount }} Event</h6>
                                        <div class="row row-cols-auto gap-1">
                                            <div class="col bg-success rounded-5">
                                                <span class="small pt-1 fw-bold  text-white">{{ $eventAktif }}</span>
                                                <span class="small pt-2 ps-1 text-white">Event Aktif</span>
                                            </div>
                                            <div class="col bg-danger rounded-5">
                                                <span class="small pt-1 fw-bold  text-white">{{ $eventSelesai }}</span>
                                                <span class="small pt-2 ps-1 text-white">Event Selesai</span>
                                            </div>
                                        </div>
                                        <a href="/event" class="my-2">Lihat Detail Event</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Card total user --}}
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengguna</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3 row">
                                        @if (Auth::user()->role == 'superadmin')
                                            <h6>{{ $userCount }} Pengguna</h6>
                                        @else
                                            <h6>{{ $usersCount }} Pengguna</h6>
                                        @endif
                                        <div class="row row-cols-auto gap-1">
                                            {{-- Cek role user --}}

                                            @if (Auth::user()->role == 'admin')
                                                <div class="col bg-primary rounded-5" hidden>
                                                    <span
                                                        class="small pt-1 fw-bold  text-white">{{ $userAdminCount }}</span>
                                                    <span class="small pt-2 ps-1 text-white">Admin</span>
                                                </div>
                                            @else
                                                <div class="col bg-primary rounded-5">
                                                    <span
                                                        class="small pt-1 fw-bold  text-white">{{ $userAdminCount }}</span>
                                                    <span class="small pt-2 ps-1 text-white">Admin</span>
                                                </div>
                                                <div class="col bg-danger rounded-5">
                                                    <span
                                                        class="small pt-1 fw-bold  text-white">{{ $userSuperAdminCount }}</span>
                                                    <span class="small pt-2 ps-1 text-white">Super Admin</span>
                                                </div>
                                            @endif

                                            <div class="col bg-secondary rounded-5">
                                                <span class="small pt-1 fw-bold  text-white">{{ $usersCount }}</span>
                                                <span class="small pt-2 ps-1 text-white">Pengguna</span>
                                            </div>
                                        </div>
                                        <a href="/user" class="my-2">Lihat Detail Pengguna</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="card">
                        <div class="card-body pb-1">
                            <h5 class="card-title">List Event</h5>
                            <div class="row row-cols-md-5">
                                {{-- <div class="col"> --}}
                                @foreach ($event as $itemevent)
                                    <div class="news p-1 my-1">
                                        <div class="post-item clearfix border rounded hover-overlay p-2">
                                            <img src="storage/eventimage/{{ $itemevent->eventimage }}" alt="">
                                            <h4><a href="event/{{ $itemevent->id }}">{{ $itemevent->eventname }}</a></h4>
                                            <p class="text-truncate">{{ $itemevent->eventorganizer }}</p>
                                            <p><a href="event/{{ $itemevent->id }}">Selengkapnya</a></p>
                                        </div>
                                    </div><!-- End sidebar recent posts-->
                                @endforeach
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script>
        var typed = new Typed('.typed', {
            strings: ['to Joinedia', '{{ $user->name }}'],
            typeSpeed: 50,
            backSpeed: 50,
            loop: false
        });
    </script>
@endsection
