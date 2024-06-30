@extends('layouts.app')

@section('content')
    <style>
        body {
            overflow: auto;
        }

=======
>>>>>>> 8019b8b (70% Progress)
        #calendar {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        .fc-title {
            align-items: center;
            font-size: 16px;
            font-weight: bold;
            margin: 15px;
        }

        /* Warna latar belakang acara */
        .fc-event {
            color: #fff;
            cursor: pointer;
            padding: 3px;
            transition: background-color 0.3s;
        }

        .fc-event:hover {
            opacity: 0.8;
        }
<<<<<<< HEAD

        .keterangan {
            font-size: 14px;
            font-weight: bold;
            margin: 15px;
        }

        .univ {
            color: #0d6efd;
        .univ {
            color: #0d6efd;
        }

        .fak {
            color: #6610f2;
        }

        .prod {
            color: #ffc107;
        }

        .hima {
            color: #fd7e14;
        }

        .ukm {
            color: #e74c3c;
        }

        .bkm {
            color: #34495e;
        }
    </style>

    <div class="callendar-body">
        <div class="calendar-container">
            <div id="calendar"></div>
        </div>
        <p class="keterangan">Keterangan :
            <span><i class="bi bi-file-fill univ"></i> Universitas |</span>
            <span><i class="bi bi-file-fill fak"></i> Fakultas |</span>
            <span><i class="bi bi-file-fill prod"></i> Prodi |</span>
            <span><i class="bi bi-file-fill bkm"></i> Bkm |</span>
            <span><i class="bi bi-file-fill hima"></i> Hima |</span>
            <span><i class="bi bi-file-fill ukm"></i> Ukm </span>
        </p>
    </div>
    <form id="optimizeForm" action="{{ route('penjadwalan.optimasi') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="jadwal" id="jadwalInput">
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            let data = @json($jadwal);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay optimasiBtn'
                },
                customButtons: {
                    optimasiBtn: {
                        text: 'Optimasi Jadwal',
                        click: () => {
                            swal.fire({
                                title: 'Optimasi Jadwal',
                                text: 'Apakah anda yakin ingin mengoptimasi jadwal?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Batal'
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    let dataCalendar = $('#calendar').fullCalendar(
                                        'clientEvents');
                                    let jadwal = [];
                                    dataCalendar.forEach((item) => {
                                        let start = moment(item.start).format(
                                            'Y-MM-DD HH:mm:ss');
                                        let end = moment(item.end).format(
                                            'Y-MM-DD HH:mm:ss');

                                        jadwal.push({
                                            id: item._id,
                                            title: item.title,
                                            start: start,
                                            end: end,
                                        });
                                    });

                                    // Fill the hidden input with the serialized schedule data
                                    $('#jadwalInput').val(JSON.stringify(jadwal));

                                    // Submit the form
                                    $('#optimizeForm').submit();
                                }
                            });
                        }
                    }
                },
                events: data,
                themeSystem: 'bootstrap',
                selectable: true,
                selectHelper: true,
                height: 750,
                locale: 'id',
            });
        });
    </script>
@endpush
