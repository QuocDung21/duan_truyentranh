@extends('../layout')
@section('content')
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
                            {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div> --}}
                            <div class="view" style="top: 5px;height: 26px;"><i class="fa fa-eye"></i>
                                {{ $truyen->luotxem == 0 ? 0 : $truyen->luotxem }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 ">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $truyen->tentruyen }}</h3>
                            </div>
                            {{-- <div class="anime__details__rating">
                                <div class="rating">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                                <span>1.029 Votes</span>
                            </div> --}}
                            <p>{{ $truyen->tomtat }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Tác giả:</span> {{ $truyen->tacgia }}</li>
                                            <li><span>Số chapter:</span>{{ count($chapter) }}</li>
                                            <li><span>Lượt xem:</span> {{ $truyen->luotxem == 0 ? 0 : $truyen->luotxem }}
                                            </li>
                                            <li><span>Trạng thái:</span> Đang cập nhật</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li>
                                                <span>Danh mục:</span>
                                                @foreach ($danhMucTruyen as $key => $dmuc)
                                                    {{ $dmuc->tendanhmuc == '' ? 'Đang cập nhật' : $dmuc->tendanhmuc }}
                                                    @if ($key < count($danhMucTruyen) - 1)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </li>
                                            <li>
                                                <span>Thể loại:</span>
                                                @foreach ($theLoaiTruyen as $key => $tloai)
                                                    {{ $tloai->tentheloai == null ? 'Đang cập nhật' : $tloai->tentheloai }}
                                                    @if ($key < count($theLoaiTruyen) - 1)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </li>
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
                    <div class="col-9" style="margin-top: 50px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="anime__details__episodes">
                                    <div class="section-title">
                                        <h5>Chương mới nhất</h5>
                                    </div>
                                    @foreach ($chapter as $cter)
                                        <a
                                            href="{{ route('xem-chapter', [$cter->slug_chapter]) }}">{{ $cter->tieude }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <div class="anime__details__review">
                                    <div class="section-title">
                                        <h5>Danh sách chương</h5>
                                    </div>
                                    <div class="anime__details__widget">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <ul>
                                                    @foreach ($chapter as $cter)
                                                        <li>
                                                            <a style="color: white"
                                                                href="{{ route('xem-chapter', [$cter->slug_chapter]) }}">{{ $cter->tieude }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="product__sidebar">
                            <div class="product__sidebar__comment">
                                <div class="section-title">
                                    <h5>Mới cập nhật</h5>
                                </div>
                                @foreach ($truyen_moicapnhat as $tr)
                                    <div class="product__sidebar__comment__item" style=" height:150px">
                                        <div class="product__sidebar__comment__item__pic">
                                            <img style=" width:100px"
                                                src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}" alt="">
                                        </div>
                                        <div class="product__sidebar__comment__item__text">
                                            <ul>
                                                <li>Active</li>
                                                <li>Movie</li>
                                            </ul>
                                            <h5 class="text-truncate" style="max-width: 300px;"><a class=""
                                                    style="font-size: 10px;font-weight: 600" href="#">
                                                    {{ $tr->tentruyen }}
                                                </a></h5>
                                            <span><i class="fa fa-eye"></i> {{ $tr->luotxem == 0 ? 0 : $tr->luotxem }}
                                                Viewes</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
