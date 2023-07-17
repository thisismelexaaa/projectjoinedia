@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    {{-- List User --}}

    <style>
        .tbl-wrap {
            overflow-x: auto;
        }

        .table-container {
            position: relative;
            width: fit-content;
            /* Adjust as needed */
        }

        .table-container table {
            min-width: 100%;
            /* Ensure the table takes up the full width of the container */
        }

        .table-container .headcol {
            position: sticky;
            left: 0;
            z-index: 1;
            background-color: white;
            /* Adjust as needed */
        }
    </style>
    <div class="card info-card sales-card">
        <div class="card-body">
            <div class="card-title justify-content-between row me-2">
                <p class="col-md">List User</p>
                <div class="justify-content-end row gap-1 col-md">
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-success my-auto col-md-2">Add User</a>
                    @if (Auth::user()->role == 'superadmin')
                        <a href="{{ route('user.laporanuser') }}" class="btn btn-sm btn-primary my-auto col-md-2">Cetak
                            Laporan</a>
                    @endif
                </div>
            </div>
            <div class="overflow-auto tbl-wrap">
=======
    <div class="pagetitle">
        <h1>List User</h1>
    </div>
    {{-- List User --}}
    <div class="card info-card sales-card">
        <div class="card-body">
            <div class="card-title justify-content-between row">
                <p class="col-md">List User</p>
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary my-auto col-md-1">Add User</a>
            </div>
            <div class="overflow-auto ">
>>>>>>> f89a811 (First Commit : Progress 80%)
                <table
                    class="table table-borderless datatable table-hover table-responsive table-responsive-md table-responsive-lg table-responsive-sm d-block">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Bio</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Role</th>
<<<<<<< HEAD
                            <th class="headcol" scope="col">Action</th>
=======
                            <th scope="col">Action</th>
>>>>>>> f89a811 (First Commit : Progress 80%)
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Cek role user --}}
                        @if (Auth::user()->role == 'superadmin')
<<<<<<< HEAD
                            @foreach ($user as $users)
                                {{-- @dd($users) --}}
=======
                            @foreach ($dataUser as $users)
>>>>>>> f89a811 (First Commit : Progress 80%)
                                <tr>
                                    <th class="align-baseline" scope="row">{{ ++$i }}</th>
                                    <td class="align-baseline">
                                        @if ($users->userimage == null)
                                            <img style="width: 40px" src="{{ Avatar::create($users->name)->toBase64() }}"
                                                alt="Profile" class="rounded-circle">
                                        @else
<<<<<<< HEAD
                                            <img style="width: 40px" src="{{ asset($users->userimage) }}" alt="Profile"
=======
                                            <img style="width: 40px"
                                                src="{{ asset('storage/userimage/' . $users->userimage) }}" alt="Profile"
>>>>>>> f89a811 (First Commit : Progress 80%)
                                                class="rounded-circle">
                                        @endif
                                        <span class="text-capitalize mx-3">
                                            <a class="text-dark fw-bold"
                                                href="user/{{ $users->id }}">{{ $users->name }}</a>
                                        </span>
                                    </td>
                                    <td class="align-baseline">{{ $users->username }}</td>
                                    <td class="align-baseline">{{ $users->email }}</td>
                                    <td class="align-baseline">{!! $users->bio !!}</td>
                                    <td class="align-baseline">{{ $users->jurusan }}</td>
                                    @if ($users->role == 'admin')
                                        <td class="align-baseline"><span
                                                class="text-capitalize w-100 badge bg-primary">{{ $users->role }}</span>
                                        </td>
                                    @elseif ($users->role == 'superadmin')
                                        <td class="align-baseline"><span
                                                class="text-capitalize w-100 badge bg-danger">{{ $users->role }}</span>
                                        </td>
                                    @else
                                        <td class="align-baseline"><span
                                                class="text-capitalize w-100 badge bg-secondary">{{ $users->role }}</span>
                                        </td>
                                    @endif
                                    <td class="align-baseline">
                                        <div class="d-flex gap-3">
