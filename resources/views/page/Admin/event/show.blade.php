@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Detail Event</h1>
    </div>
    <section class="card info-card sales-card overflow-auto">
        <div class="row g-0 card-body">
            <div class="col-md-3 mt-4">
                <a class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img class="img-fluid w-full rounded" style="width:500px;height:500px;"
                        src="{{ asset('assets/images/eventimage/' . $event->image) }}" alt="..." />
                </a>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="m-auto">
                                    <img class="img-fluid w-full rounded" style="width:500px;height:600px;"
                                        src="{{ asset('assets/images/eventimage/' . $event->image) }}" alt="..." />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="fw-bold">{{ $event->nama }}
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
                                <td>Tanggal Pelaksanaan</td>
                                <td>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%A, %d %B %Y') }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-geo-alt"></i></td>
                                <td>Tempat</td>
                                <td>{{ $event->location }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-flag"></i></td>
                                <td>Penyelenggara</td>
                                <td>{{ $event->organizer }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-list-nested"></i></td>
                                <td>Tipe Event</td>
                                <td class="text-capitalize">
                                    @if ($event->type == 'gratis' || $event->type == 'Gratis')
                                        Gratis
                                    @elseif ($event->type == 'berbayar' || $event->type == 'Berbayar')
                                        Berbayar | @currency($event->price)
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-bookmark"></i></td>
                                <td>Kategori Event</td>
                                <td class="text-capitalize">{{ $event->kategori }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-badge-ad"></i></td>
                                <td>Sponsored By</td>
                                {{-- NULL SAFETY --}}
                                @if ($event->sponsor == null)
                                    <td class="text-capitalize">Tidak Ada Sponsor</td>
                                @else
                                    <td class="text-capitalize">{{ $event->sponsor->name }}</td>
                                @endif
                            </tr>
                        </table>
                        <hr>
                    </div>
                    <div class="accordion w-100" id="tentangEvent">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="tentangevent">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordionTentangEvent" aria-expanded="true"
                                    aria-controls="accordionTentangEvent">
                                    Tentang Event
                                </button>
                            </h2>
                            <div id="accordionTentangEvent" class="accordion-collapse collapse"
                                aria-labelledby="tentangevent" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $event->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mt-4">
                <p><a href="/riwayat/{{ $event->id }}" class="btn btn-success w-100">Mendaftar Event</a></p>
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
