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

        .lvl1 {
            color: #00713e;
        }

        .lvl2 {
            color: #f39c12;
        }

        .lvl3 {
            color: #e74c3c;
        }
    </style>

    <div class="callendar-body">
        <div class="calendar-container">
            <div id="calendar"></div>
        </div>
        <p class="keterangan">Keterangan :
            <span><i class="bi bi-file-fill lvl1"></i> Level 1 |</span>
            <span><i class="bi bi-file-fill lvl2"></i> Level 2 |</span>
            <span><i class="bi bi-file-fill lvl3"></i> Level 3</span>
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
