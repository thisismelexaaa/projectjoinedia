@extends('layouts.app')

@section('content')
    <section class="card info-card sales-card">
        <div class="pagetitle p-3">
            <div class="row justify-between card-title me-2">
                <p class="col-md">Riwayat Transaksi</p>
                @if (Auth::user()->role == 'superadmin')
                    <a href="{{ route('riwayat.laporanriwayat') }}" class="btn btn-sm btn-primary my-auto col-md-2">Cetak
                        Laporan</a>
                @endif
            </div>
        </div>
        <div class="row card-body">
            <div class="overflow-auto">
                <table class="datatable table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Event</th>
                            <th>Kode Tiket</th>
                            <th>Tanggal</th>
                            <th>Type</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Jika event_id tidak cocok maka tampilkan teks kosong --}}
                        @foreach ($data as $item)
                            {{-- @dd($item) --}}
                            @if ($item->event == null)
                                {{ $item->event }}
                                @continue
                                {{-- @break --}}
                            @else
                                <tr>
                                    <td hidden class="paymentlink" id="paymentlink">{{ $item->transaksi->payment_link }}</td>
                                    <td class="align-baseline">{{ ++$i }}</td>
                                    <td class="text-capitalize align-baseline fw-bold">
                                        @if ($item->event->image == null)
                                            <span>No Image</span>
                                        @else
                                            <img src="{{ asset('assets/images/eventimage/' . $item->event->image) }}"
                                                height="125" alt="">
                                        @endif
                                        {{ $item->event->name }}
                                    </td>
                                    <td class="text-capitalize align-baseline">{{ $item->tiket }}</td>
                                    <td class="align-baseline">
                                        {{ \Carbon\Carbon::parse($item->event->start_date)->formatLocalized('%A, %d %B %Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->event->end_date)->formatLocalized('%A, %d %B %Y') }}
                                    </td>
                                    <td class="text-capitalize align-baseline">{{ $item->type }}</td>
                                    @if ($item->event->type == 'gratis')
                                        <td class="align-baseline">Gratis</td>
                                    @else
                                        <td class="align-baseline">@currency($item->event->price)</td>
                                    @endif

                                    @if ($item->status == 'unpaid')
                                        <td class="text-capitalize align-baseline">
                                            <span class="badge bg-danger">{{ $item->status }}</span>
                                        </td>
                                    @elseif($item->status == 'paid')
                                        <td class="text-capitalize align-baseline">
                                            <span class="badge bg-success">{{ $item->status }}</span>
                                        </td>
                                    @endif
                                    <td class="align-baseline">
                                        <div class="gap-3 d-flex">
                                            {{-- <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-id="{{ $item->id }}">
                                            <i class="bi bi-credit-card" data-bs-toggle="tooltip"
                                                data-bs-title="Pay Now"></i>
                                        </a> --}}

                                            {{-- Kirim data ke modal --}}
                                            @can('isUser')
                                                @if ($item->status == 'unpaid')
                                                    <button class="btn btn-sm btn-success paynow" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" data-id="{{ $item->id }}">
                                                        <i class="bi bi-credit-card" data-bs-toggle="tooltip"
                                                            data-bs-title="Pay Now"></i>
                                                    </button>
                                                @endif
                                            @endcan
                                            <form action="{{ route('riwayat.destroy', $item->id) }}" method="post">
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
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="modalPaymentLink" src="" frameborder="0" class="w-100"
                        style="height: 750px"></iframe>
                </div>
                <div class="modal-footer">
                    <button id="closedButton" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        $(document).ready(function() {
            $('.paynow').on('click', function() {
                var paymentLinkValue = $(this).closest('tr').find('#paymentlink')
                    .text(); // Menggunakan .text() untuk mengambil teks dari <td>
                console.log('Payment Link Value:', paymentLinkValue); // Tampilkan nilai di console

                $('#modalPaymentLink').attr('src', paymentLinkValue);
                console.log('Modal Payment Link:', paymentLinkValue); // Tampilkan nilai di console

                $('#exampleModal').modal('show');
            });
        });

        function reloadPage() {
            location.reload();
        }

        // Tambahkan event listener pada tombol reload
        var reloadButton = document.getElementById("closedButton");
        reloadButton.addEventListener("click", reloadPage);
    </script>
@endsection
