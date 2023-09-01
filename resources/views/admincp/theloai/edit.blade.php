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
                                <h3 class="card-title">Cập nhật thể loại</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('theloai.update', [$theloai->id]) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tên thể loại</label>
                                        <input required type="text" name="tentheloai" value="{{ $theloai->tentheloai }}"
                                            placeholder="Tên thể loại..." class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Mô tả thể loại</label>
                                        <input required type="text" name="mota" value="{{ $theloai->mota }}"
                                            placeholder="Mô tả thể loại..." class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-3">
                                        <select name="kichhoat" class="form-select" aria-label="Default select example">
                                            @if ($theloai->kichhoat == 0)
                                                <option value={{ 0 }} selected>Kích hoạt</option>
                                                <option value={{ 1 }}>Không kích hoạt</option>
                                            @else
                                                <option value={{ 0 }}>Kích hoạt</option>
                                                <option value={{ 1 }} selected>Không kích hoạt</option>
                                            @endif

                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <a href="{{ route('theloai.index') }}" class="btn btn-primary">Trở về</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
