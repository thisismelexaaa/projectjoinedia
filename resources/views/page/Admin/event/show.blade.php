@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Detail Event</h1>
    </div>
    <section class="card info-card sales-card overflow-auto">
        <div class="row g-0 card-body">
            <div class="col-md-3 mt-4">
                <a class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
<<<<<<< HEAD
                    <img class="img-fluid w-full rounded" src="{{ asset('assets/images/eventimage/' . $event->image) }}"
                        alt="..." />
=======
                    <img class="img-fluid w-full rounded" style="width:500px;height:500px;"
<<<<<<< HEAD
                        src="/storage/eventimage/{{ $event->eventimage }}" alt="..." />
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                        src="{{ asset('assets/images/eventimage/' . $event->image) }}" alt="..." />
>>>>>>> 8019b8b (70% Progress)
                </a>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
<<<<<<< HEAD
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="m-auto">
                                    <img class="img-fluid w-full rounded" style="scale: 1.4"
                                        src="{{ asset('assets/images/eventimage/' . $event->image) }}" alt="..." />
=======
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="m-auto">
                                    <img class="img-fluid w-full rounded" style="width:500px;height:600px;"
<<<<<<< HEAD
                                        src="/storage/eventimage/{{ $event->eventimage }}" alt="..." />
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                        src="{{ asset('assets/images/eventimage/' . $event->image) }}" alt="..." />
>>>>>>> 8019b8b (70% Progress)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD

            <div class="col-md-7">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="fw-bold">{{ $event->nama }}
=======
            <div class="col-md-7">
                <div class="card-body">
                    <div class="card-title">
<<<<<<< HEAD
                        <h3 class="fw-bold">{{ $event->eventname }}
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                        <h3 class="fw-bold">{{ $event->nama }}
>>>>>>> 8019b8b (70% Progress)
                            <span>
                                <p class="card-text">
                                    <small class="text-body-secondary">Artikel Dibuat Oleh
                                        <b class="text-capitalize">{{ $event->user->name }}</b>
                                        Pada Hari
                                        <b>{{ \Carbon\Carbon::parse($event->created_at)->formatLocalized('%A, %d %B %Y') }}</b>
                                    </small>
                                </p>
                            </span>
                        </h3>
                        <hr>
                        <table class="table table-borderless">
                            <tr>
                                <td><i class="bi bi-calendar"></i></td>
