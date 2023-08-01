@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<<<<<<< HEAD
=======
    <div class="pagetitle">
        <h1>List Pendaftar</h1>
    </div>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
>>>>>>> 8019b8b (70% Progress)
    <section class="card info-card sales-card ">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between d-flex">
                <p>List Pendaftar</p>
            </div>
            @foreach ($data as $item)
                {{-- @dd($item->pendaftaran) --}}
                <div class="accordion" id="tentangEvent">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="tentangevent">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="{{ '#accordionTentangEvent' . $item->id }}" aria-expanded="true"
                                aria-controls="accordionTentangEvent">
<<<<<<< HEAD
<<<<<<< HEAD
                                {{ $item->nama }}
=======
                                {{ $item->eventname }}
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                {{ $item->nama }}
>>>>>>> 8019b8b (70% Progress)
                            </button>
                        </h2>
                        <div id="{{ 'accordionTentangEvent' . $item->id }}" class="accordion-collapse collapse"
                            aria-labelledby="tentangevent" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="overflow-auto">
                                    <table
                                        class="table table-borderless datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm d-block">
                                        <thead>
                                            <tr>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8019b8b (70% Progress)
                                                <th>#</th>
                                                {{-- <th>Nama Event</th> --}}
                                                <th>Nama Peserta</th>
                                                <th>Mendaftar Sebagai</th>
                                                <th>Nomor Tiket</th>
                                                <th>Status</th>
<<<<<<< HEAD
=======
                                                <th scope="col">#</th>
                                                {{-- <th scope="col">Nama Event</th> --}}
                                                <th scope="col">Nama Peserta</th>
                                                <th scope="col">Mendaftar Sebagai</th>
                                                <th scope="col">Nomor Tiket</th>
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
>>>>>>> 8019b8b (70% Progress)
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($daftar as $items)
                                                @if ($items->event_id != $item->id)
                                                    @continue
                                                @endif
                                                <tr>
                                                    <th class="align-baseline" scope="row">{{ ++$i }}</th>
                                                    <td class="align-baseline">{{ $items->nama }}</td>
                                                    <td class="align-baseline text-capitalize">{{ $items->type }}</td>
                                                    <td class="align-baseline">{{ $items->nomertiket }}</td>
<<<<<<< HEAD
<<<<<<< HEAD
                                                    <td class="align-baseline">{{ $items->status }}</td>
=======
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                                    <td class="align-baseline">{{ $items->status }}</td>
>>>>>>> 8019b8b (70% Progress)
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
