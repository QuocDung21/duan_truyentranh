@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thêm truyện') }}</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('truyen.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                                <input type="text" value="{{ old('tentruyen') }}" placeholder="Tên truyện..."
                                    name="tentruyen" class="form-control" id="exampleInputEmail1">
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
                                <select name="danhmuc_id" class="form-select" aria-label="Default select example">
                                    @foreach ($danhmuc as $dmuc)
                                        <option value={{ $dmuc->id }}>{{ $dmuc->tendanhmuc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
