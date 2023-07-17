@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Form Edit Event</h1>
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
<<<<<<< HEAD
            <form class="row g-3" id="editForm" method="POST" action="{{ route('be.update', $event->id) }}"
                enctype="multipart/form-data">
=======
            <form class="row g-3" method="POST" action="{{ route('event.update', $event->id) }}" enctype="multipart/form-data">
>>>>>>> f89a811 (First Commit : Progress 80%)
                @csrf
                @method('PUT')
                <input type="text" name="user_id" id="" value="{{ $event->user_id }}" hidden>
                <input type="text" value="{{ $event->id }}" hidden>
                <div class="col-md-6 m-auto">
                    <div class="my-3">
<<<<<<< HEAD
                        <label for="nama" class="form-label">Nama Event</label>
                        <input value="{{ $event->nama }}" name="nama" type="text" class="form-control"
                            id="nama">
                    </div>
                    <div class="my-3 row">
                        <label for="start_date" class="form-label">Tanggal Pelaksanaan Event</label>
                        <div class="col d-flex">
                            <span class="m-auto" for="">Dimulai : &nbsp;&nbsp;&nbsp;</span>
                            <input value="{{ $event->start_date }}" name="start_date" type="datetime-local"
                                class="form-control col" id="start_date">
                        </div>
                        <div class="col d-flex">
                            <span class="m-auto">Berakhir : &nbsp;&nbsp;&nbsp;</span>
                            <input value="{{ $event->end_date }}" name="end_date" type="datetime-local"
                                class="form-control col" id="end_date">
                        </div>
=======
                        <label for="eventname" class="form-label">Nama Event</label>
                        <input value="{{ $event->eventname }}" name="eventname" type="text" class="form-control"
                            id="eventname">
                    </div>
                    <div class="my-3">
                        <label for="eventdate" class="form-label">Tanggal</label>
                        <input value="{{ $event->eventdate }}" name="eventdate" type="datetime-local" class="form-control"
                            id="eventdate">
>>>>>>> f89a811 (First Commit : Progress 80%)
                    </div>

                    <div class="my-3">
                        <label for="tempat" class="form-label">Tempat</label>
<<<<<<< HEAD
                        <input placeholder="Masukkan Tempat Event" name="location" type="text" class="form-control"
                            id="tempat" value="{{ $event->location }}">
=======
                        <input placeholder="Masukkan Tempat Event" name="eventlocation" type="text" class="form-control"
                            id="tempat" value="{{ $event->eventlocation }}">
>>>>>>> f89a811 (First Commit : Progress 80%)
                    </div>
                    <div class="my-3 row">
                        <div class="col">
                            <label for="type" class="form-label">Type</label>
<<<<<<< HEAD
                            <select class="form-select" id="type" name="type" onchange="handleTypeChange(this)">
                                <option value="gratis" {{ $event->type == 'gratis' ? 'selected' : '' }}>Gratis</option>
                                <option value="berbayar" {{ $event->type == 'berbayar' ? 'selected' : '' }}>Berbayar
                                </option>
                                <!-- tambahkan opsi lain jika diperlukan -->
=======
                            <select class="form-select text-capitalize" name="eventtype" id="type">
                                <option value="{{ $event->eventtype }}" selected>{{ $event->eventtype }}</option>
                                @if ($event->eventtype == 'gratis')
                                    <option value="berbayar">Berbayar</option>
                                @else
                                    <option value="gratis">Gratis</option>
                                @endif
>>>>>>> f89a811 (First Commit : Progress 80%)
                            </select>
                        </div>

                        <div class="col">
<<<<<<< HEAD
                            <label for="price" class="form-label d-flex justify-content-between">
                                <span class="">Harga Event</span>
                                <span id="formattedPrice" class="form-text">@currency($event->price)</span>
                            </label>
                            <input readonly placeholder="Masukkan Type Event Dahulu" type="number" class="form-control"
                                id="price1" hidden>

                            <input readonly placeholder="Masukkan Type Event Dahulu" name="price" type="number"
                                class="form-control" id="price" value="{{ $event->price }}">
=======
                            <label for="eventprice" class="form-label">Harga Event</label>
                            <input readonly placeholder="Masukkan Type Event Dahulu" type="number" class="form-control"
                                id="eventprice1" hidden>

                            <input readonly placeholder="Masukkan Type Event Dahulu" name="eventprice" type="number"
                                class="form-control" id="eventprice" value="{{ $event->eventprice }}">
