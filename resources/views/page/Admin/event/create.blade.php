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
            <form class="row g-3" method="POST" action="{{ route('be.store') }}" enctype="multipart/form-data">
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
                    <div class="my-3">
                        <label class="form-label">Berapa Hari Pelaksanaan Event</label>
                        <input placeholder="Masukkan Lama waktu Event" value="{{ old('hari') }}" name="hari" type="text"
                            class="form-control" id="hari">
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
                        {{-- <div class="col">
                            <select name="organizer" id="penyelenggara" class="form-select">
                                <option selected value="{{ old('organizer') }}">Pilih Salah Satu</option>
                                <optgroup label="- FTI - Fakultas Teknologi & Informasi -">
                                    <option value="Fakultas Teknologi & Informasi">Fakultas Teknologi & Informasi</option>
                                    <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
                                    <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
                                    <option value="S1 - Desain Komunikasi Visual">S1 - Desain Komunikasi Visual</option>
                                    <option value="D3 - Manajemen Informatika">D3 - Manajemen Informatika</option>
                                    <option value="D3 - Komputerisasi Akutansi">D3 - Komputerisasi Akutansi</option>
                                </optgroup>
                                <optgroup label="- FEB - Fakultas Ekonomi Bisnis -">
                                    <option value="Fakultas Ekonomi Bisnis">Fakultas Ekonomi Bisnis</option>
                                    <option value="S1 - Manajemen">S1 - Manajemen</option>
                                    <option value="S1 - Akuntansi">S1 - Akuntansi</option>
                                    <option value="D3 - Manajemen Bisnis">D3 - Manajemen Bisnis</option>
                                </optgroup>
                                <optgroup label="- HIMA -">
                                    <option value="HIMASI">HIMASI</option>
                                    <option value="HIMATIF">HIMATIF</option>
                                    <option value="HIMAMI">HIMAMI</option>
                                    <option value="HIMAKA">HIMAKA</option>
                                    <option value="HIMADKV">HIMADKV</option>
                                    <option value="HIMABIS">HIMABIS</option>
                                    <option value="HIMAKU">HIMAKU</option>
                                    <option value="HIMAJEMEN">HIMAJEMEN</option>
                                </optgroup>
                                <optgroup label="- UKM -">
                                    <option value="UKM ESPORTS">UKM ESPORTS</option>
                                    <option value="UKM ARTOGRAFI">UKM ARTOGRAFI</option>
                                    <option value="UKM OLAHRAGA">UKM OLAHRAGA</option>
                                    <option value="UKM MUSIK">UKM MUSIK</option>
                                    <option value="UKM NUSANTARI">UKM NUSANTARI</option>
                                    <option value="UKM IPTEK">UKM IPTEK</option>
                                </optgroup>
                                <optgroup label="- LAINNYA - ">
                                    <option value="">BKM</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Berkerja Sama Dengan</label>
                            <input placeholder="Masukkan Penyelenggara Event" name="organizer" type="text"
                                class="form-control" id="penyelenggara" value='{{ old('organizer') }}'>
                        </div> --}}
                        <input placeholder="Masukkan Penyelenggara Event" name="organizer" type="text"
                            class="form-control" id="penyelenggara" value='{{ old('organizer') }}'>
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
                    </div>
                    <div class="my-3 row">
                        <div class="col">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option selected value="aktif">Pilih Salah Satu</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="kategori" class="form-label">Kategori Event</label>
                            <select class="form-select" name="kategori" id="eventkategori">
                                <option selected value="aktif">Pilih Salah Satu</option>
                                <option value="akademik">Akademik</option>
                                <option value="non-akademik">Non-Akademik</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label" for="kuota">Kuota</label>
                            <input type="number" name="kuota" class="form-control" placeholder="Masukkan Kuota 1-150"
                                max="150" min="1">
                            <small class="form-label text-danger" for="kuota">*Default & max adalah 150</small>
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

                    {{-- Sponsor --}}
                    <div class="my-3 bg-light p-3 rounded border" id="sponsors" hidden>
                        <span>Data Sponsor</span>
                        <div id="added_sponsor"></div>
                        <button type="button" class="btn btn-sm col-3 btn-primary my-3" id="addSponsor">
                            Tambah Sponsor
                        </button>
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

        document.addEventListener("DOMContentLoaded", function() {
            const addSponsorButton = document.getElementById("addSponsor");
            const sponsorsContainer = document.getElementById("sponsors");
            const AddedSponsorsContainer = document.getElementById("added_sponsor");

            let sponsorCount = 1;

            addSponsorButton.addEventListener("click", function() {
                const sponsorTemplate = `
                <div class="my-3 bg-light p-3 rounded border">
                    <input type="hidden" name="number_of_sponsors" value="${sponsorCount}">
                    <div class="row">
                        <div class="col">
                            <label for="sponsor${sponsorCount}" class="form-label">Sponsor ${sponsorCount}</label>
                            <input placeholder="Masukkan Sponsor" name="sponsor_name${sponsorCount}" type="text"
                                class="form-control" id="sponsor${sponsorCount}" value="{{ old('sponsor_name') }}">
                        </div>
                        <div class="col">
                            <label for="logo${sponsorCount}" class="form-label">Logo Sponsor</label>
                            <input value="{{ old('logo') }}" name="sponsor_logo${sponsorCount}" type="file"
                                class="form-control" id="logo${sponsorCount}">
                        </div>
                    </div>
                    <div class="col my-3">
                        <label for="deskripsiSponsor${sponsorCount}" class="form-label">Deskripsi Sponsor</label>
                        <textarea class="form-control" name="deskripsiSponsor${sponsorCount}" rows="5">{{ old('deskripsiSponsor') }}</textarea>
                    </div>
                </div>
            `;

                const sponsorDiv = document.createElement("div");
                sponsorDiv.innerHTML = sponsorTemplate;

                AddedSponsorsContainer.appendChild(sponsorDiv);
                sponsorCount++;
            });
        });
    </script>
@endsection
