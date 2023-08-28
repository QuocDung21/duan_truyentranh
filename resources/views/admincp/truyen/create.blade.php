@extends('layouts.app')
@section('content')
    @if (session('status'))
        <script>
            $(function() {
                toastr.success('Thêm thành công', 'status');
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
                            <h3 class="card-title">Thêm truyện</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('truyen.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                                    <input type="text" value="{{ old('tentruyen') }}" placeholder="Tên truyện..."
                                        name="tentruyen" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                    <input type="text" value="{{ old('tacgia') }}" placeholder="Tác giả..."
                                        name="tacgia" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tóm tắt truyện</label>
                                    <textarea rows="5" type="text" value="{{ old('tomtat') }}" name="tomtat" placeholder="Tóm tắt truyện..."
                                        class="form-control" id="exampleInputEmail1"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ảnh truyện</label>
                                    <input type="file" class="form-control" name="hinhanh" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                                    <select name="kichhoat" class="form-select" aria-label="Default select example">
                                        <option value={{ 0 }} selected>Kích hoạt</option>
                                        <option value={{ 1 }}>Không kích hoạt</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Danh mục truyện</label>
                                    <br>
                                    @foreach ($danhmuc as $dmuc)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="danhmuc[]"
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
                                                id="theloai_{{ $tloai->id }}" value={{ $tloai->id }}>
                                            <label class="form-check-label"
                                                for="theloai_{{ $dmuc->id }}">{{ $tloai->tentheloai }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a href="{{ route('truyen.index') }}" class="btn btn-primary">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
