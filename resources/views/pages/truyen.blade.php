@extends('../layout')
@section('content')
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('danh-muc', [$truyen->danhmuctruyen->slug_danhmuc]) }}">{{ $truyen->danhmuctruyen->tendanhmuc }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $truyen->tentruyen }}</li>
        </ol>
    </nav>
    <div class="row ">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img class="" style=" height: 280px; width: 250px; object-fit: cover "
                        src=" {{ asset('public/uploads/truyen/' . $truyen->hinhanh) }}" alt="" srcset="">
                </div>
                <style>
                    .infotruyen {
                        list-style: none;
                        text-decoration: none;
                    }
                </style>
                <div class="col-md-9">
                    <ul class="infotruyen">
                        <li>Tên truyện : {{ $truyen->tentruyen ? $truyen->tentruyen : 'Đang cập nhập' }}</li>
                        <li>Tác giả : {{ $truyen->tacgia ? $truyen->tacgia : 'Đang cập nhập' }}</li>
                        <li>Danh mục :
                            <a href="{{ url('danh-muc/' . $truyen->danhmuctruyen->slug_danhmuc) }}">
                                {{ $truyen->danhmuctruyen->tendanhmuc ? $truyen->danhmuctruyen->tendanhmuc : 'Đang cập nhập' }}
                            </a>
                        </li>
                        <li>Số chapter : {{ count($chapter) }}</li>
                        <li>Số lượt xem : 200</li>
                        <li><a class="text-decoration-none" href="">Xem mục lục</a></li>
                        @if ($chapter_dau)
                            <li><a class="text-decoration-none btn btn-primary"
                                    href="{{ url('xem-chapter/' . $chapter_dau->slug_chapter) }}">Đọc
                                    online</a></li>
                        @else
                            <li><a class="text-decoration-none btn btn-danger btn btn-primary">Hiện tại chưa có chương để
                                    đọc</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <p>{{ $truyen->tomtat }}</p>
            </div>
            <hr>
            <h4>Mục lục</h4>
            @if (count($chapter) != 0)
                <ul>
                    @foreach ($chapter as $cter)
                        <li><a href="{{ url('xem-chapter/' . $cter->slug_chapter) }}" class="text-decoration-none"
                                href="">
                                {{ $cter->tieude }}
                            </a></li>
                    @endforeach
                </ul>
            @else
                <p>Mục lục đang cập nhật...</p>
            @endif
            <h4>Sách cùng danh mục</h4>

            <div class="row">
                @foreach ($cungdanhmuc as $cdmuc)
                    <div class="col-md-3">
                        <div class="card mb-4 box-shadow">
                            <a href="" class="text-decoration-none">
                                <img style=" height: 250px; object-fit: cover" class="card-img-top"
                                    src=" {{ asset('public/uploads/truyen/' . $cdmuc->hinhanh) }}" alt="">
                                <div class="card-body">
                                    <h5>Lorem, ipsum dolor.</h5>
                                    <p class="card-text">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum, saepe!
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ url('xem-truyen/' . $cdmuc->slug_truyen) }}" type="button"
                                                class="btn btn-sm btn-outline-secondary">Đọc
                                                ngay</a>
                                            <a type="button" class="btn btn-sm btn-outline-secondary">2130</a>
                                        </div>
                                        <small class="text-muted">9 phút trước</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="col-md-3">
            <h3>Sách hay xem nhiều</h3>
        </div>
    </div> --}}

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a
                            href="{{ route('danh-muc', [$truyen->danhmuctruyen->slug_danhmuc]) }}">{{ $truyen->danhmuctruyen->tendanhmuc }}</a>
                        <span>{{ $truyen->tentruyen }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad" {{-- style="
         opacity: 0.5;
        backdrop-filter: blur(100px);
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-image: url('{{ asset('public/uploads/truyen/' . $truyen->hinhanh) }}');
        " --}}>
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg "
                            data-setbg="{{ asset('public/uploads/truyen/' . $truyen->hinhanh) }}">
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $truyen->tentruyen }}</h3>
                            </div>
                            <div class="anime__details__rating">
                                <div class="rating">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                                <span>1.029 Votes</span>
                            </div>
                            <p>{{ $truyen->tomtat }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Tác giả:</span> {{ $truyen->tacgia }}</li>
                                            <li><span>Danh mục:</span> {{ $truyen->danhmuctruyen->tendanhmuc }} </li>
                                            <li><span>Thể loại:</span> {{ $truyen->theloai->tentheloai }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Số chapter:</span>{{ count($chapter) }}</li>
                                            <li><span>Lượt xem:</span> 131,541</li>
                                            <li><span>Trạng thái:</span> Đang cập nhật</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @if (count($chapter) != 0)
                                <div class="anime__details__btn">
                                    <a href="{{ route('xem-chapter', [$chapter_dau->slug_chapter]) }}"
                                        class="watch-btn"><span>Xem ngay</span>
                                        <i class="fa fa-angle-right"></i></a>
                                </div>
                            @else
                                <div class="anime__details__btn">
                                    <a href="#" class="watch-btn"><span>Đang cập nhật</span>
                                        <i class="fa fa-angle-right"></i></a>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>Danh mục {{ $chapter == null ? '' : 'đang cập nhật'    }}</h5>
                        </div>
                        @foreach ($chapter as $cter)
                            <a href="{{ route('xem-chapter',[$cter->slug_chapter]) }}">{{ $cter->tieude }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Reviews</h5>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-1.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Chris Curry - <span>1 Hour ago</span></h6>
                                <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                    "demons" LOL</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-2.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                                <p>Finally it came out ages ago</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-3.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                                <p>Where is the episode 15 ? Slow update! Tch</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-4.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Chris Curry - <span>1 Hour ago</span></h6>
                                <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                    "demons" LOL</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-5.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                                <p>Finally it came out ages ago</p>
                            </div>
                        </div>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="img/anime/review-6.jpg" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                                <p>Where is the episode 15 ? Slow update! Tch</p>
                            </div>
                        </div>
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        <form action="#">
                            <textarea placeholder="Your Comment"></textarea>
                            <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>you might like...</h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-1.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Boruto: Naruto next generations</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-2.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-3.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-4.jpg">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- Anime Section End -->
    <!-- Search model Begin -->
    {{-- <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div> --}}
    <!-- Search model end -->
@endsection
