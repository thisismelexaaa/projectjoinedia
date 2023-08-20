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
                <h3>Laporan Sponsor</h3>
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
                <th scope="col">Nama Sponsor</th>
                <th scope="col">Nama Event</th>
                <th scope="col">Description</th>
                <th scope="col">Kontrak Sponsor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sponsors as $sponsor)
                <tr>
                    <th class="align-baseline" scope="row">{{ $loop->iteration }}</th>
                    <td class="align-baseline">
                        {{-- <img src="assets/images/sponsors/{{ $sponsor->logo }}" height="125" alt=""> --}}
                        <span class="fw-bold">
                            {!! $sponsor->name !!}
                        </span>
                    </td>
                    <td class="align-baseline">{!! $sponsor->event->nama !!}</td>
                    <td class="align-baseline">{!! $sponsor->description !!}</td>
                    <td class="align-baseline">
                        {{ \Carbon\Carbon::parse($sponsor->start_date)->formatLocalized('%d %B %Y') }}
                        -
                        {{ \Carbon\Carbon::parse($sponsor->end_date)->formatLocalized('%d %B %Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{-- <tfoot>
            <tr>
                <th colspan="6" style="text-align:left">Total User</th>
                <th>{{ $countUser }}</th>
            </tr>
        </tfoot> --}}
    </table>

</body>

</html>
