@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<<<<<<< HEAD
    <style>
        th,
        td {
            white-space: nowrap;
        }

        div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
    </style>
    <section class="card info-card sales-card overflow-auto">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between row me-2">
                <p class="col-md">List Events</p>
                <div class="col-md justify-content-end row gap-1">
                    <a href="{{ route('event.create') }}" class="btn btn-sm btn-success my-auto col-md-2">Add Event</a>
                    @if (Auth::user()->role == 'superadmin')
                        <a href="{{ route('be.laporan') }}" class="btn btn-sm btn-primary my-auto col-md-2">Cetak
                            Laporan</a>
                    @endif
                </div>
            </div>
            <div class="table-container">
                <table class="table table-borderless datatable table-hover" id="myTable" width="100%">
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
                            {{-- <th>Sponsor</th> --}}
                            <th>Level</th>
                            <th>Kuota</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
=======
    <div class="pagetitle">
        <h1>List Event</h1>
    </div>
=======
>>>>>>> 8019b8b (70% Progress)
    <section class="card info-card sales-card overflow-auto">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between row me-2">
                <p class="col-md">List Events</p>
                <div class="col-md justify-content-end row gap-1">
                    <a href="{{ route('event.create') }}" class="btn btn-sm btn-success my-auto col-md-2">Add Event</a>
                    @if (Auth::user()->role == 'superadmin')
                        <a href="{{ route('event.laporan') }}" class="btn btn-sm btn-primary my-auto col-md-2">Cetak
                            Laporan</a>
                    @endif
                </div>
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
                            <th>Kuota</th>
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
                                <td class="align-baseline" width="15%">
                                    <a href="{{ route('event.show', $event->id) }}"
                                        class="text-decoration-none text-dark fw-bold">

                                        {{ Str::limit($event->nama, 25) }}
                                    </a>
                                </td>
                                <td class="align-baseline" width="25%">
                                    {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%A, %d %B %Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($event->end_date)->formatLocalized('%A, %d %B %Y') }}
                                </td>
                                <td class="text-capitalize align-baseline">{{ $event->type }}</td>
                                <td class="text-capitalize align-baseline">
                                    {{ $event->kategori }}</td>
                                <td class="align-baseline" width="15%">{{ $event->organizer }}</td>
                                <td class="align-baseline">{{ $event->location }}</td>
                                <td class="align-baseline">@currency($event->price)</td>
                                <td class="align-baseline text-capitalize" width="15%">{{ $event->user->name }}</td>
                                <td class="align-baseline">
                                    <span class="">{!! Str::limit($event->description, 75) !!}</span>
                                </td>
                                <td class="align-baseline text-capitalize">
                                    @if ($event->sponsor->isEmpty())
                                        <span class="text-capitalize badge w-100 bg-danger">Tidak ada sponsor</span>
                                    @endif
                                    @foreach ($event->sponsor as $sponsor)
                                        <ol>{{ $sponsor->name }}</ol>
                                    @endforeach
                                </td>
                                <td class="align-baseline">{{ $event->kuota }}</td>
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
<<<<<<< HEAD

