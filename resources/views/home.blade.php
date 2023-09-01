@extends('layouts.app')
@section('content')
    @if (session('status'))
        <script>
            $(function() {
                toastr.success('{{ session('status') }}', 'status');
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
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ count($truyen) }}</h3>
                                                <p>Truyện</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="{{ route('truyen.index') }}" class="small-box-footer">Xem thêm <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3>{{ count($theloai) }}</h3>
                                                <p>Thể loại</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="{{ route('theloai.index') }}" class="small-box-footer">Xem thêm <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3>{{ count($danhmuc) }}</h3>
                                                <p>Danh mục</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="{{ route('danhmuc.index') }}" class="small-box-footer">Xem thêm <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3>{{ count($user) }}</h3>
                                                <p>Người dùng</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-pie-graph"></i>
                                            </div>
                                            <a href="{{ route('user.index') }}" class="small-box-footer">Xem thêm <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Tùy chỉnh web</h3>
                                            </div>
                                            <form method="POST"
                                                action="{{ route('update_info_website', [$info_websites->id]) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tên web</label>
                                                        <input type="text" name="name"
                                                            value="{{ $info_websites->name }}" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Nhập tên trang web">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Liên hệ (Email)</label>
                                                        <input type="text" name="contact"
                                                            value="{{ $info_websites->contact }}" class="form-control"
                                                            id="exampleInputPassword1" placeholder="Nhập liên hệ">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Thông tin (Footer)</label>
                                                        <textarea rows={{ 5 }} type="text" name="website_info" class="form-control" id="exampleInputPassword1"
                                                            placeholder="Nhập thông tin ">
                                                            {{ $info_websites->website_info }}
                                                        </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Logo trang web</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="logo"
                                                                    class="custom-file-input" id="exampleInputFile">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>
                                                        </div>
                                                        <div class="m-3">
                                                            <img src="{{ asset('public/uploads/info/logo/logo.png') }}"
                                                                width="150" height="150" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Cập nhật thông tin</h3>
                                            </div>
                                            <form method="POST" action="{{ route('password.change') }}"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="current_password" class="col-sm-2 col-form-label">Mật
                                                            khẩu hiện tại</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" name="current_password"
                                                                class="form-control" id="current_password"
                                                                placeholder="Mật khẩu hiện tại" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="new_password" class="col-sm-2 col-form-label">Mật khẩu
                                                            mới</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" name="new_password"
                                                                class="form-control" id="new_password"
                                                                placeholder="Mật khẩu mới" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="new_password_confirmation"
                                                            class="col-sm-2 col-form-label">Nhập lại mật khẩu mới</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" name="new_password_confirmation"
                                                                class="form-control" id="new_password_confirmation"
                                                                placeholder="Nhập lại mật khẩu mới" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Cập nhật</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
