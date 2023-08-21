@extends('layouts.app')

@section('content')
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
                        <a href="{{ route('event.laporan') }}" class="btn btn-sm btn-primary my-auto col-md-2">Cetak
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
                            <th>Sponsor</th>
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
<<<<<<< HEAD

>>>>>>> f89a811 (First Commit : Progress 80%)
=======
>>>>>>> 8019b8b (70% Progress)
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

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
                                data + "\" height=\"50\"/>";
                        }
                    },
                    {
                        data: 'nama',
                        name: 'name',
                        render: function(data, type, full, meta) {
                            link = "{{ route('event.show', ':id') }}";
                            return "<a class='align-baseline text-black fw-bold' href=\"" + link.replace(':id', full.id) +
                                "\">" + data + "</a>";
                        }
                    },
                    {
                        data: 'date',
                        name: 'date',
                        //    Format tanggal ke dalam format Indonesia
                        render: function(data, type, full, meta) {
                            start_date = moment(full.start_date).format('DD MMMM YYYY')
                            end_date = moment(full.end_date).format('DD MMMM YYYY')
                            return start_date + " - " + end_date;
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
                    {
                        data: 'sponsor',
                        name: 'sponsor',
                        // Tampilkan semua sponsor yang terkait dengan event
                        render: function(data, type, full, meta) {
                            var sponsors = [];
                            $.each(data, function(index, value) {
                                sponsors.push(value.name);
                            });
                            return sponsors.join(', ');
                        }
                    },
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
            $('#myTable').on('submit', '.delete-form', function(e) {
                e.preventDefault();

                var deleteUrl = $(this).attr('action');

                // Lakukan konfirmasi penghapusan (optional)
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    // Lakukan proses penghapusan melalui AJAX
                    $.ajax({
                        url: deleteUrl,
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Refresh atau manipulasi tabel setelah penghapusan berhasil
                            // Misalnya, reload tabel
                            $('#myTable').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
>>>>>>> 8019b8b (70% Progress)
    </script>
@endsection
