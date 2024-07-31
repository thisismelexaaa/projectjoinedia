@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            <strong>Berhasil</strong>, {!! session('success') !!}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            <strong>Gagal</strong>, {!! session('error') !!}
        </div>
    @endif

    <section class="card info-card sales-card">
        <div class="pagetitle p-3">
            <div class="row justify-between card-title me-2">
                <p class="col-md">Membuat Jadwal</p>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('be.algo') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 m-auto">
                    <div class="my-3 row">
                        <div class="col-md-6">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select id="bulan" name="bulan" class="form-select">
                                <option value="">- Pilih -</option>
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ $month == session('filter_bulan') ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromDate(null, $month, 1)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select id="tahun" name="tahun" class="form-select">
                                <option value="">- Pilih -</option>
                                @foreach (range(date('Y'), date('Y') + 5) as $year)
                                    <option value="{{ $year }}" {{ $year == session('filter_tahun') ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Generate Schedule</button>
                        @if (session('filter_tahun') || session('filter_bulan'))
                            <a href="{{ url('/hapus-filter') }}" class="btn btn-danger">Hapus Filter</a>
                        @endif
                    </div>
                </div>
            </form>

            @if (!empty($scheduledEvents))
                <h5 class="mt-5">Scheduled Events</h5>
                <div class="card-title justify-content-between row me-2">
                    <div class="justify-content-end row gap-1 col-md">
                        <form method="POST" action="{{ route('be.checkConflicts') }}">
                            @csrf
                            <input type="hidden" name="bulan" value="{{ session('filter_bulan') }}">
                            <input type="hidden" name="tahun" value="{{ session('filter_tahun') }}">
                            <button type="submit" class="btn btn-warning">Check Conflicts</button>
                        </form>
                    </div>
                </div>
                <div class="overflow-auto tbl-wrap">
                    <table class="table datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm d-block">
                        <thead>
                            <tr style="text-align:center">
                                <th>No</th>
                                <th text='center'>Event Name</th>
                                <th>Start Day</th>
                                <th>End Day</th>
                                <th class="headcol">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scheduledEvents as $event)
                                <tr style="text-align:center">
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $event['event']->nama }}</td>
                                    <td>{{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $event['startDay'])->format('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $event['endDay'])->format('d F Y') }}</td>
                                    <td>
                                        <form action="{{ url('/tambah/event', $event['event']->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Update Data</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- @if (!empty($conflicts))
                <h5 class="mt-5">Conflicts</h5>
                <ul>
                    @foreach ($conflicts as $conflict)
                        <li>{{ $conflict['event1'] }} conflicts with {{ $conflict['event2'] }}</li>
                    @endforeach
                </ul>
            @endif --}}
        </div>
    </section>

    @if (!empty($conflicts))
    <section class="card info-card sales-card ">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between d-flex">
                <p>List Events yang Bentrok</p>
            </div>
            <table
                class="table datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm">
                <thead>
                    <tr style="text-align:center">
                        <th scope="col">NO</th>
                        <th scope="col">Nama Event 1</th>
                        <th scope="col">Nama Event 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conflicts as $conflict)
                        <tr style="text-align:center">
                            <td rowspan="2">{{ $loop->iteration }}.</td>
                            {{-- <td class="align-baseline">
                                {{ $conflict['event1'] }}
                                {{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $conflict['start1'])->format('d F Y') }} -
                                {{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $conflict['end1'])->format('d F Y') }}
                            </td>
                            <td class="align-baseline">
                                {{ $conflict['event2'] }}
                                {{ \Carbon\Carbon::parse($conflict['start2'])->format('d F Y') }} - {{ \Carbon\Carbon::parse($conflict['end2'])->format('d F Y') }}
                            </td> --}}
                            <td class="align-baseline">{{ $conflict['event1'] }}</td>
                            <td class="align-baseline">{{ $conflict['event2'] }}</td>
                        </tr>
                        <tr style="text-align:center">
                            <td>
                                {{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $conflict['start1'])->format('d F Y') }} -
                                {{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $conflict['end1'])->format('d F Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $conflict['start2'])->format('d F Y') }} -
                                {{ \Carbon\Carbon::createFromDate(session('filter_tahun'), session('filter_bulan'), $conflict['end2'])->format('d F Y') }}
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endif

@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
