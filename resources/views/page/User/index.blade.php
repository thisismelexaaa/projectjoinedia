@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>List event</h1>
    </div>
    <p>Here you can see all events</p>

    <div class="row row-cols-md-5">
        @foreach ($dataEvent as $e)
            <div class="col-md-2">
                <div class="card">
                    <a href="event/{{ $e->id }}">
                        <img class="img-fluid w-100" style="width:300;height:250px;"
                            src="/storage/eventimage/{{ $e->eventimage }}" alt="..." />
                    </a>
                    <div class="card-body">
                        <a class="text-dark" href="event/{{ $e->id }}">
                            <h5 class="card-title">{{ $e->eventname }} <br>
                        </a>
                        <span class="fw-light text-capitalize">{{ $e->eventorganizer }}</span>
                        </h5>
                        <p class="card-text">{!! Str::limit($e->eventdescription, 50) !!}</p>
                    </div>
                    <div class="card-footer">
                        <a href="event/{{ $e->id }}">Lihat Detail Event</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
