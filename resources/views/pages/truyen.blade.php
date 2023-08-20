@extends('../layout')
@section('content')
    <nav aria-label="breadcrumb">
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
    </div>
@endsection
