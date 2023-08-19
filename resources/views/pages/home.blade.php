@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')
    <h3>Truyện mới cập nhật</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="btn btn-primary">Xem tất cả</div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
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
    </div>
@endsection
