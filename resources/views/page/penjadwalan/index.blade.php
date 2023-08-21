@extends('layouts.app')

@section('content')
    <style>
        body{
            overflow: hidden;
        }

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

        .keterangan {
            font-size: 14px;
            font-weight: bold;
            margin: 15px;
        }

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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var data = @json($jadwal);
            console.log(data);
            $('#calendar').fullCalendar({

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: data,
                themeSystem: 'bootstrap',
                selectable: true,
                selectHelper: true,
                height: 825,
                locale: 'id',
            });
        });
    </script>
@endpush
