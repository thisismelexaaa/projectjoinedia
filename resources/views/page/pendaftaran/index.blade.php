@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Detail</h1>
    </div>
    <section class="card info-card sales-card ">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between d-flex">
                <p>Detail</p>
            </div>
            <div class="overflow-auto">
                <table
                    class="table table-borderless datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm d-block">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Poster</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Nama Peserta</th>
                            <th scope="col">Mendaftar Sebagai</th>
                            <th scope="col">Nomor Tiket</th>
                            <th scope="col">Status</th>
                            <th scope="col">Harga</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th class="align-baseline" scope="row">{{ ++$i }}</th>
                                <td class="align-baseline">
                                    <a href="{{ url('detail/' . $item->id) }}" class="fw-bold text-dark">
                                        <img src="storage/eventimage/{{ $item->event->eventimage }}" height="125"
                                            alt="">
                                    </a>
                                </td>
                                <td class="align-baseline">
                                    <a href="{{ url('detail/' . $item->id) }}" class="fw-bold text-dark">
                                        {{ $item->event->eventname }}
                                    </a>
                                </td>
                                <td class="align-baseline text-capitalize">{{ $item->nama }}</td>
                                <td class="align-baseline text-capitalize">{{ $item->type }}</td>
                                <td class="align-baseline text-capitalize">{{ $item->nomertiket }}</td>
                                <td class="align-baseline text-capitalize">{{ $item->status }}</td>
                                <td class="align-baseline text-capitalize">@currency($item->price)</td>
                                {{-- <td class="align-baseline">
                                <div class="d-flex gap-3">
                                    <a href="{{ URL::to('exportpdf') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                        data-bs-title="Print to PDF">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </div>
                            </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
