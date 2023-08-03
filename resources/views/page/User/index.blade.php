@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>List event</h1>
    </div>
    <p>Here you can see all events</p>

    <div class="row row-cols-md-5">
        @foreach ($dataEvent as $e)
            <div class="col-md-2">
                <div class="card h-100">
                    <a href="event/{{ $e->id }}">
                        <img class="img-fluid w-100" style="width:300;height:250px;"
                            src="{{ asset('assets/images/eventimage/' . $e->image) }}" alt="..." />
                    </a>
                    <div class="card-body">
                        <a class="text-dark" href="event/{{ $e->id }}">
                            <h5 class="card-title">{{ $e->nama }} <br>
                        </a>
                        <div class="d-flex justify-content-between">
                            <span class="fw-light text-capitalize">{{ $e->organizer }}</span>
                        </div>
                        <span class="fw-light text-capitalize">{{ $e->start_date }}</span>
                        </h5>
                        <p class="card-text h-50 pb-4">{!! Str::limit($e->description, 50) !!}</p>
                        <div class="d-flex justify-content-between">
                            <span class="fw-light text-capitalize">{{ $e->type }}</span>
                            <span class="fw-light text-capitalize">@currency($e->price)</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="event/{{ $e->id }}">Lihat Detail Event</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
