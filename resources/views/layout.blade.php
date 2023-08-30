<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Truyenhayht</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> --}}
    {{-- test giao dien moi --}}
    <!-- Google Font -->


    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/uploads/background/user.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/@icon/elegant-icons@0.0.1-alpha.4/elegant-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}" type="text/css">
</head>

<body>
    <div class="loader" style="z-index: 9999"></div>
    </div>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo"
                        style="height: 50px;width: 50px; display: flex;justify-content: center;align-items: center;margin-top: 4px;text-align: center;">
                        <a href="{{ url('/') }}"
                            style="display: flex;justify-content: center;align-items: center">
                            <img style="border-radius: 50%;"
                                src="https://img.freepik.com/free-vector/flat-design-ninja-logo-template_23-2149008851.jpg?w=2000"
                                alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="{{ url('/') }}">Trang chủ</a></li>
                                <li><a href="#">Danh mục <i class="fa-solid fa-caret-down"></i></a>
                                    <ul class="dropdown">
                                        @foreach ($danhmuc as $dmuc)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ url('danh-muc/' . $dmuc->slug_danhmuc) }}">{{ $dmuc->tendanhmuc }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#">Thể loại <i class="fa-solid fa-caret-down"></i></a>
                                    <ul class="dropdown">
                                        @foreach ($theloai as $tloai)
                                            <li><a class="dropdown-item"
                                                    href="{{ url('the-loai/' . $tloai->slug_theloai) }}">{{ $tloai->tentheloai }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                {{-- <li><a href="./blog.html">Our Blog</a></li> --}}
                                <li><a href="#">Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 d-flex justify-content-center align-item-center">
                    <div class="input-group rounded mt-2">
                        <input id="keywords" type="search" class="form-control rounded" placeholder="Tìm kiếm"
                            aria-label="Search" aria-describedby="search-addon" />
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
    <!-- Hero Section Begin -->
    {{-- <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>Fate / Stay Night: Unlimited Blade Works</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Product Section Begin -->

    <!-- Product Section End -->
    <!-- Hero Section End -->
    @yield('slide')
    @yield('content')
    <!-- Footer Section Begin -->
    {{-- <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="./index.html">Homepage</a></li>
                            <li><a href="./categories.html">Categories</a></li>
                            <li><a href="./blog.html">Our Blog</a></li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>

                </div>
            </div>
        </div>
    </footer> --}}
    <!-- Footer Section End -->
    {{-- <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                    <a href="">Back to top</a>
                </p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia eaque ullam, quam consequuntur
                    corrupti odio sequi. Voluptate fugiat nam dolore.</p>
                <p>
                    Lorem, ipsum dolor.?
                    <a href="../../">
                        Lorem, ipsum.
                    </a>or read our <a href=""> Lorem ipsum dolor sit.</a>
                </p>
            </div>
        </footer> --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}
    <!-- Js Plugins -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/player.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var keywords = $(this).val();
            console.log(keywords);
            if (keywords != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "timkiem-ajax",
                    method: "POST",
                    data: {
                        keywords: keywords,
                        _token: _token
                    },
                    success: function(data) {
                        $("#search_ajax").empty(); // Xóa dữ liệu tìm kiếm trước đó
                        $("#search_ajax").fadeIn(); // Hiển thị phần tử
                        $("#search_ajax").html(data); // Hiển thị dữ liệu mới
                    }
                });
            } else {
                $("#search_ajax").fadeOut(); // Ẩn phần tử
            }
        });
    </script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            margin: 10,
            center: true,
            lazyLoad: true,
            loop: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            nav: true,
            responsive: {
                0: {
                    items: 4,
                    margin: 40,
                    center: true,
                },
                300: {
                    items: 2,
                    margin: 0,
                    margin: 40,
                    center: true,
                },
                600: {
                    items: 2,
                    margin: 0,
                },
                1000: {
                    items: 5,
                    center: true
                }
            }
        })
    </script>

    <script type="text/javascript">
        $('.select-chapter').on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url
            }
            return false;
        })
        current_chapter();

        function current_chapter() {
            var url = window.location.href;
            $('.select-chapter').find('option[value="' + url + '"]').attr("selected", true);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                // Các thiết lập khác của Owl Carousel
            });

            // Lắng nghe sự kiện click nút chuyển qua
            $('.custom-next').click(function() {
                $('.owl-carousel').trigger('next.owl.carousel');
            });

            // Lắng nghe sự kiện click nút chuyển lại
            $('.custom-prev').click(function() {
                $('.owl-carousel').trigger('prev.owl.carousel');
            });
        });
    </script>

</body>

</html>