<<<<<<< HEAD
<<<<<<< HEAD
                                <td>Tanggal Pelaksanaan</td>
                                <td>
                                    @if ($event->start_date != null)
                                        {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%A, %d %B %Y') }}
                                    @else
                                        Tidak Ada Jadwal
                                    @endif
                                </td>
=======
                                <td>Tanggal Dan Waktu Pelaksanaan</td>
                                <td>{{ \Carbon\Carbon::parse($event->eventdate)->formatLocalized('%A, %d %B %Y') }}</td>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                <td>Tanggal Pelaksanaan</td>
                                <td>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%A, %d %B %Y') }}</td>
>>>>>>> 8019b8b (70% Progress)
                            </tr>
                            <tr>
                                <td><i class="bi bi-geo-alt"></i></td>
                                <td>Tempat</td>
<<<<<<< HEAD
<<<<<<< HEAD
                                <td>{{ $event->location }}</td>
=======
                                <td>{{ $event->eventlocation }}</td>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                <td>{{ $event->location }}</td>
>>>>>>> 8019b8b (70% Progress)
                            </tr>
                            <tr>
                                <td><i class="bi bi-flag"></i></td>
                                <td>Penyelenggara</td>
<<<<<<< HEAD
<<<<<<< HEAD
                                <td>{{ $event->organizer }}</td>
=======
                                <td>{{ $event->eventorganizer }}</td>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                <td>{{ $event->organizer }}</td>
>>>>>>> 8019b8b (70% Progress)
                            </tr>
                            <tr>
                                <td><i class="bi bi-list-nested"></i></td>
                                <td>Tipe Event</td>
                                <td class="text-capitalize">
<<<<<<< HEAD
<<<<<<< HEAD
                                    @if ($event->type == 'gratis' || $event->type == 'Gratis')
                                        Gratis
                                    @elseif ($event->type == 'berbayar' || $event->type == 'Berbayar')
                                        Berbayar | @currency($event->price)
=======
                                    @if ($event->eventtype == 'gratis' || $event->eventtype == 'Gratis')
                                        Gratis
                                    @elseif ($event->eventtype == 'berbayar' || $event->eventtype == 'Berbayar')
                                        Berbayar | @currency($event->eventprice)
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                    @if ($event->type == 'gratis' || $event->type == 'Gratis')
                                        Gratis
                                    @elseif ($event->type == 'berbayar' || $event->type == 'Berbayar')
                                        Berbayar | @currency($event->price)
>>>>>>> 8019b8b (70% Progress)
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-bookmark"></i></td>
                                <td>Kategori Event</td>
<<<<<<< HEAD
<<<<<<< HEAD
                                <td class="text-capitalize">{{ $event->kategori }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-bookmark"></i></td>
                                <td>Kuota</td>
                                @if ($event->kuota == 0)
                                    <td class="text-capitalize">Kuota Habis</td>
                                @else
                                    <td class="text-capitalize">{{ $event->kuota }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><i class="bi bi-badge-ad"></i></td>
                                <td>Sponsored By</td>
                                {{-- NULL SAFETY --}}
                                @if ($sponsor == null)
                                    <td class="text-capitalize">Tidak Ada Sponsor</td>
                                @else
                                    <td class="align-baseline text-capitalize">
                                        @foreach ($sponsor as $sponsor)
                                            {{ $sponsor->name }},
                                        @endforeach
                                    </td>
                                @endif
=======
                                <td class="text-capitalize">{{ $event->eventkategori }}</td>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                <td class="text-capitalize">{{ $event->kategori }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-bookmark"></i></td>
                                <td>Kuota</td>
                                @if ($event->kuota == 0)
                                    <td class="text-capitalize">Kuota Habis</td>
                                @else
                                    <td class="text-capitalize">{{ $event->kuota }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><i class="bi bi-badge-ad"></i></td>
                                <td>Sponsored By</td>
                                {{-- NULL SAFETY --}}
                                @if ($event->sponsor == null)
                                    <td class="text-capitalize">Tidak Ada Sponsor</td>
                                @else
                                    <td class="align-baseline text-capitalize">
                                        @foreach ($event->sponsor as $sponsor)
                                            {{ $sponsor->name }},
                                        @endforeach
                                    </td>
                                @endif
>>>>>>> 8019b8b (70% Progress)
                            </tr>
                        </table>
                        <hr>
                    </div>
                    <div class="accordion w-100" id="tentangEvent">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="tentangevent">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
<<<<<<< HEAD
<<<<<<< HEAD
                                    data-bs-target="#accordionTentangEvent" aria-expanded="true"
                                    aria-controls="accordionTentangEvent">
                                    Tentang Event
                                </button>
                            </h2>
                            <div id="accordionTentangEvent" class="accordion-collapse collapse"
                                aria-labelledby="tentangevent" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $event->description !!}
=======
                                    data-bs-target="#accordionTentangEvent" aria-expanded="true" aria-controls="accordionTentangEvent">
=======
                                    data-bs-target="#accordionTentangEvent" aria-expanded="true"
                                    aria-controls="accordionTentangEvent">
>>>>>>> 8019b8b (70% Progress)
                                    Tentang Event
                                </button>
                            </h2>
                            <div id="accordionTentangEvent" class="accordion-collapse collapse"
                                aria-labelledby="tentangevent" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
<<<<<<< HEAD
                                        {!! $event->eventdescription !!}
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                    {!! $event->description !!}
>>>>>>> 8019b8b (70% Progress)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mt-4">
<<<<<<< HEAD
<<<<<<< HEAD
                <p><a href="/riwayat/{{ $event->id }}" class="btn btn-success w-100">Mendaftar Event</a></p>
=======
                <p><a href="/pendaftaran/{{ $event->id }}" class="btn btn-success w-100">Mendaftar Event</a></p>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                <p><a href="/riwayat/{{ $event->id }}" class="btn btn-success w-100">Mendaftar Event</a></p>
>>>>>>> 8019b8b (70% Progress)
                <p><a href="/event" class="btn btn-primary w-100">Kembali Ke Daftar event</a></p>
                <div class="list-group">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Event Lainnya
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="list-group">
                                        @if ($eventexcept->count() == 0)
                                            <div class="mx-auto">
                                                <h5 class="mb-1 fw-bold text-center">Tidak Ada Event Lainnya</h5>
                                            </div>
                                        @else
                                            @foreach ($eventexcept as $item)
<<<<<<< HEAD
<<<<<<< HEAD
                                                <a href="{{ $item->id }}"
                                                    class="list-group-item list-group-item-action" aria-current="true">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1 fw-bold">{{ $item->nama }}</h5>
                                                    </div>
                                                    <p class="mb-1">{!! Str::limit($item->description, 25) !!}</p>
                                                    <div class="d-flex justify-content-between w-100">
                                                        <small class="text-capitalize">{{ $item->type }}</small>
                                                        <small
                                                            class="text-capitalize badge {{ $item->kategori == 'akademik' ? 'bg-primary' : 'bg-success' }}">{{ $item->kategori }}</small>
=======
                                                <a href="{{ $item->id }}" class="list-group-item list-group-item-action"
                                                    aria-current="true">
=======
                                                <a href="{{ $item->id }}"
                                                    class="list-group-item list-group-item-action" aria-current="true">
>>>>>>> 8019b8b (70% Progress)
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1 fw-bold">{{ $item->nama }}</h5>
                                                    </div>
                                                    <p class="mb-1">{!! Str::limit($item->description, 25) !!}</p>
                                                    <div class="d-flex justify-content-between w-100">
                                                        <small class="text-capitalize">{{ $item->type }}</small>
                                                        <small
<<<<<<< HEAD
                                                            class="text-capitalize badge {{ $item->eventkategori == 'akademik' ? 'bg-primary' : 'bg-success' }}">{{ $item->eventkategori }}</small>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                                            class="text-capitalize badge {{ $item->kategori == 'akademik' ? 'bg-primary' : 'bg-success' }}">{{ $item->kategori }}</small>
>>>>>>> 8019b8b (70% Progress)
                                                    </div>
                                                </a>
                                                <br>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
