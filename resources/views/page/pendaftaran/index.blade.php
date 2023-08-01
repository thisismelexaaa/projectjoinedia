@extends('layouts.app')

@section('content')
    <section class="card info-card sales-card">
        <div class="pagetitle p-3">
            <h1>Detail</h1>
        </div>
        <div class="row card-body">
            <div class="my-3 overflow-auto">
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
                        @foreach ($data as $item)
                            <tr>
                                <td class="align-baseline">{{ ++$i }}</td>
                                <td class="text-capitalize align-baseline fw-bold">
                                    <img src="{{ asset('assets/images/eventimage/' . $item->event->image) }}" height="125"
                                        alt="">
                                    {{ $item->event->nama }}
                                </td>
                                <td class="paymentlink" hidden>{{ $item->transaksi->payment_link }}</td>
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
                                <td class="text-capitalize align-baseline">{{ $item->status }}</td>
                                <td class="align-baseline">
                                    <div class="gap-3 d-flex">
                                        {{-- Kirim data ke modal --}}
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-id="{{ $item->id }}">
                                            <i class="bi bi-credit-card" data-bs-toggle="tooltip"
                                                data-bs-title="Pay Now"></i>
                                        </button>
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
            // Ketika tombol "Pay Now" diklik, ambil data dan isi ke dalam modal
            $('.btn-primary').on('click', function() {
                // Ambil data yang tersimpan dalam atribut data-id
                const id = $(this).data('id');
                const row = $(this).closest('tr');

                // Ambil data yang sesuai dari tabel
                const paymentLink = row.find('.paymentlink').text();

                // Isi data ke dalam modal
                $('#modalPaymentLink').attr('src', paymentLink);

                // Tampilkan modal setelah mengisi nilai-nilai
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
