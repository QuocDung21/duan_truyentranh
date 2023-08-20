@extends('../layout')
@section('content')
    <style type="text/css">
        .isDisabled {
            color: currentColor;
            pointer-events: none;
            opacity: 0.5;
            text-decoration: none;
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('danh-muc', [$truyen_breadcrumb->danhmuctruyen->slug_danhmuc]) }}">{{ $truyen_breadcrumb->danhmuctruyen != null ? $truyen_breadcrumb->danhmuctruyen->tendanhmuc : 'Đang cập nhật' }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $chapter->truyen->tentruyen }}
            </li>
        </ol>
    </nav>
    <div class="container text-center">
        <?php
        echo $max_id->id;
        echo $chapter->id;
        ?>
        <div class="">
            <h4>{{ $chapter->truyen->tentruyen }}</h4>
            <p>Chương hiện tại : {{ $chapter->tieude }}</p>
            <label class="" for="">Chọn chương</label>
            <p><a class="btn btn-primary   {{ $chapter->id == $min_id->id ? 'isDisabled' : '' }}"
                    href="{{ url('xem-chapter/' . $previous_chapter) }}">Tập trước</a></p>
            <select name="select-chapter" class="form-select text-center select-chapter">
                @foreach ($all_chapter as $allct)
                    <option value="{{ url('xem-chapter/' . $allct->slug_chapter) }}">{{ $allct->tieude }}</option>
                @endforeach
            </select>
            <p><a class="btn btn-primary  {{ $chapter->id == $max_id->id ? 'isDisabled' : '' }}"
                    href="{{ url('xem-chapter/' . $next_chapter) }}">Tập sau</a></p>
            <div class="col-md-12">
                <div class="container noidungchuong text-center">
                    <p>
                        {{ $chapter->noidung }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
