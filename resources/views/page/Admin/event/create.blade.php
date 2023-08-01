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
                        <input placeholder="Masukkan Nama Event" value="{{ old('nama') }}" name="nama" type="text"
                            class="form-control" id="nama">
                    </div>
                    <div class="my-3 row">
                        <label class="form-label">Tanggal Pelaksanaan Event</label>
                        <div class="col d-flex">
                            <span for="start_date" class="m-auto">Dimulai : &nbsp;&nbsp;&nbsp;</span>
                            <input placeholder="Masukkan Tanggal Event" value="{{ old('start_date') }}" name="start_date"
                                type="datetime-local" class="form-control col" id="start_date">
                        </div>
                        <div class="col d-flex">
                            <span for="end_date" class="m-auto">Berakhir : &nbsp;&nbsp;&nbsp;</span>
                            <input placeholder="Masukkan Tanggal Event" value="{{ old('end_date') }}" name="end_date"
                                type="datetime-local" class="form-control col" id="end_date">
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="tempat" class="form-label">Tempat</label>
                        <input placeholder="Masukkan Tempat Event" value="{{ old('location') }}" name="location"
                            type="text" class="form-control" id="tempat">
                    </div>
                    <div class="my-3 row">
                        <div class="col-6">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" onchange="handleTypeChange(this)">
                                <option selected value="gratis">Pilih Salah Satu</option>
                                <option value="gratis">Gratis</option>
                                <option value="berbayar">Berbayar</option>
                                <!-- tambahkan opsi lain jika diperlukan -->
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="price" class="form-label d-flex justify-content-between">
                                <span class="">Harga Event</span>
                                <span id="formattedPrice" class="form-text"> </span>
                            </label>
                            <input readonly placeholder="Masukkan Type Event Dahulu" type="number" class="form-control"
                                id="price1" hidden>

                            <input readonly placeholder="Masukkan Type Event Dahulu" name="price" type="number"
                                class="form-control" id="price" value="{{ old('price') }}">
                        </div>

                        <span class="text-danger fs-6 fst-italic col-12">"Jika Type Event Tidak Di Pilih Maka Event Akan
                            Dianggap Gratis"
                        </span>
                    </div>
                    <div class="my-3">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input placeholder="Masukkan Penyelenggara Event" name="organizer" type="text"
                            class="form-control" id="penyelenggara"value='{{ old('organizer') }}'>
                    </div>
                    <div class="my-3 row">
                        <div class="col-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option selected value="aktif">Pilih Salah Satu</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="kategori" class="form-label">Kategori Event</label>
                            <select class="form-select" name="kategori" id="eventkategori">
                                <option selected value="aktif">Pilih Salah Satu</option>
                                <option value="akademik">Akademik</option>
                                <option value="non-akademik">Non-Akademik</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="description" class="form-label">Deskripsi event</label>
                        <input type="hidden" name="description" value="{{ old('description') }}">
                        <div id="editor">{!! old('description') !!}</div>
                    </div>
                    <div class="my-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input value="{{ old('image') }}" name="image" type="file" class="form-control"
                            id="poster">
                        </span>
                    </div>
                    <div class="my-3">
                        <input class="form-check-input sponsorCheck" type="checkbox" id="sponsorCheck">
                        <label class="form-check-label" for="sponsorCheck">
                            Event Ini Memiliki Sponsor
                        </label>
                    </div>
                    <div class="my-3 bg-light p-3 rounded border" id="sponsors" hidden>
                        <div class="row">
                            <div class="col">
                                <label for="sponsor" class="form-label">Sponsor</label>
                                <input placeholder="Masukkan Sponsor" name="sponsor_name" type="text"
                                    class="form-control" id="sponsor"value='{{ old('sponsor_name') }}'>
                            </div>
                            <div class="col">
                                <label for="logo" class="form-label">Logo Sponsor</label>
                                <input value="{{ old('logo') }}" name="sponsor_logo" type="file"
                                    class="form-control" id="logo">
                                </span>
                            </div>
                        </div>
                        <div class="col my-3">
                            <label for="deskripsiSponsor" class="form-label">Deskripsi Sponsor</label>
                            <input type="text" class="form-control" name="deskripsiSponsor" value="{{ old('deskripsiSponsor') }}">
                        </div>
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

        // check checklist
        var elems = document.querySelectorAll('.sponsorCheck');

        [].forEach.call(elems, function(el) {
            el.addEventListener('change', function() {
                var checked = document.querySelectorAll('.sponsorCheck:checked');
                if (checked.length) {
                    document.getElementById("sponsors").hidden = false;
                } else {
                    document.getElementById("sponsors").hidden = true;
                }
            });
        });

        // Check option select type event price
        function handleTypeChange(selectElement) {
            var priceInput = document.getElementById("price1");
            var priceInputHidden = document.getElementById("price");
            var selectedValue = selectElement.value;

            if (selectedValue === 'gratis') {
                priceInput.hidden = false;
                priceInput.value = "";
                priceInput.placeholder = "Gratis";

                priceInputHidden.hidden = true;
                priceInputHidden.value = 0;
            } else if (selectedValue === 'berbayar') {
                priceInput.hidden = true;
                priceInput.value = "";

                priceInputHidden.hidden = false;
                priceInputHidden.readOnly = false;
                priceInputHidden.value = 0;
            } else {
                priceInput.hidden = false;
                priceInput.placeholder = "Masukkan Type Event Dahulu";
                priceInput.value = "Masukkan Type Event Dahulu";

                priceInputHidden.hidden = true;
                priceInputHidden.readOnly = true;
                priceInputHidden.value = 0;
            }
        }

        // Format currency input
        const priceInput = document.getElementById("price");
        const formattedPrice = document.getElementById("formattedPrice");

        priceInput.addEventListener("input", function() {
            let value = this.value;
            value = parseFloat(value.replace(/[^\d]/g, ""));
            value = value.toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            });
            formattedPrice.textContent = value;
        });

        // quill editor
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='description']").value = quill.root.innerHTML;
        });

    </script>
@endsection
