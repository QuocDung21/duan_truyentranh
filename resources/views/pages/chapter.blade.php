@extends('../layout')
@section('content')
    <style type="text/css">
        .isDisabled {
            color: currentColor;
            pointer-events: none;
            opacity: 0.5;
            text-decoration: none;
        }

        .custom-text-color {
            color: red;
        }

        .ckeditor-content {
            font-size: 16px !important;
            color: #333 !important;
            line-height: 1.6 !important;
        }
    </style>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        {{-- <a
                            href="{{ route('danh-muc', [$truyen_breadcrumb->danhmuctruyen->slug_danhmuc]) }}">{{ $truyen_breadcrumb->danhmuctruyen != null ? $truyen_breadcrumb->danhmuctruyen->tendanhmuc : 'Đang cập nhật' }}</a>
                        <span> {{ $chapter->truyen->tentruyen }}</span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <?php
    echo $max_id->id;
    echo $chapter->id;
    ?>
    <section class="blog-details spad" style="background-color: rgb(244,244,244) ">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__title">
                        <h2 style="color: rgb(65, 64, 64)">{{ $chapter->tieude }}</h2>
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
                            {{-- <p><span class="custom-text-color">{!! html_entity_decode($chapter->noidung) !!}</span></p> --}}
                            <div class="ckeditor-content">
                            </div>
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
        var contentFromCKEditor = {!! json_encode($chapter->noidung) !!};
        var ckEditorContentDiv = document.querySelector('.ckeditor-content');
        ckEditorContentDiv.innerHTML = contentFromCKEditor;
    </script>
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
