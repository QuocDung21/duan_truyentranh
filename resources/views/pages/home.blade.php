@extends('../layout')
@section('slide')
    <!-- Breadcrumb Begin -->
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
    <!-- Breadcrumb End -->
    @include('pages.slide')
@endsection
@section('content')
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-12 col-md-12">
                    <div class="trending__product ">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Truyện hot</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">Xem tất cả </a>
                                    {{-- <a href="#" class="primary-btn">Xem tất cả <span class="arrow_right"></span></a> --}}
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
                                                {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div> --}}
                                                <div class="view" style="top: 5px; height: 20px;right: 1px; font-size: 10px"><i class="fa fa-eye"></i> 9141</div>
                                                {{-- <div class="ep"><i class="fa fa-eye"></i> 124</div> --}}
                                                <div class="comment text-truncate"> {{ $tr->tentruyen }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @foreach ($danhmuc as $dmuc)
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
                                        <a href="#" class="primary-btn">Xem tất cả </a>
                                        {{-- <a href="#" class="primary-btn">Xem tất cả <span class="arrow_right"></span></a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                @foreach ($truyen as $key => $tr)
                                    <a href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
                                        <div class="col-lg-2 col-md-6 col-4">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" style="height: 200px; width: 130px;"
                                                    data-setbg="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}">
                                                    <div class="ep">18 / 18</div>
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
                            @foreach ($truyen as $tr)
                                <div class="product__sidebar__comment__item" style=" height:150px">
                                    <div class="product__sidebar__comment__item__pic">
                                        <img style=" width:100px" src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}"
                                            alt="">
                                    </div>
                                    <div class="product__sidebar__comment__item__text">
                                        <ul>
                                            <li>Active</li>
                                            <li>Movie</li>
                                        </ul>
                                        <h5 class="text-truncate" style="max-width: 300px;"><a class=""
                                                style="font-size: 10px;font-weight: 600"
                                                href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">
                                                {{ $tr->tentruyen }}
                                            </a></h5>
                                        <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>Mới cập nhật</h5>
                            </div>
                            @foreach ($truyen as $tr)
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
                                        <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
    {{-- <h3>Truyện mới cập nhật</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="btn btn-primary">Xem tất cả</div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                @foreach ($truyen as $tr)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src=" {{ asset('public/uploads/truyen/download0.png') }}" alt="" srcset="">
                            <div class="card-body">
                                <h5>{{ $tr->tentruyen }}</h5>
                                <p class="card-text">{{ $tr->tomtat }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-sm btn-outline-secondary">Đọc
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
    </div>
    <h3>Truyện xem nhiều</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src=" {{ asset('public/uploads/truyen/download0.png') }}" alt="" srcset="">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a type="button btn-sm btn-outline-secondary"
                                        class="btn btn-sm btn-outline-secondary">Đọc
                                        ngay</a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">2130</button>
                                </div>
                                <small class="text-muted">9 phút trước</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
