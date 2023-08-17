@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thêm danh mục truyện') }}</div>
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

                        <form method="POST" action="{{ route('danhmuc.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
                                <input type="text" name="tendanhmuc" value="{{ old('tendanhmuc') }}"
                                    placeholder="Tên danh mục..." class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mô tả danh mục</label>
                                <input type="text" name="mota" placeholder="Mô tả danh mục..." class="form-control"
                                    value="{{ old('mota') }}" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <select name="kichhoat" class="form-select" aria-label="Default select example">
                                    <option value={{ 0 }} selected>Kích hoạt</option>
                                    <option value={{ 1 }}>Không kích hoạt</option>
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
