@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thêm chapter') }}</div>
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

                        <form method="POST" action="{{ route('chapter.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên chapter</label>
                                <input type="text" name="tieude" value="{{ old('tieude') }}"
                                    placeholder="Tên chapter..." class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt chapter</label>
                                <textarea type="text" name="tomtat" placeholder="Tóm tắt chapter..." class="form-control"
                                    value="{{ old('tomtat') }}" id="exampleInputEmail1" rows="5"></textarea>
                            </div>
                            <div class="mb-3 editor">
                                <label for="exampleInputEmail1" class="form-label">Nội dung chapter</label>
                                <textarea type="text" id="noidung_chapter" name="noidung" placeholder="Nội dung chapter..." class="form-control"
                                    value="{{ old('noidung') }}" id="exampleInputEmail1" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Trạng thái</label>
                                <select name="kichhoat" class="form-select" aria-label="Default select example">
                                    <option value={{ 0 }} selected>Kích hoạt</option>
                                    <option value={{ 1 }}>Không kích hoạt</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Thuộc truyện</label>
                                <select name="truyen_id" class="form-select" aria-label="Default select example">
                                    @foreach ($truyen as $key => $tr)
                                        <option key={{ $key }} value={{ $tr->id }} selected>
                                            {{ $tr->tentruyen }}
                                        </option>
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
