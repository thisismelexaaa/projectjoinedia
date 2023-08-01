@extends('layouts.app')

@section('content')
    <section class="card info-card sales-card overflow-auto">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between row">
                <p class="col-md">List Events</p>
                <a href="{{ route('event.create') }}" class="btn btn-sm btn-success my-auto col-md-2">Add Event</a>
            </div>
            <div class="table-responsive">
                <table id="data-table" class="table table-borderless datatable table-hover stripe row-border order-column">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Poster</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Kategori</th>
                            <th>Penyelenggara</th>
                            <th>Tempat</th>
                            <th>Harga</th>
                            <th>Uploaded By</th>
                            <th>Description</th>
                            <th>Sponsor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataEvent as $event)
                            <tr>
                                <th class="align-baseline">{{ ++$i }}</th>
                                <td class="align-baseline">
                                    <a href="{{ route('event.show', $event->id) }}"
                                        class="text-decoration-none text-dark fw-bold">
                                        <img src="{{ asset('assets/images/eventimage/' . $event->image) }}" height="125"
                                            alt="">
                                    </a>
                                </td>
                                <td class="align-baseline">
                                    <a href="{{ route('event.show', $event->id) }}"
                                        class="text-decoration-none text-dark fw-bold">

                                        {{ Str::limit($event->nama, 25) }}
                                    </a>
                                </td>
                                <td class="align-baseline">
                                    {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%A, %d %B %Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($event->end_date)->formatLocalized('%A, %d %B %Y') }}
                                </td>
                                <td class="text-capitalize align-baseline">{{ $event->type }}</td>
                                <td class="text-capitalize align-baseline">
                                    {{ $event->kategori }}</td>
                                <td class="align-baseline">{{ $event->organizer }}</td>
                                <td class="align-baseline">{{ $event->location }}</td>
                                <td class="align-baseline">@currency($event->price)</td>
                                <td class="align-baseline text-capitalize">{{ $event->user->name }}</td>
                                <td class="align-baseline">
                                    <span class="">{!! Str::limit($event->description, 75) !!}</span>
                                </td>
                                {{-- Null safety --}}
                                @if ($event->sponsor == null)
                                    <td class="align-baseline">Tidak Ada Sponsor</td>
                                @else
                                    <td class="align-baseline text-capitalize">{{ $event->sponsor->name }}</td>
                                @endif
                                @if ($event->status == 'aktif' || $event->status == 'Aktif')
                                    <td class="align-baseline"><span
                                            class="text-capitalize badge w-100 bg-success">{{ $event->status }}</span>
                                    </td>
                                @elseif ($event->status == 'berjalan' || $event->status == 'Berjalan')
                                    <td class="align-baseline"><span
                                            class="text-capitalize badge w-100 bg-primary">{{ $event->status }}</span>
                                    </td>
                                @else
                                    <td class="align-baseline"><span
                                            class="text-capitalize badge w-100 bg-danger">{{ $event->status }}</span>
                                    </td>
                                @endif
                                <td class="align-baseline">
                                    <div class="gap-3 d-flex">
                                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm btn-primary"
                                            data-bs-toggle="tooltip" data-bs-title="Show">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('event.edit', $event->id, '/edit') }}"
                                            class="btn btn-sm btn-warning"data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('event.destroy', $event->id) }}" method="post">
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
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        $(document).ready(function() {
            $('#data-table').DataTable({
                scrollX: true // Menambahkan opsi scrollX
            });
        });
    </script>
@endsection