>>>>>>> f89a811 (First Commit : Progress 80%)
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
<<<<<<< HEAD
                        <input placeholder="Masukkan Penyelenggara Event" name="organizer" type="text"
                            class="form-control price" id="penyelenggara" value="{{ $event->organizer }}">
                        <div class="d-flex gap-2 mt-2">
                            <label for="">Level :</label>
                            <div class="form-check">
                                <input type="radio" value="universitas" checked name="level" id="leveluniv"
                                    class="form-check-input">
                                <label for="leveluniv" form-check-label>Universitas</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" value="fakultas" name="level" id="levelfak"
                                    class="form-check-input">
                                <label for="levelfak" class="form-check-label">Fakultas</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" value="prodi" name="level" id="levelprod"
                                    class="form-check-input">
                                <label for="levelprod" class="form-check-label">Prodi</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" value="bkm" name="level" id="levelbkm"
                                    class="form-check-input">
                                <label for="levelbkm" class="form-check-label">Bkm</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" value="hima" name="level" id="levelhim"
                                    class="form-check-input">
                                <label for="levelhim" class="form-check-label">Hima</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" value="ukm" name="level" id="levelukm"
                                    class="form-check-input">
                                <label for="levelukm" class="form-check-label">Ukm</label>
                            </div>
                        </div>
=======
                        <input placeholder="Masukkan Penyelenggara Event" name="eventorganizer" type="text"
                            class="form-control eventprice" id="penyelenggara" value="{{ $event->eventorganizer }}">
>>>>>>> f89a811 (First Commit : Progress 80%)
                    </div>
                    <div class="my-3 row">
                        <div class="col">
                            <label for="status" class="form-label">Status</label>
<<<<<<< HEAD
                            <select class="form-select text-capitalize" name="status" id="status">
                                <option value="{{ $event->status }}" selected>{{ $event->status }}
                                </option>
                                @if ($event->status == 'aktif')
                                    <option value="selesai">Selesai</option>
                                @elseif($event->status == 'selesai')
=======
                            <select class="form-select text-capitalize" name="eventstatus" id="status">
                                <option value="{{ $event->eventstatus }}" selected>{{ $event->eventstatus }}
                                </option>
                                @if ($event->eventstatus == 'aktif')
                                    <option value="selesai">Selesai</option>
                                @elseif($event->eventstatus == 'selesai')
>>>>>>> f89a811 (First Commit : Progress 80%)
                                    <option value="aktif">Aktif</option>
                                @endif
                            </select>
                        </div>
                        <div class="col">
<<<<<<< HEAD
                            <label for="kategori" class="form-label">Kategori Event</label>
                            <select class="form-select text-capitalize" name="kategori" id="kategori">
                                <option selected value="{{ $event->kategori }}">{{ $event->kategori }}</option>
                                @if ($event->kategori == 'akademik')
=======
                            <label for="eventkategori" class="form-label">Kategori Event</label>
                            <select class="form-select text-capitalize" name="eventkategori" id="eventkategori">
                                <option selected value="{{ $event->eventkategori }}">{{ $event->eventkategori }}</option>
                                @if ($event->eventkategori == 'akademik')
>>>>>>> f89a811 (First Commit : Progress 80%)
                                    <option value="non-akademik">Non-Akademik</option>
                                @else
                                    <option value="akademik">Akademik</option>
                                @endif
                            </select>
                        </div>
