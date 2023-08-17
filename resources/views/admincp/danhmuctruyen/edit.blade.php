@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cập nhât danh mục truyện') }}</div>
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

                        <form method="POST" action="{{ route('danhmuc.update', [$danhmuc->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
                                <input type="text" name="tendanhmuc" value="{{ $danhmuc->tendanhmuc }}"
                                    placeholder="Tên danh mục..." class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mô tả danh mục</label>
                                <input type="text" name="mota" value="{{ $danhmuc->mota }}"
                                    placeholder="Mô tả danh mục..." class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <select name="kichhoat" class="form-select" aria-label="Default select example">
                                    @if ($danhmuc->kichhoat == 0)
                                        <option value={{ 0 }} selected>Kích hoạt</option>
                                        <option value={{ 1 }}>Không kích hoạt</option>
                                    @else
                                        <option value={{ 0 }}>Kích hoạt</option>
                                        <option value={{ 1 }} selected>Không kích hoạt</option>
                                    @endif

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
