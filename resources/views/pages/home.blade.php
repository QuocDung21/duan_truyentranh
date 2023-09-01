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
                <div class="col-lg-1"></div>
                <div class="col-lg-10 col-sm-12 col-md-12">
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
                                        <a href="{{ route('danh-muc', [$dmuc->slug_danhmuc]) }}" class="primary-btn">Xem tất
                                            cả </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                @foreach ($dmuc->danhSachTruyen as $key => $tr)
                                    <a href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
                                        <div class="col-lg-2 col-md-6 col-4">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" style="height: 200px;width: 130px; "
                                                    data-setbg="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}">
                                                    <div class="view"
                                                        style="top: 5px; height: 20px;right: 1px; font-size: 10px"><i
                                                            class="fa fa-eye"></i>
                                                        {{ $tr->luotxem == 0 ? 0 : $tr->luotxem }}</div>
                                                    <div class="comment text-truncate"> {{ $tr->tentruyen }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="trending__product ">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>
                                        Truyện mới cập nhật
                                    </h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('danh-muc', [$dmuc->slug_danhmuc]) }}" class="primary-btn">Xem tất
                                        cả </a>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            @foreach ($truyenmoicapnhat as $key => $tr)
                                <a href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
                                    <div class="col-lg-2 col-md-6 col-4">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" style="height: 200px;width: 130px; "
                                                data-setbg="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}">
                                                <div class="view"
                                                    style="top: 5px; height: 20px;right: 1px; font-size: 10px"><i
                                                        class="fa fa-eye"></i>
                                                    {{ $tr->luotxem == 0 ? 0 : $tr->luotxem }}</div>
                                                <div class="comment text-truncate"> {{ $tr->tentruyen }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
    </section>
@endsection
