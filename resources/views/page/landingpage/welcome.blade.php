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
                <a href="#"><img src="{{ asset('/landingpage/assets/img/Joinedia.png') }}" alt=""
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
                    <div class="card col-md co m-2">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Cari Event Cepat</h4>
                            </div>
                            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, cum!</h6>
                        </div>
                    </div>
                    <div class="card col-md co m-2">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Event Terlengkap</h4>
                            </div>
                            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, cum!</h6>
                        </div>

                    </div>
                    <div class="card col-md co m-2">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Connection!</h4>
                            </div>
                            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, cum!</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-text" id="about">
                <div class="row">
                    <h1>About</h1>
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, cum!</span>
                </div>
            </div>

            <div class="content-text" id="topevent">
                <div class="row w-50">
                    <h1>Top Event</h1>
                    <div class="col-sm-3 col-md-3 col-lg-4 mb-4">
                        <div class="card text-dark card-has-bg click-col"
                            style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
                            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street"
                                alt="Creative Manner Design Lorem Ipsum Sit Amet Consectetur dipisi?">
                            <div class="card-img-overlay d-flex flex-column">
                                <div class="card-body">
                                    <small class="card-meta mb-2">Thought Leadership</small>
                                    <h4 class="card-title mt-0 "><a class="text-dark"
                                            herf="https://creativemanner.com">Web
                                            Developmet Lorem Ipsum Sit Amet
                                            Consectetur dipisi?</a></h4>
                                    <small><i class="far fa-clock"></i> October 15, 2020</small>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="content-text" id="contact">
                <div class="row">
                    <h1>Contact Us</h1>
                    <div class="row justify-content-center">
                        <h3 class="col-1 mt-3 mx-3"><a target="_blank" href="https://facebook.com"
                                class="text-white"><i class="bi bi-facebook"></a></i></h3>
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

    </div>

    {{-- <div class="h-100 position-relative">
        <div class="text-white position-absolute top-50 start-50 translate-middle">
            <div class="fs-1 fw-bold row gx-0" style="width: 43vw;">
                <span class="col-md mx-0">Halo! Kami Adalah</span>
                <span class="col-md mx-0">
                    <span class="typed text-primary fw-italic fw-bold fs-1 mx-0"></span>
                </span>
            </div>
            <div class="row">
                <a href="#ourservice" class="btn btn-sm col-md text-white rounded-5 btn-primary m-1 px-3">Our
                    Services</a>
                <a href="#aboutus" class="btn btn-sm col-md text-white rounded-5 btn-primary m-1 px-3">About Us</a>
                <a href="#ourevent" class="btn btn-sm col-md text-white rounded-5 btn-primary m-1 px-3">Our Event</a>
                <a href="/register" class="btn btn-sm col-md text-white rounded-5 btn-primary m-1 px-3">Create
                    Account</a>
                <a href="/login" class="btn btn-sm col-md text-white rounded-5 btn-primary m-1 px-3">Login</a>
            </div>
        </div>
    </div>
    <section class="services h-100 text-dark" id="ourservice">
        <div class="bg-white h-100 p-5">
            <!-- Our Service -->
            <div class="row text-center align-content-center h-100">
                <h1 class="text-center">Our Service</h1>
                <div class="col">
                    <img src="{{ asset('landingpage/asset/img/1.jpg') }}" class="w-50 our-services" alt="">
                    <p class="fs-1 fw-bold">Judul Services</p>
                    <p class="fs-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta, provident.</p>
                </div>
                <div class="col">
                    <img src="{{ asset('landingpage/asset/img/2.jpg') }}" class="w-50 our-services" alt="">
                    <p class="fs-1 fw-bold">Judul Services</p>
                    <p class="fs-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta, provident.</p>
                </div>
                <div class="col">
                    <img src="{{ asset('landingpage/asset/img/3.jpg') }}" class="w-50 our-services" alt="">
                    <p class="fs-1 fw-bold">Judul Services</p>
                    <p class="fs-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta, provident.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="h-100 text-white" id="aboutus">
        <div class="h-100 p-5">
            <!-- Our Service -->
            <div class="row text-center align-content-center h-100">
                <h1 class="text-center">About Us</h1>
                <p class="fs-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores molestiae modi
                    magni
                    minus possimus voluptatum nobis iure itaque enim aliquid, debitis beatae quisquam corporis facere,
                    exercitationem quasi, id vero pariatur voluptates nulla. Placeat consequatur doloremque iste beatae
                    excepturi ratione, doloribus sed illo! Repellendus iste hic est nulla optio ipsum vel.</p>
            </div>
        </div>
    </section>
    <section id="ourevent" class="h-100 bg-white">
        <div class="p-5 text-dark">
            <h1 class="text-center">Our Event</h1>
            <!-- Our Service -->
            <div class="row g-0">
                <div class="col-4">
                    <div class="profile-card-2">
                        <a href="#1">
                            <img src="{{ asset('landingpage/asset/img/1-1.png') }}" class="img img-responsive">
                            <div class="profile-name">Join Event</div>
                            <div class="profile-username">Sekarang Juga</div>
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="profile-card-2">
                        <a href="#2">
                            <img src="{{ asset('landingpage/asset/img/1-1.png') }}" class="img img-responsive">
                            <div class="profile-name">Join Event</div>
                            <div class="profile-username">Sekarang Juga</div>
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="profile-card-2">
                        <a href="#3">
                            <img src="{{ asset('landingpage/asset/img/1-1.png') }}" class="img img-responsive">
                            <div class="profile-name">Join Event</div>
                            <div class="profile-username">Sekarang Juga</div>
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="profile-card-2">
                        <a href="#3">
                            <img src="{{ asset('landingpage/asset/img/1-1.png') }}" class="img img-responsive">
                            <div class="profile-name">Join Event</div>
                            <div class="profile-username">Sekarang Juga</div>
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="profile-card-2">
                        <a href="#3">
                            <img src="{{ asset('landingpage/asset/img/1-1.png') }}" class="img img-responsive">
                            <div class="profile-name">Join Event</div>
                            <div class="profile-username">Sekarang Juga</div>
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="profile-card-2">
                        <a href="#3">
                            <img src="{{ asset('landingpage/asset/img/1-1.png') }}" class="img img-responsive">
                            <div class="profile-name">Join Event</div>
                            <div class="profile-username">Sekarang Juga</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="">
        <hr>
        <div class="container">
            <!-- Section: Links -->
            <section class="mt-5">
                <!-- Grid row-->
                <div class="row text-center d-flex justify-content-center pt-5">
                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#ourservice"
                                class="link-offset-2 link-offset-3-hover link-primary link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-white">Our
                                Services
                            </a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#aboutus"
                                class="link-offset-2 link-offset-3-hover link-primary link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-white">About
                                us
                            </a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!"
                                class="link-offset-2 link-offset-3-hover link-primary link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-white">Create
                                Account
                            </a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!"
                                class="link-offset-2 link-offset-3-hover link-primary link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-white">Login
                            </a>
                        </h6>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row-->
            </section>
            <!-- Section: Links -->

            <hr class="my-5" />

            <!-- Section: Text -->
            <section class="mb-5">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                            distinctio earum repellat quaerat voluptatibus placeat nam,
                            commodi optio pariatur est quia magnam eum harum corrupti
                            dicta, aliquam sequi voluptate quas.
                        </p>
                    </div>
                </div>
            </section>
            <!-- Section: Text -->

            <!-- Section: Social -->
            <section class="text-center mb-5">
                <a href="" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-github"></i>
                </a>
            </section>
            <!-- Section: Social -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2023 Copyright:
            <a class="text-white" href="/">Joinedia</a>
        </div>
        <!-- Copyright -->
        <!-- Footer -->
        <!-- End of .container -->
    </section> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script src="{{ asset('/landingPage/assets/script.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
