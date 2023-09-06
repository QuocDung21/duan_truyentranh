<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9582999796357564"
            crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $info_webs->name }}</title>

    <meta name="ROBOTS" content="INDEX,FOLLOW"/>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('public/uploads/info/logo/' . $info_webs->logo) }}">
    <link rel="shortcut icon" href="{{ asset('public/uploads/info/logo/' . $info_webs->logo) }}" type="image/x-icon">

    {{--    Đo luồng trang web--}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9KCR1BMGYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-9KCR1BMGYK');
    </script>

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
<style>
    .dropdown-scroll {
        max-height: 50vh;
        overflow-y: auto;
    }

    .dropdown-menu::-webkit-scrollbar {
        width: 8px;
        border-radius: 4px; /* Góc bo tròn của thanh cuộn */
    }

    .dropdown-menu::-webkit-scrollbar {
        width: 8px; /* Độ rộng của thanh cuộn */
    }

    .dropdown-menu::-webkit-scrollbar-thumb {
        background-color: #888; /* Màu của thanh cuộn */
    }

    .dropdown-menu::-webkit-scrollbar-thumb:hover {
        background-color: #555; /* Màu khi hover */
    }

    .dropdown-menu {
        padding: 12px;
        max-height: 50vh;
        overflow-y: auto;
    }

    .dropdown-menu .custom_hr {
        background: yellow;
        height: 1px;
        width: 100%;
    }

    .li_search_ajax a {
        color: black;
        font-size: 12px;
        cursor: pointer;
        text-transform: uppercase;

    }

</style>
<div>
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
                        <img loading="lazy" style="border-radius: 50%;height: 50px;width: 50px;object-fit: fill"
                             src="{{ asset('public/uploads/info/logo/' . $info_webs->logo) }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li>
                                <a href="#">Danh mục <i class="fa-solid fa-caret-down"></i></a>
                                <ul style="width: 200px !important" class="dropdown dropdown-scroll">
                                    @foreach ($danhmuc as $dmuc)
                                        <li>
                                            <a class="dropdown-item"
                                               title="{{$dmuc->tendanhmuc}}"
                                               href="{{ url('danh-muc/' . $dmuc->slug_danhmuc) }}">{{ $dmuc->tendanhmuc }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#">Thể loại <i class="fa-solid fa-caret-down"></i></a>
                                <ul style="width: 200px !important" class="dropdown dropdown-scroll">
                                    @foreach ($theloai as $tloai)
                                        <li>
                                            <a class="dropdown-item"
                                               title="{{$tloai->tentheloai}}"
                                               href="{{ url('the-loai/' . $tloai->slug_theloai) }}">{{ $tloai->tentheloai }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            {{--        Tìm kiếm        --}}
            <div class="col-lg-3 d-flex justify-content-center align-item-center">
                <div class="input-group rounded mt-2">
                    <form class="d-flex " style="height: 38px" autocomplete="off" action="{{ route('tim-kiem') }}" method="GET">
                        @csrf
                        <input id="keywords" name="keywords" type="search" class="form-control rounded"
                               placeholder="Tìm kiếm"
                               aria-label="Search" aria-describedby="search-addon"/>
                        <button type="submit" class="btn btn-outline-secondary">Tìm</button>
                    </form>
                    <div id="search_ajax"></div>
                </div>
            </div>
            {{--        End tìm kiếm         --}}
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
@yield('slide')
@yield('content')
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><i class="fa-solid fa-arrow-up"></i></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                    <p>
                        {{ $info_webs->website_info }}
                    </p>
                    <p>
                        @Contact : {{ $info_webs->contact }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
            </div>
        </div>
    </div>
</footer>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0"
        nonce="IbgOvxgk"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/player.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/mixitup.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript">
    $('#keywords').keyup(function () {
        var keywords = $(this).val();
        console.log(keywords);
        console.log(_token);

        if (keywords != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "timkiem-ajax",
                method: "POST",
                data: {
                    keywords: keywords,
                    _token: _token
                },
                success: function (data) {
                    $("#search_ajax").empty();
                    $("#search_ajax").fadeIn();
                    $("#search_ajax").html(data);
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


<script>
    document.addEventListener('click', function(event) {
        const searchDiv = document.getElementById('search_ajax');
        const keywordsInput = document.getElementById('keywords');

        // Check if the clicked element is not the search div or the keywords input
        if (event.target !== searchDiv && event.target !== keywordsInput) {
            // Hide the search div
            searchDiv.style.display = 'none';
        }
    });
</script>


<script type="text/javascript">
    $('.select-chapter').on('change', function () {
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
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            // Các thiết lập khác của Owl Carousel
        });

        // Lắng nghe sự kiện click nút chuyển qua
        $('.custom-next').click(function () {
            $('.owl-carousel').trigger('next.owl.carousel');
        });

        // Lắng nghe sự kiện click nút chuyển lại
        $('.custom-prev').click(function () {
            $('.owl-carousel').trigger('prev.owl.carousel');
        });
    });
</script>

</body>

</html>
