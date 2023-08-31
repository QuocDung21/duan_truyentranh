@extends('../layout')
@section('content')
    <style type="text/css">
        .isDisabled {
            color: currentColor;
            pointer-events: none;
            opacity: 0.5;
            text-decoration: none;
        }

        .ckeditor-content p {
            font-size: 20px !important;
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
    {{-- {{ $next_chapter }} --}}
    {{ $next_chapter }}
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
                        {{-- <div style="display: flex;justify-content: center;margin-top: 2px;" class="format-toolbar">
                            <select id="font-size-select">
                                <option value="">Chọn kích thước chữ</option>
                                <option value="12px !important">Nhỏ</option>
                                <option value="16px !important">Vừa</option>
                                <option value="20px !important">Lớn</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="blog__details__content">
                        <div class="blog__details__texts" style="line-height: 20px">
                            <div class="ckeditor-content">
                            </div>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item">
                                        <h5 {{-- class="{{ $chapter->id == $min_id->id ? 'isDisabled' : '' }}" --}}><a style="color: black;cursor: pointer;"
                                                href="{{ url('xem-chapter/' . $previous_chapter) }} "><i
                                                    style="color: black" class="fas fa-arrow-left"></i> Tập
                                                trước</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item next__btn">
                                        <h5 {{-- class="{{ $chapter->id == $max_id->id ? 'isDisabled' : '' }}" --}}><a style="color: black"
                                                href="{{ url('xem-chapter/' . $next_chapter) }} ">Tập
                                                sau <i style="color: black" class="fas fa-arrow-right"></i></a></h5>
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

        $('#test').on('change', function() {
            // Lưu giá trị vào localStorage
            localStorage.setItem('font-size', $(this).val());

            // Áp dụng giá trị font-size vào phần tử p (ví dụ)
            var pElement = document.querySelector('.ckeditor-content p');
            pElement.style.fontSize = selectedValue;
        });

        var contentFromCKEditor = {!! json_encode($chapter->noidung) !!};
        var ckEditorContentDiv = document.querySelector('.ckeditor-content');
        ckEditorContentDiv.innerHTML = contentFromCKEditor;



        // var fontSizeSelect = document.querySelector('#font-size-select');
        // fontSizeSelect.addEventListener('change', function() {
        //     alert("height");
        // })

        // Lắng nghe sự kiện khi người dùng thay đổi tùy chọn
        $('#test').on('change', async function() {
            var selectedValue = fontSizeSelect.value;
            // Lưu giá trị vào localStorage
            localStorage.setItem('font-size', selectedValue);

            // Áp dụng giá trị font-size vào phần tử p (ví dụ)
            var pElement = document.querySelector('.ckeditor-content p');

            await pElements.forEach(function(pElement) {
                pElement.style.fontSize = selectedValue;
                if (selectedValue === "") {
                    pElement.removeAttribute("style");
                }
            });

            pElements.forEach(function(pElement) {
                pElement.style.fontSize = selectedValue;
            });
        });



        // Lấy giá trị font-size từ localStorage
        var fontSize = localStorage.getItem('font-size');

        // Kiểm tra xem có giá trị trong localStorage hay không
        if (fontSize) {
            // Áp dụng giá trị font-size vào phần tử p
            var pElement = document.querySelector('.ckeditor-content p');
            pElement.style.fontSize = fontSize + 'px';
        }
    </script>
@endsection