<<<<<<< HEAD
                                            <a href="{{ route('user.show', $users->id) }}" class="btn btn-sm btn-primary"
                                                data-bs-toggle="tooltip" data-bs-title="Show">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('user.edit', $users->id) }}" class="btn btn-sm btn-warning"
                                                data-bs-toggle="tooltip" data-bs-title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('user.destroy', $users->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="Javascript: return confirm('Apakah anda ingin menghapus data ini?')"
                                                    data-bs-toggle="tooltip" data-bs-title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
=======
                                            <a href="user/{{ $users->id }}" class="btn btn-sm btn-primary"
                                                data-bs-toggle="tooltip" data-bs-title="Show">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="/user/{{ $users->id }}/edit" class="btn btn-sm btn-warning"
                                                data-bs-toggle="tooltip" data-bs-title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                data-bs-title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </a>
>>>>>>> f89a811 (First Commit : Progress 80%)
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- Cek asal kampus user apakah sama dengan asal kampus admin maka tampilkan asalkampus yang sama --}}
<<<<<<< HEAD
=======

>>>>>>> f89a811 (First Commit : Progress 80%)
                            @foreach ($user as $users)
                                @if (Auth::user()->jurusan == $users->jurusan)
                                    <tr>
                                        <th class="align-baseline" scope="row">{{ ++$i }}</th>
                                        <td class="align-baseline">
<<<<<<< HEAD
                                            @if ($users->userimage == null)
                                                <img style="width: 40px"
                                                    src="{{ Avatar::create($users->name)->toBase64() }}" alt="Profile"
                                                    class="rounded-circle">
                                            @else
                                                <img style="width: 40px" src="{{ asset($users->userimage) }}"
                                                    alt="Profile" class="rounded-circle">
                                            @endif
                                            <a href="{{ route('user.show', $users->id) }}" class="text-dark fw-bold">
=======
                                            <img style="width: 40px"
                                                src="{{ Avatar::create($users->name)->toBase64() }}" />
                                            <a href="{{ route('user.show', $user->id) }}" class="text-dark fw-bold">
>>>>>>> f89a811 (First Commit : Progress 80%)
                                                <span class="text-capitalize mx-3">{{ $users->name }}</span>
                                            </a>
                                        </td>
                                        <td class="align-baseline">{{ $users->username }}</td>
                                        <td class="align-baseline">{{ $users->email }}</td>
<<<<<<< HEAD
                                        <td class="align-baseline">{!! $users->bio !!}</td>
=======
>>>>>>> f89a811 (First Commit : Progress 80%)
                                        <td class="align-baseline">{{ $users->jurusan }}</td>
                                        @if ($users->role == 'admin')
                                            <td class="align-baseline"><span
                                                    class="text-capitalize w-100 badge bg-primary">{{ $users->role }}</span>
                                            </td>
                                        @elseif ($users->role == 'superadmin')
                                            <td class="align-baseline"><span
                                                    class="text-capitalize w-100 badge bg-danger">{{ $users->role }}</span>
                                            </td>
                                        @else
                                            <td class="align-baseline"><span
                                                    class="text-capitalize w-100 badge bg-secondary">{{ $users->role }}</span>
                                            </td>
                                        @endif
                                        <td class="align-baseline">
                                            <div class="d-flex gap-3">
<<<<<<< HEAD
                                                <a href="{{ route('user.show', $users->id) }}"
=======
                                                <a href="{{ route('user.show', $user->id) }}"
>>>>>>> f89a811 (First Commit : Progress 80%)
                                                    class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                    data-bs-title="Show">
                                                    <i class="bi bi-eye"></i>
                                                </a>
<<<<<<< HEAD
                                                <a href="{{ route('user.edit', $users->id) }}"
=======
                                                <a href="{{ route('user.edit', $user->id) }}"
>>>>>>> f89a811 (First Commit : Progress 80%)
                                                    class="btn btn-sm btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
<<<<<<< HEAD
                                                <form action="{{ route('user.destroy', $users->id) }}" method="POST">
=======
                                                <form action="{{ route('user.destroy', $user->id) }}" method="post">
>>>>>>> f89a811 (First Commit : Progress 80%)
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="Javascript: return confirm('Apakah anda ingin menghapus data ini?')"
                                                        data-bs-toggle="tooltip" data-bs-title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
