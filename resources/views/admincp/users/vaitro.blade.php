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
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Vai trò người dùng</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/insert_roles', [$user->id]) }}" method="POST" style="height: 80vh;">
                                    <div class="row">
                                        <div
                                            class="col-sm-12 border border-1 p-3 mb-1 rounded-1  d-flex  justify-content-start gap-3">
                                            @csrf
                                            <div class="form-group clearfix">
                                                @foreach ($role as $role)
                                                    @if (isset($all_column_roles))
                                                        <div class="icheck-primary d-inline m-2">
                                                            <input value="{{ $role->name }}" type="radio"
                                                                {{ $role->id == $all_column_roles->id ? 'checked' : '' }}
                                                                id="{{ $role->id }}" name="role">
                                                            <label for="{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="icheck-primary d-inline m-2">
                                                            <input value="{{ $role->name }}" type="radio"
                                                                id="{{ $role->id }}" name="role">
                                                            <label for="{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Thêm vai trò người dùng</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('insert_add_roles') }}" method="POST" style="height: 80vh;">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên loại người dùng</label>
                                        <input required name="name_role" type="text" class="form-control"
                                            id="exampleInputEmail1" placeholder="Nhập tên quyền">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
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
