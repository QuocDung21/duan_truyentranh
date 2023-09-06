@extends('../layout')
@section('content')
    @php
        $count = count($truyen);
    @endphp
        <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="#">Danh mục</a>
{{--                        <span>{{ $tendanhmuc }}</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <section class="product-page spad ">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
{{--                                        <h4>{{ $tendanhmuc }}</h4>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($truyen as $key => $tr)
                                <a href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
                                    <div class="col-lg-2 col-md-6 col-4">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" style="height: 200px;width: 130px; "
                                                 data-setbg="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}">
                                                <div class="view"
                                                     style="top: 5px; height: 20px;right: 1px; font-size: 10px"><i
                                                        class="fa fa-eye"></i>
                                                    {{ $tr->luotxem == 0 ? 0 : $tr->luotxem }}</div>
                                                <div
                                                    class="views mt-1 ml-2"style="top: 5px; height: 20px; left: 1px; font-size: 14px;font-weight: bold;">
                                                    @if ($tr->trangthai_truyen == 0)
                                                        <span class="flash">Full</span>
                                                    @endif
                                                </div>
                                                <div class="comment text-truncate"> {{ $tr->tentruyen }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
{{--                    <div class="product__pagination">--}}
{{--                        <a href="#" class="current-page">1</a>--}}
{{--                        <a href="#">2</a>--}}
{{--                        <a href="#">3</a>--}}
{{--                        <a href="#">4</a>--}}
{{--                        <a href="#">5</a>--}}
{{--                        <a href="#"><i class="fa fa-angle-double-right"></i></a>--}}
{{--                    </div>--}}
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
                                        <img style=" width:100px" src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}"
                                             alt="">
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
                                        <span><i class="fa fa-eye"></i> {{ $tr->luotxem != 0 ? $tr->luotxem : 0 }} lượt
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
