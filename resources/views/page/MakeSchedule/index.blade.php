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
            <form class="d-flex justify-content-between gap-2" method="POST" action="{{ route('be.algo') }}" enctype="multipart/form-data">
                @csrf
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Generate Schedule</button>
                    <input type="text" name="limit_data" placeholder="Limit Data" class="form-control">
                </div>
                @if (session('generated_schedule'))
                    <a onclick="return confirm('Yakin ? Apakah Anda Yakin Ingin Menghapus Filter Ini ?')"
                        href="{{ url('/hapus-filter') }}" class="btn btn-danger">Hapus Filter</a>
                @endif
            </form>
            <span class="text-danger small py-2 fw-bold">*Semakin banyak data yang di ambil semakin lama proses generasi data</span>

            <hr>

            @if (session('generated_schedule'))
                <div class="overflow-auto tbl-wrap mt-4">
                    <table
                        class="table datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm d-block">
                        <thead>
                            <tr style="text-align:center">
                                <th class="text-center">No</th>
                                <th>Event Name</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Tanggal Mulai</th>
                                <th class="text-center">Tanggal Akhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomer = 1;
                            @endphp
                            @foreach (session('updated_schedule', []) as $event)
                                <tr>
                                    <td class="text-center">{{ $nomer++ }}.</td>
                                    <td>{{ $event['nama'] }}</td>
                                    <td class="text-center">{{ $event['hari'] }} Hari</td>
                                    <td class="text-center text-uppercase">{{ $event['level'] }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($event['start_date'])->locale('id')->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($event['end_date'])->locale('id')->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ url('/tambah/event/' . $event['id']) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="tanggal_mulai" value="{{ $event['start_date'] }}">
                                            <input type="hidden" name="tanggal_akhir" value="{{ $event['end_date'] }}">
                                            <button class="btn btn-success btn-sm">
                                                Update Data
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{-- @endif --}}
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
