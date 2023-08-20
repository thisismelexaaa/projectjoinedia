@extends('layouts.app')

@section('content')
    <section class="card info-card sales-card overflow-auto">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between row me-2">
                <p class="col-md">List Sponsors</p>
                <a href="{{ route('sponsor.laporansponsor') }}" class="btn btn-sm btn-primary my-auto col-md-2">Cetak Laporan</a>
            </div>
            <div class="overflow-auto">
                <table
                    class="table table-borderless datatable datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm d-block">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Sponsor</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Description</th>
                            <th scope="col">Kontrak Sponsor</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sponsors as $sponsor)
                            <tr>
                                <th class="align-baseline" scope="row">{{ ++$i }}</th>
                                <td class="align-baseline">
                                    <img src="assets/images/sponsorlogo/{{ $sponsor->logo }}" height="125" alt="">
                                    <span class="fw-bold">
                                        {!! $sponsor->name !!}
                                    </span>
                                </td>
                                <td class="align-baseline">{!! $sponsor->event->nama !!}</td>
                                <td class="align-baseline">{!! $sponsor->description !!}</td>
                                <td class="align-baseline">
                                    {{ \Carbon\Carbon::parse($sponsor->start_date)->formatLocalized('%d %B %Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($sponsor->end_date)->formatLocalized('%d %B %Y') }}
                                </td>
                                <td class="align-baseline">
                                    <div class="gap-3 d-flex">
                                        {{-- <a href="{{ route('sponsor.show', $sponsor->id) }}" class="btn btn-sm btn-primary"
                                            data-bs-toggle="tooltip" data-bs-title="Show">
                                            <i class="bi bi-eye"></i>
                                        </a> --}}
                                        {{-- <a href="{{ route('sponsor.edit', $sponsor->id, '/edit') }}"
                                            class="btn btn-sm btn-warning"data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a> --}}
                                        <form action="{{ route('sponsor.destroy', $sponsor->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="Javascript: return confirm('Apakah anda ingin menghapus data ini?')"
                                                data-bs-toggle="tooltip" data-bs-title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
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
