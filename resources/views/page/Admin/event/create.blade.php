@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Form Tambah Event</h1>
    </div>

    <section class="py-5 card info-card sales-card">
        <div class="card-body">

            {{-- <div class="h3 text-bold text-center">Form Tambah Event</div> --}}
            @if ($errors->any())
                <div class="m-auto col-md-6">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-warning text-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="row g-3" method="POST" action="{{ route('event.index') }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                {{-- Cek akun yang sedang login sekarang --}}
                <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                <div class="col-md-6 m-auto">
                    <div class="my-3">
                        <label for="nama" class="form-label">Nama Event</label>
                        <input placeholder="Masukkan Nama Event" name="eventname" type="text" class="form-control"
                            id="nama">
                    </div>
                    <div class="my-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input placeholder="Masukkan Tanggal Event" name="eventdate" type="datetime-local"
                            class="form-control" id="tanggal">
                    </div>
                    <div class="my-3">
                        <label for="tempat" class="form-label">Tempat</label>
                        <input placeholder="Masukkan Tempat Event" name="eventlocation" type="text" class="form-control"
                            id="tempat">
                    </div>
                    <div class="my-3 row">
                        <div class="col-6">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" name="eventtype" id="type">
                                <option value="" selected>Pilih Salah Satu</option>
                                <option value="gratis">Gratis</option>
                                <option value="berbayar">Berbayar</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="eventprice" class="form-label">Harga Event</label>
                            <input readonly placeholder="Masukkan Type Event Dahulu" type="number" class="form-control"
                                id="eventprice1" hidden>

                            <input readonly placeholder="Masukkan Type Event Dahulu" name="eventprice" type="number"
                                class="form-control" id="eventprice">
                        </div>
                        <span class="text-danger fs-6 fst-italic">"Jika Type Event Tidak Di Pilih Maka Event Akan Dianggap
                            Gratis"
                        </span>
                    </div>
                    <div class="my-3">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input placeholder="Masukkan Penyelenggara Event" name="eventorganizer" type="text"
                            class="form-control" id="penyelenggara">
                    </div>
                    <div class="my-3 row">
                        <div class="col-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="eventstatus" id="status">
                                <option selected value="aktif">Pilih Salah Satu</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="eventkategori" class="form-label">Kategori Event</label>
                            <select class="form-select" name="eventkategori" id="eventkategori">
                                <option selected value="aktif">Pilih Salah Satu</option>
                                <option value="akademik">Akademik</option>
                                <option value="non-akademik">Non-Akademik</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="eventdescription" class="form-label">Deskripsi event</label>
                        <input type="hidden" name="eventdescription">
                        <div id="editor"></div>
                    </div>
                    <div class="my-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input name="eventimage" type="file" class="form-control" id="poster">
                        <span class="text-danger fs-6 fst-italic">"Ukuran Poster minimal 500x500"
                        </span>
                    </div>
                    <div class="form-check my-3">
                        <input class="form-check-input gridCheck" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Data Sudah Benar
                        </label>
                    </div>
                    @if ($errors->any())
                        <span class="text-danger text-sm">*Centang Box Terlebih Dahulu</span>
                    @endif
                    <div class="text-center">
                        <button type="submit" id="buttonSubmit"
                            class="btn btn-primary disabled buttonSubmit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
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

        // Check option select type event price
        var elems = document.querySelectorAll('#type');
        [].forEach.call(elems, function(el) {
            el.addEventListener('change', function() {
                var checked = document.querySelectorAll('#type option:checked');
                if (checked.length) {
                    if (checked[0].value == 'gratis') {
                        document.getElementById("eventprice1").hidden = false;
                        document.getElementById("eventprice1").placeholder = "Gratis";

                        document.getElementById("eventprice").hidden = true;
                        document.getElementById("eventprice").value = 0;

                    } else if (checked[0].value == 'berbayar') {
                        document.getElementById("eventprice1").hidden = true;
                        document.getElementById("eventprice1").placeholder = "Gratis";

                        document.getElementById("eventprice").hidden = false;
                        document.getElementById("eventprice").readOnly = false;
                        document.getElementById("eventprice").value = 0;
                    } else {
                        document.getElementById("eventprice1").hidden = false;
                        document.getElementById("eventprice1").placeholder = "Pilih Type Event";
                        document.getElementById("eventprice1").value = "gratis";

                        document.getElementById("eventprice").hidden = true;
                        document.getElementById("eventprice").readOnly = true;
                        document.getElementById("eventprice").value = 0;
                    }
                }
            });
        });

        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='eventdescription']").value = quill.root.innerHTML;
        });
    </script>
@endsection