>>>>>>> f89a811 (First Commit : Progress 80%)
=======
>>>>>>> 8019b8b (70% Progress)
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
<<<<<<< HEAD
<<<<<<< HEAD

        $(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('event.index') }}',
                    // success: function(data) {
                    //     console.log(data); // Menampilkan data ke konsol
                    // },
                },
                dataType: 'json',
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                },
                scrollCollapse: true,
                scrollX: true,
                columns: [{
                        // Buat nomor urut
                        data: 'id',
                        name: 'id',
                        render: function(data, type, full, meta) {
                            iteration = meta.row + meta.settings._iDisplayStart + 1
                            return '<span class="align-baseline fw-bold">' + iteration + '</span>';
                        }
                    },
                    {
                        data: 'image',
                        name: 'poster',
                        render: function(data, type, full, meta) {
                            if (data == null) {
                                return "No Image";
                            }
                            return "<img class='align-baseline' src=\"assets/images/eventimage/" +
                                data + "\" height=\"120\"/>";
                        }
                    },
                    {
                        data: 'nama',
                        name: 'name',
                        render: function(data, type, full, meta) {
                            link = "{{ route('be.show', ':id') }}";
                            return "<a class='align-baseline text-black fw-bold' href=\"" + link
                                .replace(':id', full.id) +
                                "\">" + data + "</a>";
                        }
                    },
                    {
                        data: 'date',
                        name: 'date',
                        //    Format tanggal ke dalam format Indonesia
                        render: function(data, type, full, meta) {
                            if (full.start_date != null && full.end_date != null) {
                                start_date = moment(full.start_date).format('DD MMMM YYYY')
                                end_date = moment(full.end_date).format('DD MMMM YYYY')
                                return start_date + " - " + end_date;
                            }else{
                                isDateNull = 'Tanggal belum di generate'
                                return isDateNull;
                            }
                        }
                    },
                    {
                        data: 'type',
                        name: 'type',
                        render: function(data, type, full, meta) {
                            return "<span class='align-baseline text-black text-capitalize'>" +
                                data + "</span>";
                        }
                    },
                    {
                        data: 'kategori',
                        name: 'kategori',
                        render: function(data, type, full, meta) {
                            return "<span class='align-baseline text-black text-capitalize'>" +
                                data + "</span>";
                        }
                    },
                    {
                        data: 'organizer',
                        name: 'penyelenggara'
                    },
                    {
                        data: 'location',
                        name: 'tempat'
                    },
                    {
                        data: 'price',
                        name: 'harga',
                        // Format harga ke dalam format rupiah
                        render: function(data, type, full, meta) {
                            return "Rp. " + data.toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    },
                    {
                        data: 'user_id',
                        name: 'uploaded_by',
                        render: function(data, type, full, meta) {
                            return "<span class='align-baseline text-black text-capitalize'>" +
                                full.user + "</span>";
                        }
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function(data, type, full, meta) {
                            // Convert HTML entities to readable text
                            var text = $("<textarea />").html(data).text();
                            return text.length > 50 ?
                                text.substr(0, 50) + '...' :
                                text;
                        }
                    },
                    // {
                    //     data: 'sponsor',
                    //     name: 'sponsor',
                    //     // Tampilkan semua sponsor yang terkait dengan event
                    //     render: function(data, type, full, meta) {
                    //         var sponsors = [];
                    //         $.each(data, function(index, value) {
                    //             sponsors.push(value.name);
                    //         });
                    //         // Jika tidak ada sponsor, tampilkan pesan tidak ada sponsor
                    //         if (sponsors.length == 0) {
                    //             return '<span class="badge bg-danger">No Sponsor</span>';
                    //         }
                    //         return sponsors.join(', ');
                    //     }
                    // },
                    {
                        data: 'level',
                        name: 'level',
                        render: function(data, type, full, meta) {
                            return "<span class='align-baseline text-black text-capitalize'>" +
                                data + "</span>";
                        }
                    },
                    {
                        data: 'kuota',
                        name: 'kuota'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            return "<span class='text-black text-capitalize'>" +
                                data + "</span>";
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('[data-bs-toggle="tooltip"]').tooltip();

            // Event delegation untuk tombol delete
            // $('#myTable').on('submit', '.delete-form', function(e) {
            //     e.preventDefault();

            //     var deleteUrl = $(this).attr('action');

            //     // Lakukan konfirmasi penghapusan (optional)
            //     if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            //         // Lakukan proses penghapusan melalui AJAX
            //         $.ajax({
            //             url: deleteUrl,
            //             method: 'POST',
            //             data: $(this).serialize(),
            //             success: function(response) {
            //                 // Refresh atau manipulasi tabel setelah penghapusan berhasil
            //                 // Misalnya, reload tabel
            //                 $('#myTable').DataTable().ajax.reload();
            //             },
            //             error: function(error) {
            //                 console.log(error);
            //             }
            //         });
            //     }
            // });
        });
=======
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
        $(document).ready(function() {
            $('#data-table').DataTable({
                scrollX: true // Menambahkan opsi scrollX
            });
        });
>>>>>>> 8019b8b (70% Progress)
    </script>
@endsection
