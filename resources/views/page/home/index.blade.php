@extends('layouts.app')

@section('content')
<<<<<<< HEAD
=======
    <div class="pagetitle">
        <h1>Home</h1>
    </div>
>>>>>>> f89a811 (First Commit : Progress 80%)
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8019b8b (70% Progress)
                <h5 class="card-title">List Event</h5>
                <div class="row row-cols-md-5">
                    {{-- <div class="col"> --}}
                    @foreach ($event as $itemevent)
                        <div class="news p-1 my-1">
                            <div class="post-item clearfix border rounded hover-overlay p-2">
<<<<<<< HEAD
                                <img src="{{ asset('assets/images/eventimage/' . $itemevent->image) }}" alt="">
                                <h4><a href="event/{{ $itemevent->id }}" class="">
                                        {{ Str::limit($itemevent->nama, 20) }}
                                    </a></h4>
=======
                                <img src="{{ asset('assets/images/eventimage/'. $itemevent->image) }}" alt="">
                                <h4><a href="event/{{ $itemevent->id }}">{{ $itemevent->nama }}</a></h4>
>>>>>>> 8019b8b (70% Progress)
                                <p class="text-truncate">{{ $itemevent->organizer }}</p>
                                <p><a href="event/{{ $itemevent->id }}">Selengkapnya</a></p>
                            </div>
                        </div><!-- End sidebar recent posts-->
                    @endforeach
                    {{-- </div> --}}
                </div>
<<<<<<< HEAD
=======
                <p>Tampilan user</p>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
>>>>>>> 8019b8b (70% Progress)
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
                                            <div class="col bg-primary rounded-5">
                                                <span class="small pt-1 fw-bold  text-white">{{ $eventBerjalan }}</span>
                                                <span class="small pt-2 ps-1 text-white">Event Berjalan</span>
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
<<<<<<< HEAD
                    <div class="card overflow-hidden" style="height:460px">
                        <div class="card-body pb-1">
                            <div class="row gap-4">
                                <div class="col overflow-auto pb-5" style="height:550px">
                                    <h5 class="card-title sticky-top w-full bg-white my-0">List Event</h5>
                                    <div class="row row-cols-2">
                                        @foreach ($event as $itemevent)
                                            <div class="news my-1 py-2">
                                                <div class="post-item clearfix border rounded hover-overlay p-2">
                                                    <img src="{{ asset('assets/images/eventimage/' . $itemevent->image) }}"
                                                        alt="">
                                                    <h4><a
                                                            href="event/{{ $itemevent->id }}">{{ Str::limit($itemevent->nama, 20) }}</a>
                                                    </h4>
                                                    <p class="text-truncate">{{ $itemevent->organizer }}</p>
                                                    <p><a href="event/{{ $itemevent->id }}">Selengkapnya</a></p>
                                                </div>
                                            </div><!-- End sidebar recent posts-->
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col overflow-auto" style="height:450px">
                                    <h5 class="card-title sticky-top w-full bg-white my-0">Daftar Peserta</h5>
                                    @foreach ($event as $index => $itemevent)
                                        <div class="accordion accordion-flush" id="accordion-{{ $index }}">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $index }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-{{ $index }}">
                                                        <b>{{ $itemevent->nama }}</b>
                                                    </button>
                                                </h2>
                                                <div id="collapse-{{ $index }}"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-{{ $index }}">
                                                    <div class="accordion-body">
                                                        @php
                                                            $pesertaFound = false;
                                                        @endphp

                                                        @foreach ($eventPendaftar as $data)
                                                            @if ($data->event_id == $itemevent->id)
                                                                <ol>
                                                                    <li>
                                                                        <a class="text-dark"
                                                                            href="user/{{ $data->user_id }}">{{ $data->nama }}</a>
                                                                    </li>
                                                                </ol>
                                                                @php
                                                                    $pesertaFound = true;
                                                                @endphp
                                                            @break
                                                        @endif
                                                    @endforeach

                                                    @if (!$pesertaFound)
                                                        <p class="text-danger">Tidak ada peserta</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
=======
                    <div class="card">
                        <div class="card-body pb-1">
                            <h5 class="card-title">List Event</h5>
                            <div class="row row-cols-md-5">
                                {{-- <div class="col"> --}}
                                @foreach ($event as $itemevent)
                                    <div class="news p-1 my-1">
                                        <div class="post-item clearfix border rounded hover-overlay p-2">
                                            <img src="{{ asset('assets/images/eventimage/'. $itemevent->image) }}" alt="">
                                            <h4><a href="event/{{ $itemevent->id }}">{{ $itemevent->nama }}</a></h4>
                                            <p class="text-truncate">{{ $itemevent->organizer }}</p>
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
>>>>>>> f89a811 (First Commit : Progress 80%)
@endsection