<<<<<<< HEAD
                        <div class="col">
                            <label class="form-label" for="kuota">Kuota</label>
                            <input type="number" name="kuota" class="form-control" placeholder="Masukkan Kuota 1-150"
                                max="150" min="1" value="{{ $event->kuota }}">
                            <small class="form-label text-danger" for="kuota">*Default & max adalah 150</small>
                        </div>
                    </div>

                    <div>
                        <input type="hidden" name="description" value="{{ $event->description }}">
                        <div id="editor">{!! $event->description !!}</div>
                    </div>
                    <div class="my-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input name="image" type="file" class="form-control" id="poster">
                        <span class="text-danger fs-6 fst-italic">"Ukuran Poster minimal 500x500"
                        </span>
                    </div>
                    <div class="my-3">
                        <input class="form-check-input sponsorCheck" type="checkbox" id="sponsorCheck">
                        <label class="form-check-label" for="sponsorCheck">
                            Event Ini Memiliki Sponsor
                        </label>
                    </div>
                    {{-- Sponsor --}}
                    <div class="my-3 bg-light p-3 rounded border" id="sponsors" hidden>
                        <span>Data Sponsor</span>
                        <div id="added_sponsor">
                            <!-- Tampilkan sponsor yang ada (jika ada) -->
                            @foreach ($sponsor as $sponsor)
                                <div class="my-3 bg-light p-3 rounded border">
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="sponsors[{{ $loop->index }}][id]"
                                                value="{{ $sponsor->id }}">
                                            <label for="sponsor_name{{ $loop->index }}" class="form-label">Sponsor
                                                {{ $loop->index + 1 }}</label>
                                            <input placeholder="Masukkan Sponsor"
                                                name="sponsors[{{ $loop->index }}][name]" type="text"
                                                class="form-control" id="sponsor_name{{ $loop->index }}"
                                                value="{{ $sponsor->name }}">
                                        </div>
                                        <div class="col">
                                            <label for="sponsor_logo{{ $loop->index }}" class="form-label">Logo
                                                Sponsor</label>
                                            <input name="sponsors[{{ $loop->index }}][logo]" type="file"
                                                class="form-control" id="sponsor_logo{{ $loop->index }}">
                                        </div>
                                    </div>
                                    <div class="col my-3">
                                        <label for="deskripsiSponsor{{ $loop->index }}" class="form-label">Deskripsi
                                            Sponsor</label>
                                        <textarea type="text" class="form-control" name="sponsors[{{ $loop->index }}][description]"
                                            value="{{ $sponsor->description }}">{!! $sponsor->description !!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm col-3 btn-primary my-3" id="addSponsor">
                            Tambah Sponsor
                        </button>
                    </div>
=======
                    </div>

                    <div>
                        <input type="hidden" name="eventdescription" value="{{ $event->eventdescription }}">
                        <div id="editor">{!! $event->eventdescription !!}</div>
                    </div>

                    <div class="my-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input name="eventimage" type="file" class="form-control" id="poster">
                        <span class="text-danger fs-6 fst-italic">"Ukuran Poster minimal 500x500"
                        </span>
                    </div>

>>>>>>> f89a811 (First Commit : Progress 80%)
                    <div class="form-check my-3">
                        <input class="form-check-input gridCheck" name="gridCheck" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
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

<<<<<<< HEAD
        // check checklist
        var elems = document.querySelectorAll('.sponsorCheck');

        [].forEach.call(elems, function(el) {
            el.addEventListener('change', function() {
                var checked = document.querySelectorAll('.sponsorCheck:checked');
                if (checked.length) {
                    document.getElementById("sponsors").hidden = false;
                } else {
                    document.getElementById("sponsors").hidden = true;
=======
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
                        document.getElementById("eventprice").value = "{{ $event->eventprice }}";

                    } else {
                        document.getElementById("eventprice1").hidden = false;
                        document.getElementById("eventprice1").placeholder = "Pilih Type Event";
                        document.getElementById("eventprice1").value = "gratis";

                        document.getElementById("eventprice").hidden = true;
                        document.getElementById("eventprice").readOnly = true;
                        document.getElementById("eventprice").value = 0;
                    }
>>>>>>> f89a811 (First Commit : Progress 80%)
                }
            });
        });

<<<<<<< HEAD
        document.addEventListener("DOMContentLoaded", function() {
            const addSponsorButton = document.getElementById("addSponsor");
            const addedSponsorsContainer = document.getElementById("added_sponsor");
            let sponsorCount = 1
            {{ $countSponsor }}; // Set sponsorCount berdasarkan jumlah sponsor yang sudah ada


            addSponsorButton.addEventListener("click", function() {
                const sponsorTemplate = `
                <div class="my-3 bg-light p-3 rounded border">
                    <input type="hidden" name="sponsors[${sponsorCount}][id]" value="">
                    <div class="row">
                        <div class="col">
                            <label for="sponsor_name${sponsorCount}" class="form-label">Sponsor ${sponsorCount}</label>
                            <input placeholder="Masukkan Sponsor" name="sponsors[${sponsorCount}][name]" type="text" class="form-control" id="sponsor_name${sponsorCount}" value="">
                        </div>
                        <div class="col">
                            <label for="sponsor_logo${sponsorCount}" class="form-label">Logo Sponsor</label>
                            <input name="sponsors[${sponsorCount}][logo]" type="file" class="form-control" id="sponsor_logo${sponsorCount}">
                        </div>
                    </div>
                    <div class="col my-3">
                        <label for="deskripsiSponsor${sponsorCount}" class="form-label">Deskripsi Sponsor</label>
                        <textarea class="form-control" name="sponsors[${sponsorCount}][description]" rows="5">{{ old('deskripsiSponsor') }}</textarea>
                    </div>
                </div>
                `;

                const sponsorDiv = document.createElement("div");
                sponsorDiv.innerHTML = sponsorTemplate;

                addedSponsorsContainer.appendChild(sponsorDiv);
                sponsorCount++;
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
                priceInput.value = "{{ $event->price }}";

                priceInputHidden.hidden = false;
                priceInputHidden.readOnly = false;
                priceInputHidden.value = "{{ $event->price }}";
            } else {
                priceInput.hidden = false;
                priceInput.placeholder = "Masukkan Type Event Dahulu";
                priceInput.value = "Masukkan Type Event Dahulu";

                priceInputHidden.hidden = true;
                priceInputHidden.readOnly = true;
                priceInputHidden.value = 0;
            }
        }

        // Format input angka menjadi nominal uang
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

        // Panggil fungsi handleTypeChange saat halaman di-load
        handleTypeChange(document.getElementById("type"));

        // quill editor
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        var quill2 = new Quill('#editorSponsor', {
            theme: 'snow'
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='description']").value = quill.root.innerHTML;
        });
        quill2.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='deskripsiSponsor']").value = quill2.root.innerHTML;
=======
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='eventdescription']").value = quill.root.innerHTML;
>>>>>>> f89a811 (First Commit : Progress 80%)
        });
    </script>
@endsection
