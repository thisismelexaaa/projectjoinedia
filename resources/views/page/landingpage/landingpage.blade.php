<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ config('app.name') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('/assets/img/joinedia-warna.png') }}" rel="icon">
    <link href="{{ asset('assetsLandingPage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assetsLandingPage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsLandingPage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsLandingPage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsLandingPage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsLandingPage/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsLandingPage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assetsLandingPage/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexStart
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/joinedia.png') }}" alt="">
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#features">Features</a></li>
                    <li><a class="nav-link scrollto" href="#faq">F.A.Q</a></li>
                    <li><a class="nav-link scrollto" href="#recent-blog-posts">Event</a></li>
                    {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="#">Drop Down 1</a></li>
                                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                            class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        <li><a href="#">Deep Drop Down 1</a></li>
                                        <li><a href="#">Deep Drop Down 2</a></li>
                                        <li><a href="#">Deep Drop Down 3</a></li>
                                        <li><a href="#">Deep Drop Down 4</a></li>
                                        <li><a href="#">Deep Drop Down 5</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Drop Down 2</a></li>
                                <li><a href="#">Drop Down 3</a></li>
                                <li><a href="#">Drop Down 4</a></li>
                            </ul>
                        </li> --}}

                    {{-- <li class="dropdown megamenu"><a href="#"><span>Mega Menu</span> <i
                                    class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li>
                                    <a href="#">Column 1 link 1</a>
                                    <a href="#">Column 1 link 2</a>
                                    <a href="#">Column 1 link 3</a>
                                </li>
                                <li>
                                    <a href="#">Column 2 link 1</a>
                                    <a href="#">Column 2 link 2</a>
                                    <a href="#">Column 3 link 3</a>
                                </li>
                                <li>
                                    <a href="#">Column 3 link 1</a>
                                    <a href="#">Column 3 link 2</a>
                                    <a href="#">Column 3 link 3</a>
                                </li>
                                <li>
                                    <a href="#">Column 4 link 1</a>
                                    <a href="#">Column 4 link 2</a>
                                    <a href="#">Column 4 link 3</a>
                                </li>
                            </ul>
                        </li> --}}
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="nav-link scrollto" href="/register">Daftar</a></li>
                    <li><a class="getstarted scrollto" href="/login">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Selamat Datang di JOINEDIA!</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Temukan, Ikuti, dan Ciptakan Event di Catur Insan
                        Cendekia.</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Mulai Jelajahi Event Sekarang!</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('assetsLandingPage/assets/img/eventimg.png') }}" class="img-fluid"
                        alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang JOINEDIA</h3>
                            <h2>Solusi Inovatif untuk Event Kampus yang Lebih Terkoneksi</h2>
                            <p>
                                Kami adalah tim yang berdedikasi untuk memfasilitasi eksplorasi dan kolaborasi dalam
                                dunia event di Universitas Catur Insan Cendekia. JOINEDIA membantu mahasiswa, dosen, dan
                                civitas kampus lainnya untuk menjalani pengalaman kampus yang lebih kaya dengan
                                menghadirkan beragam event inspiratif.
                            </p>
                            {{-- <div class="text-center text-lg-start">
                                <a href="#"
                                    class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Read More</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('assetsLandingPage/assets/img/about.jpg') }}" class="img-fluid"
                            alt="">
                    </div>

                </div>
            </div>

        </section><!-- End About Section -->

        <!-- ======= Values Section ======= -->
        <section id="values" class="values">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Mengapa Memilih JOINEDIA?</h2>
                    <p>Kemudahan, Kreativitas, dan Kenyamanan dalam Satu Platform</p>
                </header>

                <div class="row">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="box">
                            <img src="{{ asset('assetsLandingPage/assets/img/values-1.png') }}" class="img-fluid"
                                alt="">
                            <h3>Kemudahan Akses</h3>
                            <p>Temukan dan mendaftar event hanya dengan beberapa klik. Pengalaman pengguna yang intuitif
                                menjadikan JOINEDIA tempat yang nyaman bagi semua.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="box">
                            <img src="{{ asset('assetsLandingPage/assets/img/values-2.png') }}" class="img-fluid"
                                alt="">
                            <h3>Kreativitas Terinspirasi</h3>
                            <p>engan dukungan untuk menciptakan event Anda sendiri, Anda dapat mengembangkan ide kreatif
                                dan membagikannya dengan komunitas kampus.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="box">
                            <img src="{{ asset('assetsLandingPage/assets/img/values-3.png') }}" class="img-fluid"
                                alt="">
                            <h3>Kenyamanan Total</h3>
                            <p>Dengan informasi event yang lengkap dan pendaftaran online, kami memastikan setiap
                                langkah menjadi lancar dan nyaman.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Values Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row align-center gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-calendar-event"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $countEvent }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Total Event</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-people" style="color: #ee6c20;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $countUser }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Total User</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-check-circle" style="color: #15be56;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $countEventFinish }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Event Selesai</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-clock" style="color: #bb0852;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $countEventNotFinish }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Event Berjalan</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Kenapa Memilih JOINEDIA?</h2>
                    <p>Temukan Fitur-Fitur Unggulan yang Menarik</p>
                </header>

                <div class="row">

                    <div class="col-lg-6">
                        <img src="{{ asset('assetsLandingPage/assets/img/features.png') }}" class="img-fluid"
                            alt="">
                    </div>

                    <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                        <div class="row align-self-center gy-4">

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Temukan Event Menarik</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Ikuti Dengan Mudah</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Ciptakan Event Sendiri</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Tingkatkan Interaksi dan Koneksi</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Realisasikan Ide Kreatif</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Terlibat dalam Komunitas</h3>
                                </div>
                            </div>

                        </div>
                    </div>

                </div> <!-- / row -->

                <!-- Feature Tabs -->
                {{-- <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-6">
                        <h3>Temukan, Ikuti, dan Ciptakan Event di Catur Insan Cendekia</h3>

                        <!-- Tabs -->
                        <ul class="nav nav-pills mb-3">
                            <li>
                                <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Temukan</a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="pill" href="#tab2">Ikuti</a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="pill" href="#tab3">Ciptakan</a>
                            </li>
                        </ul><!-- End Tabs -->

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Tab 1 Content -->
                            <div class="tab-pane fade show active" id="tab1">
                                <p>Eksplorasi ragam event menarik yang ada di dalam lingkungan Universitas Catur Insan
                                    Cendekia. Dengan
                                    JOINEDIA, Anda dapat menemukan peluang baru, memperluas jaringan sosial, dan
                                    merasakan beragam pengalaman yang
                                    menginspirasi.</p>
                            </div><!-- End Tab 1 Content -->

                            <!-- Tab 2 Content -->
                            <div class="tab-pane fade" id="tab2">
                                <p>Bergabunglah dalam event-event berkualitas yang diadakan di kampus. Melalui
                                    partisipasi aktif di event ini, Anda
                                    dapat membangun ikatan kebersamaan, merasakan pengalaman berharga, serta menciptakan
                                    kenangan tak terlupakan
                                    bersama teman-teman dan civitas akademika.</p>
                            </div><!-- End Tab 2 Content -->

                            <!-- Tab 3 Content -->
                            <div class="tab-pane fade" id="tab3">
                                <p>Berikan kontribusi nyata kepada komunitas kampus dengan menjadi inisiator event-event
                                    yang unik dan inspiratif.
                                    Dengan JOINEDIA, Anda memiliki kesempatan untuk mengorganisir event yang tidak hanya
                                    menghibur, tetapi juga
                                    memberi dampak positif bagi seluruh warga kampus, memperkaya kehidupan akademik, dan
                                    memperluas wawasan.</p>
                            </div><!-- End Tab 3 Content -->

                        </div>

                    </div>

                    <div class="col-lg-6">
                        <img src="{{ asset('assetsLandingPage/assets/img/features-2.png') }}" class="img-fluid"
                            alt="">
                    </div>

                </div> --}}
                <!-- End Feature Tabs -->

                <!-- Feature Icons -->
                <div class="row feature-icons" data-aos="fade-up">
                    <h3>Mengapa Memilih JOINEDIA?</h3>

                    <div class="row">

                        <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
                            <img src="{{ asset('assetsLandingPage/assets/img/features-3.png') }}"
                                class="img-fluid p-4" alt="">
                        </div>

                        <div class="col-xl-8 d-flex content">
                            <div class="row align-self-center gy-4">

                                <div class="col-md-6 icon-box" data-aos="fade-up">
                                    <i class="ri-line-chart-line"></i>
                                    <div>
                                        <h4>Event Berkualitas untuk Pengalaman Kampus yang Kaya</h4>
                                        <p>Temukan dan ikuti event-event bermutu yang akan memperkaya perjalanan kampus
                                            Anda dengan berbagai
                                            pengalaman berharga dan inspiratif.</p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <i class="ri-stack-line"></i>
                                    <div>
                                        <h4>Kreativitas Anda Terinspirasi</h4>
                                        <p>Ekspresikan kreativitas Anda dengan menciptakan event-event unik, bermanfaat,
                                            dan memberi dampak
                                            positif bagi komunitas kampus.</p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                    <i class="ri-brush-4-line"></i>
                                    <div>
                                        <h4>Interaksi dan Jaringan yang Luas</h4>
                                        <p>Terhubung dengan berbagai individu berbakat dan komunitas inspiratif di
                                            seluruh lingkungan kampus,
                                            memperluas wawasan dan jaringan sosial Anda.</p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                    <i class="ri-magic-line"></i>
                                    <div>
                                        <h4>Pengalaman dan Kenangan yang Berharga</h4>
                                        <p>Partisipasi dalam event-event JOINEDIA akan memberikan Anda pengalaman dan
                                            kenangan tak terlupakan
                                            yang akan dikenang sepanjang perjalanan akademik Anda.</p>

                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                    <i class="ri-command-line"></i>
                                    <div>
                                        <h4>Peluang untuk Berkontribusi Positif</h4>
                                        <p>Jadilah inisiator event dan memberikan dampak positif kepada seluruh
                                            komunitas kampus dengan
                                            mengorganisir event yang bermanfaat dan menginspirasi.</p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                                    <i class="ri-radar-line"></i>
                                    <div>
                                        <h4>Pendaftaran dan Manajemen Event Lebih Mudah</h4>
                                        <p>Proses pendaftaran dan manajemen event menjadi lebih sederhana dan efisien,
                                            memungkinkan Anda lebih
                                            fokus pada pengalaman yang berharga.</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div><!-- End Feature Icons -->

            </div>

        </section>
        <!-- End Features Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Layanan</h2>
                    <p>Memperkenalkan Layanan Unggulan kami untuk Menyempurnakan Pengalaman Kampus Anda</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-box blue">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Temukan Event Berkualitas</h3>
                            <p>Temukan event-event bermutu yang akan memperkaya pengalaman kampus Anda.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-box orange">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Pendaftaran Mudah</h3>
                            <p>Manfaatkan proses pendaftaran dan manajemen event yang lebih sederhana dan efisien.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-box green">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Kembangkan Kreativitas</h3>
                            <p>Ciptakan event unik dan bermanfaat untuk mengembangkan kreativitas dan kontribusi Anda.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-box red">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Terhubung dan Berkolaborasi</h3>
                            <p>Terhubung dengan berbagai individu dan komunitas di lingkungan kampus untuk
                                berkolaborasi.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-box purple">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Peluang dan Kenangan Berharga</h3>
                            <p>Dapatkan peluang dan kenangan berharga melalui event-event yang kami tawarkan.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                        <div class="service-box pink">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Kenikmatan Berbagi</h3>
                            <p>Rasakan kenikmatan berbagi kontribusi positif melalui event-event yang Anda ciptakan.</p>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Services Section -->

        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Pertanyaan yang Sering Diajukan (F.A.Q)</h2>
                    <p>Temukan Jawaban untuk Pertanyaan yang Sering Diajukan</p>
                </header>

                <div class="row">
                    <div class="col-lg-6">
                        <!-- F.A.Q List 1-->
                        <div class="accordion accordion-flush" id="faqlist1">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                        Apa itu JOINEDIA dan bagaimana cara bergabung?
                                    </button>
                                </h2>
                                <div id="faq-content-1" class="accordion-collapse collapse"
                                    data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        JOINEDIA adalah platform berbasis kampus yang memungkinkan Anda menemukan, ikut
                                        serta, dan
                                        bahkan menciptakan event-event menarik di lingkungan Universitas Catur Insan
                                        Cendekia.
                                        Cara bergabung sangatlah mudah, cukup daftarkan diri Anda dan Anda akan
                                        mendapatkan akses
                                        penuh untuk mengeksplorasi dunia event kampus kami.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                                        Bagaimana saya dapat menciptakan event di JOINEDIA?
                                    </button>
                                </h2>
                                <div id="faq-content-2" class="accordion-collapse collapse"
                                    data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        Anda dapat dengan mudah menciptakan event Anda sendiri di JOINEDIA. Setelah
                                        bergabung,
                                        Anda akan memiliki opsi untuk membuat event, mengatur detailnya, dan berbagi
                                        informasi
                                        dengan komunitas kampus. Ini adalah peluang besar bagi Anda untuk menginspirasi
                                        dan
                                        memberikan dampak positif pada lingkungan kampus.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!-- F.A.Q List 2-->
                        <div class="accordion accordion-flush" id="faqlist2">

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                                        Apa manfaat terhubung dengan komunitas kampus melalui JOINEDIA?
                                    </button>
                                </h2>
                                <div id="faq2-content-1" class="accordion-collapse collapse"
                                    data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        Bergabung dengan komunitas kampus melalui JOINEDIA memberi Anda kesempatan untuk
                                        terhubung
                                        dengan sesama mahasiswa dan berbagai komunitas yang memiliki minat serupa. Ini
                                        adalah
                                        peluang bagus untuk memperluas jaringan, belajar, dan berkolaborasi dalam
                                        rangkaian event
                                        dan kegiatan kampus yang menarik.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                                        Bagaimana saya dapat mendaftar untuk event?
                                    </button>
                                </h2>
                                <div id="faq-content-3" class="accordion-collapse collapse"
                                    data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        Mendaftar untuk event di JOINEDIA sangatlah mudah. Cukup jelajahi event yang
                                        tersedia di
                                        platform kami, pilih event yang Anda minati, dan ikuti instruksi pendaftaran
                                        yang diberikan.
                                        Dengan beberapa langkah sederhana, Anda akan terdaftar untuk mengikuti event
                                        yang
                                        menarik.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End F.A.Q Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="recent-blog-posts" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Event Terbaru</h2>
                    <p>Temukan event terbaru</p>
                </header>

                <div class="row">

                    @foreach ($event as $item)
                        <div class="col-lg-4 mb-3">
                            <div class="post-box">
                                <div class="post-img">
                                    <img src="{{ asset('assets/images/eventimage/' . $item->image) }}"
                                        class="img-fluid" width="100%" alt="">
                                    @if ($item->image == null)
                                        <img src="{{ asset('assetsLandingPage/assets/img/img-not-found.jpg') }}"
                                            class="img-fluid" alt="">
                                    @endif
                                </div>
                                <span
                                    class="post-date">{{ \Carbon\Carbon::parse($item->start_date)->formatLocalized('%d %B %Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->end_date)->formatLocalized('%d %B %Y') }}</span>
                                <h3 class="post-title">{{ $item->nama }}</h3>
                                <a href="event/{{ $item->id }}"
                                    class="readmore stretched-link mt-auto"><span>Lihat Event</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section><!-- End Recent Blog Posts Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Contact</h2>
                    <p>Contact Us</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-box shadow-sm p-3 mb-5 bg-white rounded h-100">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Address</h3>
                                    <p>Jl. Kesambi No.202, Drajat, <br>
                                        Kec. Kesambi, Kota Cirebon, <br>
                                        Jawa Barat 45133 <br>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box shadow-sm p-3 mb-5 bg-white rounded h-100">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Call Us</h3>
                                    <p>0231-200418</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box shadow-sm p-3 mb-5 bg-white rounded h-100">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@cic.ac.id</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box shadow-sm p-3 mb-5 bg-white rounded h-100">
                                    <i class="bi bi-clock"></i>
                                    <h3>Open Hours</h3>
                                    <p><b>Senin - Jum'at</b> : 9:00 - 16:00 <br>
                                        <b>Sabtu</b> : 9:00 - 14:00
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15849.187921125382!2d108.5534071!3d-6.7335768!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1d8ebc133e3f%3A0x91385801f5822049!2sUniversitas%20Catur%20Insan%20Cendekia%20(CIC)!5e0!3m2!1sid!2sid!4v1692987936881!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0; border-radius:10px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>

            </div>

        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 col-md-12 footer-info">
                        <a href="/" class="logo d-flex align-items-center">
                            <img src="{{ asset('assets/img/joinedia.png') }}" alt="">
                        </a>
                        <p>Kami adalah tim yang berdedikasi untuk memfasilitasi eksplorasi dan kolaborasi dalam
                            dunia event di Universitas Catur Insan Cendekia. JOINEDIA membantu mahasiswa, dosen, dan
                            civitas kampus lainnya untuk menjalani pengalaman kampus yang lebih kaya dengan
                            menghadirkan beragam event inspiratif.</p>
                        {{-- <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div> --}}
                    </div>

                    <div class="col-lg-3 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <a href="/home">Home</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="#about">About</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <a href="/register">Register</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="/login">Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>
                            Jl. Kesambi No.202, Drajat, <br>
                            Kec. Kesambi, Kota Cirebon, <br>
                            Jawa Barat 45133 <br>
                            <strong>Phone:</strong> 0231-200418<br>
                            <strong>Email:</strong> info@cic.ac.id<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="copyright">
            <div class="copyright">
                &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assetsLandingPage/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assetsLandingPage/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assetsLandingPage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsLandingPage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assetsLandingPage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assetsLandingPage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assetsLandingPage/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assetsLandingPage/assets/js/main.js') }}"></script>

</body>

</html>
