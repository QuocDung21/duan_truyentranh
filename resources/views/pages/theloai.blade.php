@extends('../layout')
@section('content')
    @php
        echo $count = count($truyen);
    @endphp
    @if ($count == 0)
        <section class="product-page spad ">
            <div class="container" style="height: 100vh;">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="product__page__content">
                            <div class="product__page__title">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-6">
                                        <div class="section-title">
                                            <h4>Truyện đang cập nhật</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="product__page__filter">
                                            <p>Order by:</p>
                                            <select>
                                                <option value="">A-Z</option>
                                                <option value="">1-10</option>
                                                <option value="">10-50</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="product-page spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product__page__content">
                            <div class="product__page__title">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-6">
                                        <div class="section-title">
                                            <h4>{{ $theloai_id->tentheloai }}</h4>
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
                        <div class="product__pagination">
                            <a href="#" class="current-page">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#"><i class="fa fa-angle-double-right"></i></a>
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
                                                src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}" alt="">
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
    @endif

    <!-- Product Section End -->
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('the-loai', [$theloai_id->slug_theloai]) }}">
                    {{ $theloai_id->tentheloai }}
                </a>
            </li>
        </ol>
    </nav>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                @php
                    echo $count = count($truyen);
                @endphp
                @if ($count == 0)
                    <div class="col-md-12 d-flex">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p>Thể loại đang cập nhật...</p>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach ($truyen as $tr)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img style=" height: 250px; object-fit: cover" class="card-img-top"
                                src=" {{ asset('public/uploads/truyen/' . $tr->hinhanh) }}" alt="" srcset="">
                            <div class="card-body">
                                <h5>{{ $tr->tentruyen }}</h5>
                                <p class="card-text">{{ $tr->tomtat }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ url('xem-truyen/' . $tr->slug_truyen) }}" type="button"
                                            class="btn btn-sm btn-outline-secondary">Đọc
                                            ngay</a>
                                        <a type="button" class="btn btn-sm btn-outline-secondary">2130</a>
                                    </div>
                                    <small class="text-muted">9 phút trước</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}
@endsection
