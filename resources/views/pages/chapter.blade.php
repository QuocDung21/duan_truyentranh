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
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a
                            href="{{ route('danh-muc', [$truyen_breadcrumb->danhmuctruyen->slug_danhmuc]) }}">{{ $truyen_breadcrumb->danhmuctruyen != null ? $truyen_breadcrumb->danhmuctruyen->tendanhmuc : 'Đang cập nhật' }}</a>
                        <span> {{ $chapter->truyen->tentruyen }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('danh-muc', [$truyen_breadcrumb->danhmuctruyen->slug_danhmuc]) }}">{{ $truyen_breadcrumb->danhmuctruyen != null ? $truyen_breadcrumb->danhmuctruyen->tendanhmuc : 'Đang cập nhật' }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $chapter->truyen->tentruyen }}
            </li>
        </ol>
    </nav> --}}

    {{-- <div class="container text-center">
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
    </div> --}}
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__title">
                        <h2>{{ $chapter->tieude }}</h2>
                        <div class="blog__details__social">
                            <a href="{{ url('xem-chapter/' . $previous_chapter) }}"
                                class="linkedin  {{ $chapter->id == $min_id->id ? 'isDisabled' : '' }}">
                                Tập trước</a>
                            <a href="{{ url('xem-chapter/' . $next_chapter) }}"
                                class="linkedin  {{ $chapter->id == $max_id->id ? 'isDisabled' : '' }}"> Tập
                                sau </a>
                        </div>
                        <div class="blog__details__social mt-3 d-flex justify-content-center">
                            <select name="select-chapter" class=" text-center select-chapter">
                                @foreach ($all_chapter as $allct)
                                    <option value="{{ url('xem-chapter/' . $allct->slug_chapter) }}">{{ $allct->tieude }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">

                    <div class="blog__details__content">
                        <div class="blog__details__text" style="line-height: 20px">
                            <p>{!! html_entity_decode($chapter->noidung) !!}</p>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item">
                                        <h5 class="{{ $chapter->id == $min_id->id ? 'isDisabled' : '' }}"><a
                                                href="{{ url('xem-chapter/' . $previous_chapter) }} "><i
                                                    class="fas fa-arrow-left"></i> Tập trước</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item next__btn">
                                        <h5 class="{{ $chapter->id == $max_id->id ? 'isDisabled' : '' }}"><a
                                                href="{{ url('xem-chapter/' . $next_chapter) }} ">Tập sau <i
                                                    class="fas fa-arrow-right"></i></a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.prev-chapter').on('click', function() {
            var prevUrl = $(this).hasClass('isDisabled') ? null : '{{ url('xem-chapter/' . $previous_chapter) }}';
            if (prevUrl) {
                window.location.href = prevUrl;
            }
        });

        $('.next-chapter').on('click', function() {
            var nextUrl = $(this).hasClass('isDisabled') ? null : '{{ url('xem-chapter/' . $next_chapter) }}';
            if (nextUrl) {
                window.location.href = nextUrl;
            }
        });
    </script>
@endsection
