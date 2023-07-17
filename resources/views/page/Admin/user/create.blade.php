@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Form Tambah Akun</h1>
    </div>
    <section class="py-5 card info-card sales-card ">
        <div class="card-body">
            {{-- <div class="h3 text-bold text-center">Form Tambah Akun</div> --}}
            @if ($errors->any())
                <div class="m-auto col-md-6">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-warning text-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="row g-3" method="POST" action="{{ route('user.index') }}">
                @method('POST')
                @csrf
                <div class="col-md-6 m-auto">
                    <div class="my-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input placeholder="Masukkan Nama Pengguna" name="name" type="text" class="form-control"
                            id="nama">
                    </div>
                    <div class="my-3 row">
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input placeholder="Masukkan Username Pengguna" name="username" type="text"
                                class="form-control" id="username">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input placeholder="Masukkan Email Pengguna" name="email" type="email" class="form-control"
                                id="email">
                        </div>

                    </div>

                    <div class="my-3">
                        @if (Auth::user()->role == 'superadmin')
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select">
                                <option selected disabled readonly>Pilih Jurusan</option>
                                <option disabled readonly class="text-secondary fw-bold">Fakultas Teknologi & Informasi
                                    (FTI)
                                </option>
                                <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
                                <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
                                <option value="S1 - Desain Komunikasi Visual">S1 - Desain Komunikasi Visual</option>
                                <option value="S1 - Manajemen Informatika">S1 - Manajemen Informatika</option>
                                <option value="D3 - Manajemen Informatika">D3 - Manajemen Informatika</option>
                                <option value="D3 - Komputerisasi Akutansi">D3 - Komputerisasi Akutansi</option>
                                <option disabled readonly class="text-secondary fw-bold">Fakultas Ekonomi & Bisnis (FEB)
                                </option>
                                <option value="S1 - Manajemen">S1 - Manajemen</option>
                                <option value="S1 - Akutansi">S1 - Akutansi</option>
                                <option value="D3 - Manajemen Bisnis">D3 - Manajemen Bisnis</option>
                            </select>
                        @else
                            <input type="hidden" name="jurusan" value="{{ Auth::user()->jurusan }}" id="jurusan"
                                class="form-select">
                        @endif
                    </div>

                    <div class="my-3">
                        <label for="password" class="form-label">Password</label>
                        <input placeholder="Masukkan Password Pengguna" name="password" type="password" class="form-control"
                            id="password">
                    </div>

                    <div class="my-3">
                        <label for="role" class="form-label">Role</label>
                        @if (Auth::user()->role == 'superadmin')
                            <select name="role" id="role" class="form-select">
                                <option selected="">Pilih salah Satu</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        @else
                            <input class="form-control text-capitalize" name="role" readonly value="user">
                        @endif
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
