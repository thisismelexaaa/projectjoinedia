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
            <form class="row g-3" method="POST" action="{{ route('sponsor.index') }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                {{-- Cek akun yang sedang login sekarang --}}
                <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                <div class="col-md-6 m-auto">
                    <div class="my-3">
                        <label for="nama" class="form-label">Nama Sponsor</label>
                        <input placeholder="Masukkan Nama Sponsor" value="{{ old('name') }}" name="name" type="text"
                            class="form-control" id="nama">
                    </div>
                    <div class="my-3 row">
                        <label class="form-label">Kontrak Sponsor</label>
                        <div class="col-6">
                            <label for="start_date" class="form-label">Dimulai</label>
                            <input placeholder="Masukkan Tanggal Event" value="{{ old('start_date') }}" name="start_date"
                                type="date" class="form-control" id="start_date">
                        </div>
                        <div class="col-6">
                            <label for="end_date" class="form-label">Berakhir</label>
                            <input placeholder="Masukkan Tanggal Event" value="{{ old('end_date') }}" name="end_date"
                                type="date" class="form-control" id="end_date">
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="description" class="form-label">Deskripsi Sponsor</label>
                        <input type="hidden" name="description" value="{{ old('description') }}">
                        <div id="editor">{!! old('description') !!}</div>
                    </div>
                    <div class="my-3">
                        <label for="poster" class="form-label">Logo Sponsor</label>
                        <input value="{{ old('logo') }}" name="logo" type="file" class="form-control"
                            id="poster">
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

        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='description']").value = quill.root.innerHTML;
        });
    </script>
@endsection
