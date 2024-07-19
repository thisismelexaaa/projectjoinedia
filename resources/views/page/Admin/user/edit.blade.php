@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Form Edit Akun</h1>
    </div>
    <section class="py-5 card info-card sales-card ">
        <div class="card-body">
            {{-- <div class="h3 text-bold text-center">Form Edit Akun</div> --}}
            @if ($errors->any())
                <div class="m-auto col-md-6">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-warning text-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="row g-3" method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PUT')
                {{-- @dd($dataUser['id']) --}}
                <input type="text" value="{{ $user->id }}" hidden>
                <div class="col-md-6 m-auto">
                    <div class="my-3">
                        <label for="inputName5" class="form-label">Nama</label>
                        <input value="{{ $user->name }}" name="name" type="text" class="form-control"
                            id="inputName5">
                    </div>
                    <div class="my-3 row">
                        <div class="col">
                            <label for="inputName5" class="form-label">Username</label>
                            <input value="{{ $user->username }}" name="username" type="text" class="form-control"
                                id="inputName5">
                        </div>
                        <div class="col">
                            <label for="inputEmail5" class="form-label ">Email</label>
                            <input value="{{ $user->email }}" name="email" type="email" class="form-control "
                                id="inputEmail5">
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-select">
                            <option selected disabled readonly>{{ $user->jurusan }}</option>
                            <option disabled readonly class="text-secondary fw-bold">Fakultas Teknologi & Informasi (FTI)
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
                    </div>

                    <div class="my-3">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input value="{{ $user->password }}" name="password" type="password" class="form-control"
                            id="inputPassword5">
                    </div>

                    <div class="my-3">
                        <label for="inputState" class="form-label">Role</label>
                        <select name="role" id="inputState" class="form-select text-capitalize">
                            <option value="{{ $user->role }}" selected="{{ $user->role }}"> Role Sekarang :
                                {{ $user->role }}</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div>
                        <input type="hidden" name="bio" value="{{ $user->bio }}">
                        <div id="editor">{!! $user->bio !!}</div>
                    </div>

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
@endsection

@section('scripts')
    <script>
        window.addEventListener('keydown', function(e) {
            if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
                if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
                    e.preventDefault();
                    return false;
                }
            }
        }, true);

        // check checklist
        var elems = document.querySelectorAll('.gridCheck');
        var btn = document.querySelector('.buttonSubmit');
        [].forEach.call(elems, function(el) {
            el.addEventListener('change', function() {
                var checked = document.querySelectorAll('.gridCheck:checked');
                if (checked.length !== elems.length) {
                    document.getElementById("buttonSubmit").classList.add('disabled');
                } else {
                    document.getElementById("buttonSubmit").classList.remove('disabled');
                }
            });
        });

        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='bio']").value = quill.root.innerHTML;
        });
    </script>
@endsection
