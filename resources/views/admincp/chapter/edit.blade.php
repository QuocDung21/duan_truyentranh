@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cập nhật chapter') }}</div>
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

                        <form method="POST" action="{{ route('chapter.update', [$chapter->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên chapter</label>
                                <input type="text" name="tieude" value="{{ $chapter->tieude }}"
                                    placeholder="Tên chapter..." class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt chapter</label>
                                <textarea type="text" name="tomtat" placeholder="Tóm tắt chapter..." class="form-control"
                                    value="{{ $chapter->tomtat }}" id="exampleInputEmail1" rows="5">
                                {{ $chapter->tomtat }}
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nội dung chapter</label>
                                <textarea type="text" name="noidung" placeholder="Nội dung chapter..." class="form-control"
                                    value="{{ $chapter->noidung }}" id="exampleInputEmail1" rows="5">{{ $chapter->noidung }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Trạng thái</label>
                                <select name="kichhoat" class="form-select" aria-label="Default select example">
                                    @if ($chapter->kichhoat == 0)
                                        <option value={{ 0 }} selected>Kích hoạt</option>
                                        <option value={{ 1 }}>Không kích hoạt</option>
                                    @else
                                        <option value={{ 0 }}>Kích hoạt</option>
                                        <option value={{ 1 }} selected>Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Thuộc truyện</label>
                                <select name="truyen_id" class="form-select" aria-label="Default select example">
                                    @foreach ($truyen as $key => $tr)
                                        <option {{ $tr->id == $chapter->truyen_id ? 'selected' : '' }}
                                            value={{ $tr->id }} key={{ $key }}>
                                            {{ $tr->tentruyen }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('chapter.index') }}" class="btn btn-primary">Trở về</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
