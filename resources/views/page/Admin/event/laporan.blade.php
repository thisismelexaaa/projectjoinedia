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
            php artisan serve<td valign="top"><img src="assets/img/joinedia.png" alt="" width="150" /></td>
            <td align="right">
                <h3>Laporan Event</h3>
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
                <th>#</th>
                <th>Name</th>
                <th>Date</th>
                <th>Type</th>
                <th>Kategori</th>
                <th>Penyelenggara</th>
                <th>Tempat</th>
                <th>Harga</th>
                <th>Uploaded By</th>
                <th>Description</th>
                <th>Sponsor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataEvent as $event)
                <tr>
                    <td class="align-baseline">{{ $loop->iteration }}</td>
                    <td class="align-baseline">
                        <p class="text-decoration-none text-dark fw-bold">
                            {{ Str::limit($event->nama, 25) }}
                        </p>
                    </td>
                    <td class="align-baseline date-cell">
                        {{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }}
                        <span><br>s/d<br></span>
                        {{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}

                    </td>
                    <td class="text-capitalize align-baseline">{{ $event->type }}</td>
                    <td class="text-capitalize align-baseline">
                        {{ $event->kategori }}</td>
                    <td class="align-baseline">{{ $event->organizer }}</td>
                    <td class="align-baseline">{{ $event->location }}</td>
                    <td class="align-baseline">@currency($event->price)</td>
                    <td class="align-baseline text-capitalize">{{ $event->user->name }}</td>
                    <td class="align-baseline">
                        <span class="">{!! Str::limit($event->description, 75) !!}</span>
                    </td>
                    {{-- Null safety --}}
                    @if ($event->sponsor == null)
                        <td class="align-baseline">Tidak Ada Sponsor</td>
                    @else
                        <td class="align-baseline text-capitalize">
                            @foreach ($event->sponsor as $item)
                                {{ $item->name }},
                            @endforeach
                        </td>
                    @endif
                    @if ($event->status == 'aktif' || $event->status == 'Aktif')
                        <td class="align-baseline"><span
                                class="text-capitalize badge w-100 bg-success">{{ $event->status }}</span>
                        </td>
                    @elseif ($event->status == 'berjalan' || $event->status == 'Berjalan')
                        <td class="align-baseline"><span
                                class="text-capitalize badge w-100 bg-primary">{{ $event->status }}</span>
                        </td>
                    @else
                        <td class="align-baseline"><span
                                class="text-capitalize badge w-100 bg-danger">{{ $event->status }}</span>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="11" style="text-align: left">Total Event</th>
                <th>{{ $eventCount }}</th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
