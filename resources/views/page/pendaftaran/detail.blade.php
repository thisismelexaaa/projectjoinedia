@extends('layouts.app')

@section('content')
    <div class="hv-100">
        <div class="pagetitle">
            <h1>Detail Pembayaran</h1>
        </div>
        <section class="card info-card sales-card">
            <div class="row g-0 card-body">
                {{-- <div class="col-3 mt-4">
                    <a class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img class="img-fluid w-full" style="width:1080px;height:500px;"
                            src="/storage/eventimage/{{ $item->event->eventimage }}" alt="..." />
                    </a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="m-auto">
                                        <img class="img-fluid w-full" style="width:500px;height:600px;"
                                            src="/storage/eventimage/{{ $item->event->eventimage }}" alt="..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col">
                    <div class="card-body">
                        <div class="card-title" id="printableArea">
                            <h3 class="fw-bold">{{ $item->event->eventname }}</h3>
                            {{-- <h3 class="fw-bold">{{ $item->token }}</h3> --}}
                            <hr>
                            <div class="overflow-auto">

                                <table class="table table-borderless d-block">
                                    <tr>
                                        <td><i class="bi bi-calendar"></i></td>
                                        <td>Tanggal & Waktu</td>
                                        <td>{{ \Carbon\Carbon::parse($item->event->eventdate)->formatLocalized('%A, %d %B %Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-geo-alt"></i></td>
                                        <td>Tempat</td>
                                        <td>{{ $item->event->eventlocation }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-flag"></i></td>
                                        <td>Penyelenggara</td>
                                        <td>{{ $item->event->eventorganizer }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-list-nested"></i></td>
                                        <td>Tipe Event</td>
                                        <td class="text-capitalize">
                                            @if ($item->event->eventtype == 'gratis' || $item->event->eventtype == 'Gratis')
                                                Gratis
                                            @elseif ($item->event->eventtype == 'berbayar' || $item->event->eventtype == 'Berbayar')
                                                Berbayar | @currency($item->event->eventprice)
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-bookmark"></i></td>
                                        <td>Kategori Event</td>
                                        <td class="text-capitalize">{{ $item->event->eventkategori }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-bookmark"></i></td>
                                        <td>Email</td>
                                        <td class="text-capitalize">{{ $item->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-bookmark"></i></td>
                                        <td>Username</td>
                                        <td class="text-capitalize">{{ $item->username }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-bookmark"></i></td>
                                        <td>Nomer Tiket</td>
                                        <td class="text-capitalize">{{ $item->nomertiket }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="bi bi-bookmark"></i></td>
                                        <td>Status</td>
                                        <td class="text-capitalize">{{ $item->status }}</td>
                                    </tr>
                                </table>
                                <hr>
                            </div>
                        </div>
                        {{-- <a href="{{ URL::to('exportpdf') }}" class="btn btn-sm btn-success">Save Tiket to PDF</a> --}}
                        <a href="" onclick="printDiv('printableArea')" class="btn btn-sm btn-primary">Print
                            Tiket</a>
                    </div>
                </div>
                <!--
                <div class="col list-group">
                    {{-- <div id="snap-container" class="w-100"></div> --}}
                    <div class="mt-4">
                        <h5 class="fw-bold">Pilih Pembayaran</h5>
                        <form id="payment-form" action="" method="POST" class="needs-validation" novalidate="">
                            @csrf
                            @method('POST')
                            <div id="payment-options">
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input class="form-check-input" id="bcava_radio" type="radio" value="bca_va"
                                                name="paymentType">
                                            <label class="" for="bcava_radio">
                                                BCA Virtual Account
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label class="" for="bcava_radio">
                                                <img src="{{ asset('assets/payment-img/bca.png') }}" width="60">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input class="form-check-input" id="mandiriva_radio" type="radio"
                                                value="mandiri_va" name="paymentType">
                                            <label for="mandiriva_radio">
                                                Mandiri Virtual Account
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="mandiriva_radio">
                                                <img src="{{ asset('assets/payment-img/mandiri.png') }}" width="60">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input class="form-check-input" id="bniva_radio" type="radio" value="bni_va"
                                                name="paymentType">
                                            <label for="bniva_radio">
                                                BNI Virtual Account
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="bniva_radio">
                                                <img src="{{ asset('assets/payment-img/bni.png') }}" width="60">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="permatava_radio" type="radio" class="form-check-input"
                                                value="permata_va" name="paymentType">
                                            <label for="permatava_radio">
                                                Permata Virtual Account
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="permatava_radio">
                                                <img src="{{ asset('assets/payment-img/permata_bank.png') }}"
                                                    width="60">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="briva_radio" type="radio" class="form-check-input" value="bri_va"
                                                name="paymentType">
                                            <label for="briva_radio">
                                                BRI Virtual Account
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="briva_radio">
                                                <img src="{{ asset('assets/payment-img/bri.png') }}" width="50">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="gopay_online_radio" class="form-check-input" type="radio"
                                                value="gopay_online" name="paymentType">
                                            <label for="gopay_online_radio">
                                                Gopay Regular
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="gopay_online_radio">
                                                <img src="{{ asset('assets/payment-img/gopay_landscape.png') }}"
                                                    width="80">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="qris_online_radio" class="form-check-input" type="radio"
                                                value="qris_online" name="paymentType">
                                            <label for="qris_online_radio">
                                                QRIS
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="qris_online_radio">
                                                <img src="{{ asset('assets/payment-img/qris.png') }}" width="80">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="shopeepay_radio" class="form-check-input" type="radio"
                                                value="shopeepay" name="paymentType">
                                            <label for="shopeepay_radio">
                                                Shopee Pay
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="shopeepay_radio">
                                                <img src="{{ asset('assets/payment-img/shopeepay.png') }}"
                                                    width="60">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="bcaklikpay_radio" class="form-check-input" type="radio"
                                                value="bcaklikpay" name="paymentType">
                                            <label for="bcaklikpay_radio">
                                                BCA Klikpay
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="bcaklikpay_radio">
                                                <img src="{{ asset('assets/payment-img/bca_klikpay.png') }}"
                                                    width="60">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="octoclick_radio" class="form-check-input" type="radio"
                                                value="octoclick" name="paymentType">
                                            <label for="octoclick_radio">
                                                CIMB Octo Click
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="octoclick_radio">
                                                <img src="{{ asset('assets/payment-img/cimb_clicks.png') }}"
                                                    width="60">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="alfamart_radio" class="form-check-input" type="radio" value="alfamart"
                                                name="paymentType"> Alfa Group</div>
                                        <div class="icons">
                                            <img src="{{ asset('assets/payment-img/alfamart.png') }}" width="40">
                                            <img src="{{ asset('assets/payment-img/dan+dan.png') }}" width="40">
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="indomaret_radio" class="form-check-input" type="radio"
                                                value="indomaret" name="paymentType">
                                            <label for="indomaret_radio">
                                                Indomaret / iSaku
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="indomaret_radio">
                                                <img src="{{ asset('assets/payment-img/indomaret.png') }}"
                                                    width="40">
                                                <img src="{{ asset('assets/payment-img/i-saku.png') }}" width="50">
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 rounded border list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="my-0">
                                            <input id="gopay_checkout_radio" class="form-check-input" type="radio"
                                                value="gopay_wallet" name="paymentType">
                                            <label for="gopay_checkout_radio">
                                                Link Gopay Account
                                            </label>
                                        </div>
                                        <div class="icons">
                                            <label for="gopay_checkout_radio">
                                                <img src="{{ asset('assets/payment-img/gopay_landscape.png') }}"
                                                    width="100">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                        </form>
                        <button class="btn btn-sm btn-primary w-100 py-2" type="submit">Bayar!</button>
                        <div class="media text-muted pt-3">
                        </div>
                    </div>
                </div>
                -->
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
