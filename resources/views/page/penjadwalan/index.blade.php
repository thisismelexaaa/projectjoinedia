@extends('layouts.app')

@section('content')
    <style>
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
    </style>

    <div class="calendar-container">
        <div id="calendar"></div>
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
