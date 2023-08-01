@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if ($user->userimage == null)
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" alt="Profile" class="rounded-circle">
                        @else
<<<<<<< HEAD
<<<<<<< HEAD
                            <img src="{{ asset('assets/images/userimage/'. $user->userimage) }}" alt="Profile"
=======
                            <img src="{{ asset('storage/userimage/' . $user->userimage) }}" alt="Profile"
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                            <img src="{{ asset('assets/images/userimage/'. $user->userimage) }}" alt="Profile"
>>>>>>> 8019b8b (70% Progress)
                                class="rounded-circle">
                        @endif
                        <h2>{{ $user->name }}</h2>
                        <h3>
                            @if ($user->role == 'superadmin')
                                <span class="text-capitalize badge bg-danger">{{ $user->role }}</span>
                            @elseif ($user->role == 'admin')
                                <span class="text-capitalize badge bg-primary">{{ $user->role }}</span>
                                | {{ $user->jurusan }}
                            @else
                                <span class="text-capitalize badge bg-secondary">{{ $user->role }}</span>
                                | {{ $user->jurusan }}
                            @endif
                        </h3>
                        {{-- <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div> --}}
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Bio</h5>
                                <p class="small fst-italic">{!! $user->bio !!}</p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jurusan</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->jurusan }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Username</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->username }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{ route('user.update', $user->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" value="{{ $user->id }}" hidden>
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            @if ($user->userimage == null)
                                                <img id="output" src="{{ Avatar::create($user->name)->toBase64() }}"
                                                    alt="Profile">
                                            @else
<<<<<<< HEAD
<<<<<<< HEAD
                                                <img src="{{ asset('assets/images/userimage/' . $user->userimage) }}"
=======
                                                <img src="{{ asset('storage/userimage/' . $user->userimage) }}"
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
                                                <img src="{{ asset('assets/images/userimage/' . $user->userimage) }}"
>>>>>>> 8019b8b (70% Progress)
                                                    alt="Profile" id="output" class="rounded-circle">
                                            @endif

                                            <div class="pt-2">
                                                <div class="btn btn-primary btn-sm"
                                                    style="position: relative; overflow: hidden;"
                                                    title="Upload new profile image">
                                                    <input onchange="loadFile(event)" type="file" name="userimage"
                                                        id="photo" style="opacity: 0; position: absolute;">
                                                    <i class="bi bi-upload"></i>
                                                </div>

                                                <button onclick="deleteFile(event)" type="reset"
                                                    class="btn btn-danger btn-sm" title="Upload new profile image">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="username" type="text" class="form-control" id="username"
                                                value="{{ $user->username }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="bio" class="col-md-4 col-lg-3 col-form-label">Bio</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="my-3">
                                                <input type="hidden" name="bio" value="{{ $user->bio }}">
                                                <div id="editor">{!! $user->bio !!}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <input hidden name="password" type="password" class="form-control" id="password"
                                        value="{{ $user->password }}">
                                    <input hidden name="role" type="text" class="form-control" id="role"
                                        value="{{ $user->role }}">
                                    <input hidden name="email" type="email" class="form-control" id="email"
                                        value="{{ $user->email }}">


                                    @can('isSuperAdmin')
                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" type="text" class="form-control" id="username"
                                                    value="{{ $user->username }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="password"
                                                    value="{{ $user->password }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="role" type="text" class="form-control" id="role"
                                                    value="{{ $user->role }}">
                                            </div>
                                        </div>
                                    @elsecan('isAdmin')
                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" type="text" class="form-control" id="username"
                                                    value="{{ $user->username }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="password"
                                                    value="{{ $user->password }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="role" type="text" class="form-control" id="role"
                                                    value="{{ $user->role }}">
                                            </div>
                                        </div>
                                    @endcan

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
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

        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='bio']").value = quill.root.innerHTML;
        });

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        deleteFile = () => {
            document.getElementById('output').src = "{{ Avatar::create($user->name)->toBase64() }}";
            document.getElementById('file').value = "";
        }
    </script>
@endsection
