@extends('layouts.app')

@section('content')
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
    <section class="card info-card sales-card overflow-auto">
        {{-- List Event --}}
        <div class="card-body">
            <div class="card-title justify-content-between row">
                <p class="col-md">List Events</p>
                <a href="{{ route('event.create') }}" class="btn btn-sm btn-success my-auto col-md-2">Add Event</a>
            </div>
            <div class="overflow-auto">
                <table
                    class="table table-borderless datatable datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm d-block">
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
                                    <a href="{{ route('event.show', $event->id) }}" class="text-decoration-none text-dark fw-bold">
                                        <img src="storage/eventimage/{{ $event->eventimage }}" height="125"
                                            alt="">
                                    </a>
                                </td>
                                <td class="align-baseline">
                                    <a href="{{ route('event.show', $event->id) }}" class="text-decoration-none text-dark fw-bold">

                                        {{ Str::limit($event->eventname, 25) }}
                                    </a>
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
                                    <span class="">{!! Str::limit($event->eventdescription, 75) !!}</span>
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
                                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm btn-primary"
                                            data-bs-toggle="tooltip" data-bs-title="Show">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('event.update', $event->id) }}"
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

>>>>>>> f89a811 (First Commit : Progress 80%)
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
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
    </script>
@endsection
