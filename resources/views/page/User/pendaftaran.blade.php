@extends('layouts.app')

@section('content')
    <section class="card info-card sales-card">
        <div class="pagetitle p-3">
            <h1>Pendaftaran</h1>
        </div>
        <div class="row card-body">
            <div class="">
                <hr class="w-50 m-auto">
                <p class="text-center my-1 fw-bold">Detail Event</p>
                <hr class="w-50 m-auto">
            </div>
            <div class="my-3 overflow-auto">
                <table class="m-auto w-50">
                    <tbody>
                        <tr>
                            <th>Nama Event</th>
                            <td>:</td>
                            <td class="text-capitalize"><input disabled type="text" class="form-control"
                                    value="{{ $data->nama }}"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pelaksanaan</th>
                            <td>:</td>
                            @if ($data->start_date != null)
                                <td class="text-capitalize"><input disabled type="text" class="form-control"
                                        value="Tidak Ada Jadwal">
                                </td>
                            @else
                                <td class="text-capitalize"><input disabled type="text" class="form-control"
                                        value="{{ $data->start_date . ' - ' . $data->end_date }}"></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Type Event</th>
                            <td>:</td>
                            <td class="text-capitalize"><input disabled type="text" class="form-control text-capitalize"
                                    value="{{ $data->type }} | @currency($data->price)"></td>
                        </tr>
                        <tr>
                            <th>Status Event</th>
                            <td>:</td>
                            <td class="text-capitalize"><input disabled type="text" class="form-control text-capitalize"
                                    value="{{ $data->status }}"></td>
                        </tr>
                        <tr>
                            <th>Organizer Event</th>
                            <td>:</td>
                            <td class="text-capitalize"><input disabled type="text" class="form-control text-capitalize"
                                    value="{{ $data->organizer }}"></td>
                        </tr>
                        <tr>
                            <th>Kategori Event</th>
                            <td>:</td>
                            <td class="text-capitalize"><input disabled type="text" class="form-control text-capitalize"
                                    value="{{ $data->kategori }}"></td>
                        </tr>
                        <tr>
                            <th>Lokasi Event</th>
                            <td>:</td>
                            <td class="text-capitalize"><input disabled type="text" class="form-control text-capitalize"
                                    value="{{ $data->location }}"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                <hr class="w-50 m-auto">
                <p class="text-center my-1 fw-bold">Detail Pendaftar</p>
                <hr class="w-50 m-auto">
            </div>
            <div class="row m-auto">
                <div class="col-md-6 m-auto col">
                    <form action="{{ route('riwayat.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="event_id" value="{{ $data->id }}">
                        <div class="form-floating mb-3">
                            <input type="text" name="nama" class="form-control" id="floatingInput"
                                value="{{ Auth::user()->name }}">
                            <label for="floatingInput">Nama</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" placeholder="Username"
                                        value="{{ Auth::user()->username }}">
                                    <label for="floatingInput">Username</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="floatingInputGroup2"
                                            placeholder="Email" required value="{{ Auth::user()->email }}">
                                        <label for="floatingInputGroup2">Email</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" name="type" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="peserta" selected>Pilih Salah Satu</option>
                                <option value="peserta">Peserta</option>
                                <option value="volunteer">Volunteer</option>
                            </select>
                            <i class="text-danger fw-light">*Jika Tidak Di Pilih Maka Defaultnya Adalah Peserta</i>
                            <label for="floatingSelect">Mendaftar Sebagai</label>
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
                        </div>
                    </form>
                </div>
            </div>
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
    </script>
@endsection
