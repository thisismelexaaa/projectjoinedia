@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>List event</h1>
    </div>
    <p>Cari event yang kamu sukai</p>

    <div class="row row-cols-md-5">
        @foreach ($dataEvent as $e)
            <div class="col-md-2 mb-3">
                <div class="card h-100">
                    <a href="event/{{ $e->id }}">
                        <img class="img-fluid w-100 p-2 rounded rounded-4" style="height: 250px;"
                            src="{{ asset('assets/images/eventimage/' . $e->image) }}" alt="..." />
                    </a>
                    <div class="card-body">
                        <div class="card-title">
                            <a class="text-dark" href="event/{{ $e->id }}">
                                <h5>
                                    <b>
                                        {{ Str::limit($e->nama, 20) }}
                                    </b>
                                </h5>
                            </a>
                            <div class="row">
                                <span class="fw-light text-capitalize h-25">{{ $e->organizer }}</span>
                                <span class="fw-light text-capitalize">{{ $e->start_date }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-light text-capitalize fw-bold">{{ $e->type }}</span>
                                <span class="fw-light text-capitalize fw-bold">@currency($e->price)</span>
                            </div>
                        </div>
                        <span class="card-text">{!! Str::limit($e->description, 50) !!}</span>
                    </div>
                    <div class="card-footer">
                        <a href="event/{{ $e->id }}">Lihat Detail Event</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
