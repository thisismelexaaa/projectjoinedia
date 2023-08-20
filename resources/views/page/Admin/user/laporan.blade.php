<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Joinedia - Laporan Event</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .table-data td {
            border-bottom: 1px solid black;
            text-transform: capitalize;
        }
    </style>

</head>

<body>
    <table width="100%">
        <tr>
            <td valign="top"><img src="assets/img/joinedia.png" alt="" width="150" /></td>
            <td align="right">
                <h3>Laporan User</h3>
                <pre>
                    Tanggal :
                    {{ \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y') }}
            </pre>
            </td>
        </tr>
    </table>

    <br />

    <table width="100%" class="table-data">
        <thead style="background-color: #3498db; color:white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Bio</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $users)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>
                        <span class="text-capitalize mx-3">
                            <p>{{ $users->name }}</p>
                        </span>
                    </td>
                    <td>{{ $users->username }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{!! $users->bio !!}</td>
                    <td>{{ $users->jurusan }}</td>
                    @if ($users->role == 'admin')
                        <td><span class="text-capitalize w-100 badge bg-primary">{{ $users->role }}</span>
                        </td>
                    @elseif ($users->role == 'superadmin')
                        <td><span class="text-capitalize w-100 badge bg-danger">{{ $users->role }}</span>
                        </td>
                    @else
                        <td><span class="text-capitalize w-100 badge bg-secondary">{{ $users->role }}</span>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" style="text-align:left">Total User</th>
                <th>{{ $countUser }}</th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
