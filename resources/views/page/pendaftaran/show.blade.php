@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Form Detail Pendaftaran</h1>
    </div>
    <section class="py-5 card info-card sales-card">
        <div class="card-body">
            {{-- <div class="h3 text-bold text-center">Form Edit Event</div> --}}

            @if ($errors->any())
                <div class="m-auto col-md-6">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-warning text-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-6 m-auto">
                <div class="my-3">
                    <label for="eventname" class="form-label">Nama Event</label>
                    <input disabled value="{{ $event->eventname }}" name="eventname" type="text" class="form-control"
                        id="eventname">
                </div>
                <div class="my-3 row">
                    <div class="col">
                        <label for="eventdate" class="form-label">Tanggal</label>
                        <input disabled value="{{ $event->eventdate }}" name="eventdate" type="datetime-local"
                            class="form-control" id="eventdate">
                    </div>

                    <div class="col">
                        <label for="tempat" class="form-label">Tempat</label>
                        <input disabled placeholder="Masukkan Tempat Event" name="eventlocation" type="text"
                            class="form-control" id="tempat" value="{{ $event->eventlocation }}">
                    </div>
                </div>
                <div class="my-3 row">
                    <div class="col">
                        <label for="type" class="form-label">Type</label>
                        <input disabled placeholder="Masukkan Tempat Event" name="eventtype" type="text"
                            class="form-control text-capitalize" id="tempat" value="{{ $event->eventtype }}">
                    </div>

                    <div class="col">
                        <label for="eventprice" class="form-label">Harga Event</label>
                        <input disabled placeholder="Masukkan Type Event Dahulu" name="eventprice" type="number"
                            class="form-control" id="eventprice" value="{{ $event->eventprice }}">
                    </div>
                </div>
                <div class="my-3 row">
                    <div class="col">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input disabled placeholder="Masukkan Penyelenggara Event" name="eventorganizer" type="text"
                            class="form-control eventprice" id="penyelenggara" value="{{ $event->eventorganizer }}">
                    </div>

                    <div class="col">
                        <label for="eventkategori" class="form-label">Kategori Event</label>
                        <input disabled placeholder="Masukkan Tempat Event" name="eventkategori" type="text"
                            class="form-control text-capitalize" id="tempat" value="{{ $event->eventkategori }}">
                    </div>
                </div>
                <hr>
                <h5 class="fw-bold">Data Peserta</h5>
                <form class="row g-3" method="POST" action="{{ route('pendaftaran.index') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="text" hidden name="user_id" value="{{ Auth::user()->id }}">
                    <input type="text" hidden name="event_id" value="{{ $event->id }}">
                    <input type="text" hidden name="price" value="{{ $event->eventprice }}">
                    <div class="my-3 row">
                        <div class="col">
                            <label for="nama" class="form-label">Nama</label>
                            <input placeholder="Masukkan Nama Peserta" name="nama" type="text" class="form-control"
                                id="name" value="{{ $user->name }}">
                        </div>
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input placeholder="Masukkan Username Peserta" name="username" type="text"
                                class="form-control" id="username" value="{{ $user->username }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" value="{{ $user->email }}"
                                class="form-control">
                        </div>
                        <div class="col">
                            <label for="type" class="form-label">Mendaftar Sebagai</label>
                            <select name="type" id="type" class="form-select">
                                <option value="peserta" selected>Pilih Salah Satu</option>
                                <option value="peserta">Peserta</option>
                                <option value="volunteer">Volunteer</option>
                            </select>
                            <small class="text-danger">*Jika Tidak Di Pilih Maka Defaultnya Adalah Peserta</small>
                        </div>
                    </div>
                    <div class="my-3 row">
                        <div class="form-check d-flex">
                            <label class="form-check-label mx-auto my-2" for="gridCheck">
                                <input class="form-check-input gridCheck" name="gridCheck" type="checkbox"
                                    id="gridCheck">
                                Data Sudah Benar
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="buttonSubmit"
                                class="btn btn-primary disabled buttonSubmit">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script></script>
@endsection

@section('scripts')
    <script>
        // check checklist
        var elems = document.querySelectorAll('.gridCheck');
        var btn = document.querySelector('.buttonSubmit');
        [].forEach.call(elems, function(el) {
            el.addEventListener('change', function() {
                var checked = document.querySelectorAll('.gridCheck:checked');
                if (checked.length) {
                    document.getElementById("buttonSubmit").classList.remove('disabled');
                } else {
                    document.getElementById("buttonSubmit").classList.add('disabled');
                }
            });
        });
    </script>
@endsection
