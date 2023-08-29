@extends('layouts.app')
@section('content')
    @if (session('status'))
        <script>
            $(function() {
                toastr.success('{{ session('status') }}', 'status');
            });
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $(function() {
                    toastr.error('{{ $error }}', 'Error');
                });
            </script>
        @endforeach
    @endif

    <div class="content-wrapper">
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cập nhật truyện</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('truyen.update', [$truyen->id]) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                                    <input type="text" value="{{ $truyen->tentruyen }}" placeholder="Tên truyện..."
                                        name="tentruyen" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                    <input type="text" value="{{ $truyen->tacgia }}" placeholder="Tên tác giả..."
                                        name="tacgia" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                                    <textarea rows="2" type="text" value="{{ old('tag') }}" name="tag" placeholder="Từ khóa..."
                                        class="form-control" id="exampleInputEmail1"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tóm tắt truyện</label>
                                    <textarea rows="5" type="text" value="{{ $truyen->tomtat }}" name="tomtat" placeholder="Tóm tắt truyện..."
                                        class="form-control" id="exampleInputEmail1">{{ $truyen->tomtat }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ảnh truyện</label>
                                    <div class="m-3">
                                        <img src="{{ asset('public/uploads/truyen/' . $truyen->hinhanh) }}" width="150"
                                            height="150" alt="">
                                    </div>
                                    <input type="file" class="form-control" name="hinhanh" />
                                </div>
                                <div class="mb-3">
                                    <select name="kichhoat" class="form-select" aria-label="Default select example">
                                        @if ($truyen->kichhoat == 0)
                                            <option value={{ 0 }} selected>Kích hoạt</option>
                                            <option value={{ 1 }}>Không kích hoạt</option>
                                        @else
                                            <option value={{ 0 }}>Kích hoạt</option>
                                            <option value={{ 1 }} selected>Không kích hoạt</option>
                                        @endif

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Danh mục truyện</label>
                                    <br>
                                    @foreach ($danhmuc as $dmuc)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="danhmuc[]"
                                                @foreach ($danhmucCuaTruyen as $dmt)
                                            @if ($dmt->id == $dmuc->id)
                                            checked
                                            @endif @endforeach
                                                id="danhmuc_{{ $dmuc->id }}" value={{ $dmuc->id }}>
                                            <label class="form-check-label"
                                                for="danhmuc_{{ $dmuc->id }}">{{ $dmuc->tendanhmuc }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Thể loại</label>
                                    <br>
                                    @foreach ($theloai as $tloai)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="theloai[]"
                                                @foreach ($theloaiCuaTruyen as $dmt)
                                            @if ($dmt->id == $tloai->id)
                                            checked
                                            @endif @endforeach
                                                id="theloai_{{ $tloai->id }}" value={{ $tloai->id }}>
                                            <label class="form-check-label"
                                                for="theloai_{{ $dmuc->id }}">{{ $tloai->tentheloai }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="{{ route('truyen.index') }}" class="btn btn-primary">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
