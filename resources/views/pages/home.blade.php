@extends('../layout')
@section('slide')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.slide')
@endsection
@section('content')
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-12 col-md-12">
                    @foreach ($danhMucList as $dmuc)
                        <div class="trending__product ">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>
                                            {{ $dmuc->tendanhmuc }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="btn__all">
                                        <a href="{{ route('danh-muc', [$dmuc->slug_danhmuc]) }}" class="primary-btn">Xem
                                            tất
                                            cả </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                @foreach ($dmuc->danhSachTruyen as $key => $tr)
                                    <a href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
                                        <div class="col-lg-2 col-md-6 col-4">
                                            <div class="product__item">
                                                <div
                                                    class="product__item__pic set-bg"
                                                    style="height: 200px; width: 130px;"
{{--                                                    data-setbg="{{ filter_var($tr->hinhanh, FILTER_VALIDATE_URL) ? $tr->hinhanh : asset('public/uploads/truyen/' . $tr->hinhanh) }}"--}}
                                                >
                                                    <img  loading="lazy" style="height: 200px; width: 130px;" src="{{ filter_var($tr->hinhanh, FILTER_VALIDATE_URL) ? $tr->hinhanh : asset('public/uploads/truyen/' . $tr->hinhanh) }}" />
                                                    <span class="sr-only">{{$tr->tentruyen}}</span>
                                                    <div class="view"
                                                         style="top: 5px; height: 20px;right: 1px; font-size: 10px"><i
                                                            class="fa fa-eye"></i>
                                                        {{ $tr->luotxem == 0 ? 0 : $tr->luotxem }}</div>
                                                    <div
                                                        class="views mt-1 ml-2"
                                                        style="top: 5px; height: 20px; left: 1px; font-size: 14px;font-weight: bold;">
                                                        @if ($tr->trangthai_truyen == 0)
                                                            <span class="flash">Full</span>
                                                        @endif
                                                    </div>
                                                    <div class="comment text-truncate"> {{ $tr->tentruyen }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
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
                                        <img
                                            loading="lazy"
                                            title="{{$tr->tentruyen}}"
                                            alt="{{$tr->tentruyen}}"
                                            style=" width:100px"
                                            src="{{ filter_var($tr->hinhanh, FILTER_VALIDATE_URL) ? $tr->hinhanh : asset('public/uploads/truyen/' . $tr->hinhanh) }}"
                                            alt=""
                                        >
                                    </div>
                                    <div class="product__sidebar__comment__item__text">
                                        <ul>
                                            @foreach ($tr->thuocnhieutheloaitruyen as $item)
                                                <li>{{ $item->tentheloai }}</li>
                                            @endforeach
                                        </ul>
                                        <h5 class="text-truncate" style="max-width: 300px;"><a class="" style="font-size: 10px;font-weight: 600" href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
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
    </section>
@endsection
