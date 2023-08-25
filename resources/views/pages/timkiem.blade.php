@extends('../layout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Tìm kiếm
            </li>
        </ol>
    </nav>
    <h3>Bạn đang tìm kiếm với từ khóa là : {{ $tukhoa }}</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                @php
                    $count = count($truyen);
                @endphp
                @if ($count == 0)
                    <div class="col-md-12 d-flex">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p>Không tìm thấy truyện...</p>
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
    </div>
@endsection