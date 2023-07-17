@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>List Event</h1>
    </div>
    <section class="card info-card sales-card ">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between d-flex">
                <p>List Events</p>
                <a href="{{ route('event.create') }}" class="btn btn-sm btn-success my-auto">Add Event</a>
            </div>
            <table
                class="table table-borderless datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Poster</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penyelenggara</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Uploaded By</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataEvent as $event)
                        <tr>
                            <th class="align-baseline" scope="row">{{ ++$i }}</th>
                            <td class="align-baseline">
                                <img src="storage/eventimage/{{ $event->eventimage }}" height="125" alt="">
                            </td>
                            <td class="align-baseline">
                                <a href="event/{{ $event->id }}"
                                    class="text-decoration-none text-dark fw-bold">{{ Str::limit($event->eventname, 25) }}</a>
                            </td>
                            <td class="align-baseline">
                                {{ \Carbon\Carbon::parse($event->eventdate)->formatLocalized('%A, %d %B %Y') }}
                            </td>
                            <td class="text-capitalize align-baseline">{{ $event->eventtype }}</td>
                            <td class="text-capitalize align-baseline">
                                {{ $event->eventkategori }}</td>
                            <td class="align-baseline">{{ $event->eventorganizer }}</td>
                            <td class="align-baseline">{{ $event->eventlocation }}</td>
                            <td class="align-baseline">@currency($event->eventprice)</td>
                            <td class="align-baseline text-capitalize">{{ $event->user->name }}</td>
                            <td class="align-baseline">
                                <span class="">{!! Str::limit($event->eventdescription, 25) !!}</span>
                            </td>

                            @if ($event->eventstatus == 'aktif' || $event->eventstatus == 'Aktif')
                                <td class="align-baseline"><span
                                        class="text-capitalize badge w-100 bg-success">{{ $event->eventstatus }}</span>
                                </td>
                            @elseif ($event->eventstatus == 'berjalan' || $event->eventstatus == 'Berjalan')
                                <td class="align-baseline"><span
                                        class="text-capitalize badge w-100 bg-primary">{{ $event->eventstatus }}</span>
                                </td>
                            @else
                                <td class="align-baseline"><span
                                        class="text-capitalize badge w-100 bg-danger">{{ $event->eventstatus }}</span>
                                </td>
                            @endif
                            <td class="align-baseline">
                                <div class="gap-3 d-flex">
                                    <a href="event/{{ $event->id }}" class="btn btn-sm btn-primary"
                                        data-bs-toggle="tooltip" data-bs-title="Show">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="/event/{{ $event->id }}/edit"
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
    </section>
@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
