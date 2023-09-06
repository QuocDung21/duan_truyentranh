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
            font-size: 24px !important;
            color: #333 !important;
            line-height: 1.7 !important;
        }

        .select-columns {
            display: block !important;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px !important;
            padding: 10px;
            border-radius: 5px
        }
        iframe {
            display: none !important;
        }

        .nice-select {
            display: none !important;
        }
    </style>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a
                            href="{{ route('xem-truyen', [$truyen_breadcrumb->slug_truyen]) }}">{{ $truyen_breadcrumb->tentruyen }}</a>
                        <span> {{ $chapter->tieude }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="blog-details spad" style="background-color: rgb(244,244,244) ">
        <div class="container">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-8">
                    <div class="blog__details__title">
                        <h2 style="color: rgb(65, 64, 64)">{{ $chapter->tieude }}</h2>
                        <div class="blog__details__social">
                            @if ($previous_chapter != null)
                                <a href="{{ url('xem-chapter/' . $previous_chapter->slug_chapter) }}" class="linkedin">
                                    Tập trước</a>
                            @else
                                <a href="{{ url('xem-chapter/') }}" class="linkedin  isDisabled }}">
                                    Tập trước</a>
                            @endif

                            @if ($next_chapter != null)
                                <a href="{{ url('xem-chapter/' . $next_chapter->slug_chapter) }}" class="linkedin"> Tập
                                    sau </a>
                            @else
                                <a href="{{ url('xem-chapter/') }}" class="linkedin  isDisabled }}"> Tập
                                    sau </a>
                            @endif
                        </div>
                        <div class="blog__details__social mt-3 d-flex justify-content-center ">
                            <select class="text-center select-chapter select-columns">
                                @foreach ($all_chapter as $allct)
                                    @php
                                        $parts = explode('-', $allct->tieude);
                                        $data_to_display = trim($parts[0]);
                                    @endphp
                                    <option value="{{ url('xem-chapter/' . $allct->slug_chapter) }}">{{ $data_to_display }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
                                @if ($previous_chapter != null)
                                    <div class="col-lg-6">
                                        <div class="blog__details__btns__item">
                                            <h5><a style="color: black;cursor: pointer;"
                                                    href="{{ url('xem-chapter/' . $previous_chapter->slug_chapter) }}"><i
                                                        style="color: black" class="fas fa-arrow-left"></i> Tập
                                                    trước</a>
                                            </h5>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="blog__details__btns__item">
                                            <h5 class="isDisabled"><a style="color: black;cursor: pointer;"
                                                    href="{{ url('xem-chapter/') }}"><i style="color: black"
                                                        class="fas fa-arrow-left"></i> Tập
                                                    trước</a>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if ($next_chapter != null)
                                    <div class="col-lg-6">
                                        <div class="blog__details__btns__item next__btn">
                                            <h5 class=""><a style="color: black"
                                                    href="{{ url('xem-chapter/' . $next_chapter->slug_chapter) }} ">Tập
                                                    sau <i style="color: black" class="fas fa-arrow-right"></i></a></h5>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="blog__details__btns__item next__btn">
                                            <h5 class="isDisabled"><a style="color: black"
                                                    href="{{ url('xem-chapter/') }} ">Tập
                                                    sau <i style="color: black" class="fas fa-arrow-right"></i></a></h5>
                                        </div>
                                    </div>
                                @endif
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
