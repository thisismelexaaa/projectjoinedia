@extends('layouts.app')

@section('content')
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
                    <div class="col-6">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" class="form-control" id="bulan">
                            <option value="" disabled selected>Pilih Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select name="tahun" class="form-control" id="tahun">
                            <option value="" disabled selected>Pilih Tahun</option>
                            @for($i = date('Y') - 5; $i <= date('Y') + 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" id="buttonSubmit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="card info-card sales-card">
    <div class="pagetitle p-3">
        <div class="row justify-between card-title me-2">
            <p class="col-md">Hasil Penjadwalan</p>
            @if (Auth::user()->role == 'superadmin')
            <form method="POST" action="{{ route('make_schedule.duplicate') }}" class="my-auto col-md-2">
                @csrf
                <input type="hidden" name="bulan" value="{{ request()->bulan }}">
                <input type="hidden" name="tahun" value="{{ request()->tahun }}">
                <button type="submit" class="btn btn-sm btn-primary">Jadwal Bentrok</button>
            </form>
                @endif
        </div>
    </div>
    <div class="row card-body">
        <div class="overflow-auto">
            <table class="datatable table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Tipe</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($scheduledEvents as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $event['event']->nama }}</td>
                        <td>{{ $event['event']->type }}</td>
                        <td>{{ Carbon\Carbon::createFromDate($tahun, $bulan, $event['startDay'])->format('d F Y') }}</td>
                        <td>{{ Carbon\Carbon::createFromDate($tahun, $bulan, $event['endDay'])->format('d F Y') }}</td>
                        <td>{{ $event['event']->level }}</td>
                        <td>{{ $event['event']->status }}</td>
                        <td>
                            <a href="/event/{{ $event['event']->id }}/edit"
                                class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" align="center">Tidak Ada Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    @if(session('events'))
    const events = @json(session('events'));
    console.log(events);
    @endif
</script>
@endsection
