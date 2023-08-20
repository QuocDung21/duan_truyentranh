<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Truyện tranh Quản lý</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body class="container  test">
    <div class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/') }}">Truyện tranh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục truyện
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($danhmuc as $dmuc)
                                <li><a class="dropdown-item"
                                        href="{{ url('danh-muc/' . $dmuc->slug_danhmuc) }}">{{ $dmuc->tendanhmuc }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Thể loại
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($theloai as $tloai)
                                <li><a class="dropdown-item"
                                        href="{{ url('the-loai/' . $tloai->slug_theloai) }}">{{ $tloai->tentheloai }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Thể loại truyện
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <form autocomplete="off" class="form-inline my-2 my-lg-0" method="GET"
                            action="{{ route('tim-kiem') }}">
                            @csrf
                            <div class="d-flex">
                                <input class="form-control me-2" type="search" name="tukhoa" id="keywords"
                                    placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                            <div class="w-full" id="search_ajax">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        @yield('slide')
        @yield('content')
        <footer class="text-muted">
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
        </footer>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var keywords = $(this).val();
            if (keywords != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/timkiem-ajax') }}",
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
            loop: true,
            margin: 10,
            dots: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
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
</body>

</html>
