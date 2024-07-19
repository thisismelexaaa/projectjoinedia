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

        tfoot th{
            font-weight: bold;
            font-size: x-small;
            border-bottom: 1px solid black;
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
                <h3>Laporan Riwayat</h3>
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
                <th>Nama Event</th>
                <th>Kode Tiket</th>
                <th>Tanggal</th>
                <th>Type</th>
                <th>Status</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <input type="hidden" value="{{ $item->transaksi->payment_link }}" class="paymentlink">
                <tr>
                    <td class="align-baseline">{{ $loop->iteration }}</td>
                    <td class="text-capitalize align-baseline fw-bold">
                        {{ $item->event->nama }}
                    </td>
                    <td class="text-capitalize align-baseline">{{ $item->tiket }}</td>
                    <td class="align-baseline">
                        {{ \Carbon\Carbon::parse($item->event->start_date)->formatLocalized('%A, %d %B %Y') }}
                        -
                        {{ \Carbon\Carbon::parse($item->event->end_date)->formatLocalized('%A, %d %B %Y') }}
                    </td>
                    <td class="text-capitalize align-baseline">{{ $item->type }}</td>
                    <td class="text-capitalize align-baseline">{{ $item->status }}</td>
                    @if ($item->event->type == 'gratis')
                        <td class="align-baseline">Gratis</td>
                    @else
                        <td class="align-baseline">@currency($item->event->price)</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" style="text-align:left">Total</th>
                <th style="text-align:left">@currency($totalTransaksi)</th>
            </tr>
            <tr>
                <th colspan="6" style="text-align:left">Total Transaksi</th>
                <th  style="text-align:left">{{ $countRiwayat }}</th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
