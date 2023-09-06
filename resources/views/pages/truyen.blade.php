@extends('../layout')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a  href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a
                            title="{{ $tendanhmuc_dau->tendanhmuc}}"
                            href="{{ route('danh-muc', [$tendanhmuc_dau->slug_danhmuc]) }}">{{ $tendanhmuc_dau->tendanhmuc }}</a>
                        <span  >{{ $truyen->tentruyen }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg "
                            data-setbg="{{ filter_var($truyen->hinhanh, FILTER_VALIDATE_URL) ? $truyen->hinhanh : asset('public/uploads/truyen/' . $truyen->hinhanh) }}">
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
                            <div class="truncate-text">
                                <p style="color: white !important;">
                                    {!! html_entity_decode($truyen->tomtat) !!}
                                </p>
                            </div>

                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Tác giả:</span> {{ $truyen->tacgia }}</li>
                                            <li><span>Số chapter:</span>{{ count($chapter_all) }}</li>
                                            <li><span>Lượt xem:</span> {{ $truyen->luotxem == 0 ? 0 : $truyen->luotxem }}
                                            </li>
                                            <li><span>Trạng thái:</span>
                                                {{ $truyen->trangthai_truyen == 1 ? 'Đang cập nhật' : 'Đã hoàn thành' }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li>
                                                <span>Danh mục: </span>
                                                @foreach ($danhMucTruyen as $key => $dmuc)
                                                    {{ $dmuc->tendanhmuc == null ? 'Đang cập nhật' : $dmuc->tendanhmuc }}
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
                                       title="{{$chapter_dau->tieude}}}"
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
                    <div class="col-lg-9 col-md-12 col-sm-12" style="margin-top: 50px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="anime__details__episodes">
                                    <div class="section-title">
                                        <h5>Chương mới nhất :</h5>
                                    </div>
                                    @foreach ($chapter_moi as $cter)
                                        <a
                                            title="{{$cter->tieude}}"
                                            href="{{ route('xem-chapter', [$cter->slug_chapter]) }}">{{ $cter->tieude }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="anime__details__review">
                                    <div class="section-title">
                                        <h5>Danh sách chương :</h5>
                                    </div>
                                    <div class="anime__details__widget">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <ul
                                                    style="display: grid !important;
                                                            grid-template-columns: repeat(3, 1fr) ;
                                                            grid-gap: 10px !important;">
                                                    @foreach ($chapter as $cter)
                                                        <li>
                                                            <a style="color: white"
                                                               title="{{$cter->tieude}}"
                                                               href="{{ route('xem-chapter', [$cter->slug_chapter]) }}">{{ $cter->tieude }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-content-center col-lg-12 col-md-12">
                                                {{ $chapter->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="anime__details__episodes ">
                                    <div class="section-title">
                                        <h5>Nội dung :</h5>
                                    </div>
                                    <div id="content">
                                        <p style="color: white">{!! html_entity_decode($truyen->tomtat) !!}</p>
                                    </div>
                                    <button class="btn btn-link" id="loadMore">Xem thêm</button>
                                    <button class="btn btn-link" id="loadLess" style="display: none;">Ẩn bớt</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="anime__details__review">
                                    <div class="section-title">
                                        <h5>Từ khóa :</h5>
                                    </div>
                                    @php
                                        $tukhoa = explode(',', $truyen->tag);
                                    @endphp
                                    @if (count($tukhoa) > 1)
                                        <div class="anime__details__widget">
                                            <div class="row">
                                                <div class="tagcloud05">
                                                    <ul>
                                                        @foreach ($tukhoa as $key => $tu)
                                                            <li><a href="#"><span>{{ $tu }}</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="anime__details__review">
                                    <div class="section-title">
                                        <h5>Bình luận :</h5>
                                    </div>
                                    <div class="fb-comments" style="background-color: white !important" data-mobile
                                        data-href="{{ \URL::current() }}" data-width="100%" data-colorscheme="dark"
                                        width="100%" data-numposts="5"></div>
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
                                @foreach ($truyenmoicapnhat as $tr)
                                    <div class="product__sidebar__comment__item" style=" height:150px">
                                        <div class="product__sidebar__comment__item__pic">
                                            <img style=" width:100px"
                                                src="{{ filter_var($tr->hinhanh, FILTER_VALIDATE_URL) ? $tr->hinhanh : asset('public/uploads/truyen/' . $tr->hinhanh) }}" alt=""
                                            >
                                        </div>
                                        <div class="product__sidebar__comment__item__text">
                                            <ul>
                                                @foreach ($tr->thuocnhieutheloaitruyen as $item)
                                                    <li>{{ $item->tentheloai }}</li>
                                                @endforeach
                                            </ul>
                                            <h5 class="text-truncate" style="max-width: 300px;"><a class=""
                                                    style="font-size: 10px;font-weight: 600"
                                                    href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
                                                    {{ $tr->tentruyen }}
                                                </a></h5>
                                            <span><i class="fa fa-eye"></i> {{ $tr->luotxem != 0 ? $tr->luotxem : 0 }}
                                                lượt
                                                xem</span>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const content = document.getElementById("content");
            const loadMoreButton = document.getElementById("loadMore");
            const loadLessButton = document.getElementById("loadLess");
            const paragraphs = content.getElementsByTagName("p");

            const showMore = function() {
                for (let i = 0; i < paragraphs.length; i++) {
                    paragraphs[i].classList.add("show");
                }
                loadMoreButton.style.display = "none";
                loadLessButton.style.display = "block";
            };

            const showLess = function() {
                for (let i = 3; i < paragraphs.length; i++) {
                    paragraphs[i].classList.remove("show");
                }
                loadMoreButton.style.display = "block";
                loadLessButton.style.display = "none";
            };

            if (paragraphs.length > 3) {
                for (let i = 0; i < 3; i++) {
                    paragraphs[i].classList.add("show");
                }
                loadMoreButton.style.display = "block";
                loadMoreButton.addEventListener("click", showMore);
                loadLessButton.addEventListener("click", showLess);
            }
        });
    </script>
@endsection
