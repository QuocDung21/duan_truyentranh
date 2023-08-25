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
                                <h3 class="card-title">Thêm thể loại</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('theloai.store') }}">
                                    @method('POST')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tên thể loại</label>
                                        <input required type="text" name="tentheloai" value=""
                                            placeholder="Tên thể loại..." class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Mô tả thể loại</label>
                                        <input required type="text" name="mota" value=""
                                            placeholder="Mô tả thể loại..." class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Trạng thái</label>
                                        <select name="kichhoat" class="form-select" aria-label="Default select example">
                                            <option value={{ 0 }} selected>Kích hoạt</option>
                                            <option value={{ 1 }}>Không kích hoạt</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Thêm</button>
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
