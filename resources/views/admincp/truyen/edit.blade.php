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
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt truyện</label>
                                <textarea rows="5" type="text" value="{{ $truyen->tomtat }}" name="tomtat" placeholder="Tóm tắt truyện..."
                                    class="form-control" id="exampleInputEmail1">{{ $truyen->tomtat }}</textarea>
                            </div>
                            <div class="mb-3 form-control">
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
                                <select name="danhmuc_id" class="form-select" aria-label="Default select example">
                                    @foreach ($danhmuc as $dmuc)
                                        <option {{ $dmuc->id == $truyen->danhmuc_id ? 'selected' : '' }}
                                            value={{ $dmuc->id }}>
                                            {{ $dmuc->tendanhmuc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
