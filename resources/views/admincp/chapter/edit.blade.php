@extends('layouts.app')
@section('content')
    @if (session('status'))
        <script>
            $(function() {
                toastr.success('{{ session('status') }}', 'Success');
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
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Cập nhật chapter</h3>
                            </div>
                            <div class="card-body">
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
                            <div class="mb-3 editor">
                                <label for="exampleInputEmail1" class="form-label">Nội dung chapter</label>
                                <textarea  type="text" name="noidung" id="noidung_chapter" placeholder="Nội dung chapter..." class="form-control"
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
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
