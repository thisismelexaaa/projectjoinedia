<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Joinedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('/landingpage/assets/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,100;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="background-topo">
    <div class="sideNav">
        <button class="mobile-toggle-btn">
            <i class="bi bi-list"></i>
        </button>
        <ul>
            <li class="item-sideNav"><a href="#home">Home</a></li>
            <li class="item-sideNav"><a href="#feature">Feature</a></li>
            <li class="item-sideNav"><a href="#about">About</a></li>
            <li class="item-sideNav"><a href="#topevent">Top Event</a></li>
            <li class="item-sideNav"><a href="/register">Create Account</a></li>
            <li class="item-sideNav"><a href="/login">Login</a></li>
            <li class="item-sideNav"><a href="#contact">Contact Us</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="logo">
            <img src="{{ asset('/landingpage/assets/img/Joinedia.png') }}" alt="" />
            <a href="#home">Click Me <br /> <i class="bi bi-arrow-down"></i></a>
        </div>
        <div class="body-content">
            <div class="sticky-content">
                <a href="/"><img src="{{ asset('/landingpage/assets/img/Joinedia.png') }}" alt=""
                        data-aos="fade-down" /></a>
            </div>

            <div class="content-text" id="home">
                <div class="fs-1 fw-bold">
                    <span class="mx-0 pe-2">Perkenalkan! Kami Adalah </span>
                    <span class="typed text-primary fw-italic fw-bold fs-1 mx-0"></span>
                </div>
            </div>

            <div class="content-text" id="feature">
                <div class="row w-50">
                    <h1>Our Feature</h1>
                    <div class="card col-md co m-2 bg-primary text-white">
                        <div class="card-body">
                            <div class="card-title h-25">
                                <h4 class="fw-bold">Penjelajahan Event yang Mudah</h4>
                            </div>
                            <h6>plikasi Joinedia memberikan pengguna akses instan ke berbagai event kampus, termasuk
                                seminar, lokakarya, pertemuan kelompok, pertunjukan seni, dan lebih banyak lagi. Dengan
                                antarmuka yang intuitif, pengguna dapat dengan cepat menemukan acara yang sesuai dengan
                                minat dan jadwal mereka.</h6>
                        </div>
                    </div>
                    <div class="card col-md co m-2 bg-success text-white">
                        <div class="card-body">
                            <div class="card-title h-25">
                                <h4 class="fw-bold">Pendaftaran Online</h4>
                            </div>
                            <h6>Pendaftaran untuk event-event kampus kini lebih simpel daripada sebelumnya. Dengan
                                Joinedia, pengguna dapat mendaftar untuk acara favorit mereka dengan mudah melalui
                                aplikasi, menghilangkan kerumitan proses manual dan menghemat waktu berharga.</h6>
                        </div>

                    </div>
                    <div class="card col-md co m-2 bg-warning text-white">
                        <div class="card-body">
                            <div class="card-title h-25">
                                <h4 class="fw-bold">Konten Berkualitas</h4>
                            </div>
                            <h6>Joinedia tidak hanya tentang acara-acara, tetapi juga tentang pengalaman belajar.
                                Aplikasi ini dapat menyertakan materi, presentasi, atau sumber daya terkait yang
                                diperlukan oleh peserta untuk memaksimalkan manfaat dari setiap event.</h6>
                        </div>
                    </div>
                </div>
                <div class="row w-50">
                    <div class="card col-md co m-2 bg-secondary text-white">
                        <div class="card-body">
                            <div class="card-title h-25">
                                <h4 class="fw-bold">Misi Kami</h4>
                            </div>
                            <h6>Misi utama Joinedia adalah untuk menciptakan ekosistem kampus yang lebih terhubung,
                                kolaboratif, dan dinamis. Kami berkomitmen untuk memberikan pengalaman yang luar biasa
                                bagi mahasiswa dan anggota kampus lainnya, memastikan bahwa mereka dapat merasakan
                                setiap aspek dari lingkungan akademik mereka dengan lebih intens dan bermanfaat.

                                Dengan Aplikasi Joinedia, kami meyakini bahwa setiap event kampus dapat menjadi
                                kesempatan untuk pertumbuhan, pembelajaran, dan jaringan yang lebih luas. Bergabunglah
                                dengan kami dalam menjadikan pengalaman kampus Anda lebih berwarna dan bermakna daripada
                                sebelumnya.</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-text" id="about">
                <div class="row w-50">
                    <h1>About</h1>
                    <span class="">Joinedia adalah aplikasi revolusioner yang menghubungkan dan menyederhanakan
                        pengalaman kampus
                        Anda. Temukan, daftar, dan ikuti berbagai acara kampus dengan mudah. Dapatkan pemberitahuan
                        waktu nyata, dan pantau sejarah partisipasi Anda.
                        Bergabunglah dengan komunitas kampus yang dinamis dan berdaya guna. </span>
                </div>
            </div>

            <div class="content-text" id="topevent">
                <div class="row w-50">
                    <h1 class="mb-5">Top Event</h1>
                    <div class="row">
                        @foreach ($event as $item)
                            <div class="col-md-3 col-sm-6">
                                <a class="text-decoration-none" href="{{ route('event.show', $item->id) }}">
                                    <div class="card card-block">
                                        <img src="{{ asset('assets/images/eventimage/' . $item->image) }}"
                                            alt="Photo of sunset">
                                        <h1 class="card-title mt-3 mb-3 fs-5"><b>{{ $item->nama }}</b></h1>
                                        <p class="card-text">{!! $item->description !!}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="content-text" id="contact">
                <div class="row">
                    <h1>Contact Us</h1>
                    <div class="row justify-content-center">
                        <h3 class="col-1 mt-3 mx-3"><a target="_blank" href="https://facebook.com" class="text-white"><i
                                    class="bi bi-facebook"></a></i></h3>
                        <h3 class="col-1 mt-3 mx-3"><a target="_blank" href="https://wa.me/087877006780"
                                class="text-white"><i class="bi bi-whatsapp"></a></i></h3>
                        <h3 class="col-1 mt-3 mx-3"><a target="_blank" href="mailto::yudhaxsinatra@gmail.com"
                                class="text-white"><i class="bi bi-envelope"></a></i></h3>
                    </div>
                </div>
                <div class="text-center p-3 cpy">
                    © 2023 Copyright:
                    <a class="" href="/">Joinedia</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script src="{{ asset('/landingPage/assets/script.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();

        document.addEventListener("DOMContentLoaded", function() {
            const mobileToggleBtn = document.querySelector(".mobile-toggle-btn");
            const sideNav = document.querySelector(".sideNav ul");

            mobileToggleBtn.addEventListener("click", function() {
                sideNav.classList.toggle("active");
                mobileToggleBtn.classList.toggle("active");
            });
        });
    </script>

</body>

</html>
