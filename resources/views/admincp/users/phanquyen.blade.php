@extends('layouts.app')
@section('content')
    @if (session('status'))
        <script>
            $(function() { //ready
                toastr.success('{{ session('status') }}', 'Success');
            });
        </script>
    @endif
    <div class="content-wrapper">
        <section class="content mt-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Phân quyền cho : {{ $all_column_roles->name }}</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/insert_permission', [$user->id]) }}" method="POST"
                                    style="height: 80vh;">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 border border-1 p-3 mb-1 rounded-1">
                                            <div class="row">
                                                @foreach ($permission as $per)
                                                    <div class="col-sm-4">
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-danger d-inline">
                                                                <input value="{{ $per->id }}" type="checkbox"
                                                                    @foreach ($get_permission_via_role as $get)
                                                                        @if ($get->id == $per->id)
                                                                                checked
                                                                        @endif @endforeach
                                                                    name="permission[]" id="{{ $per->id }}">
                                                                <label for="{{ $per->id }}">
                                                                    {{ $per->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                                            <a  href="{{ route('user.index') }}" class="btn btn-primary">Trở về</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Thêm quyền người dùng</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('insert_per_permission') }}" method="POST"
                                    style="height: 80vh;">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên quyền</label>
                                        <input name="name_permission" type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Nhập tên quyền">
                                    </div>
                                    <button type="submit"  class="btn btn-primary">Xác nhận</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection
