@extends('layouts.app')
@section('content')
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="sample_form" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Bạn chắc chắc muốn xóa?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="container-fluid m-3">
            @if (session('status'))
                <script>
                    $(function() { //ready
                        toastr.success('{{ session('status') }}', 'Success');
                    });
                </script>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <button id="create_data" class="btn btn-primary">Thêm người dùng </button>
                    </div>
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Project Add</li>
                        </ol>
                    </div> --}}
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Quản lý người dùng</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered danhmuc_datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            {{-- <th>Pasword</th> --}}
                                            <th>Vai trò</th>
                                            <th>Quyền</th>
                                            <th width="180px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="quickForm" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Thêm/Sửa User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên người dùng</label>
                                <input required type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input required type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input required type="password" name="password" class="form-control"
                                    id="exampleInputPassword1" placeholder="">
                            </div>
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="action_button" id="action_button" value="Add"
                                class="btn btn-info" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.danhmuc_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'quyen',
                        name: 'quyen'
                    },
                    {
                        data: 'vaitro',
                        name: 'vaitro'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
        $(document).ready(function() {
            $('.danhmuc_datatable').on('click', '.edit', function() {
                var row = $(this).closest('tr'); // Lấy hàng bảng
                var id = row.find('td:eq(0)').text(); // Lấy giá trị ID từ cột đầu tiên
                var tendanhmuc = row.find('td:eq(1)').text(); // Lấy giá trị Tên danh mục từ cột thứ 2
                var mota = row.find('td:eq(3)').text(); // Lấy giá trị Mô tả từ cột thứ 4
                var kichhoat = row.find('td:eq(2)').data(
                    'kichhoat'); // Lấy giá trị Trạng thái từ cột thứ 3 (thường là dữ liệu custom attribute)
                $('#inputId').val(id);
                $('#inputName').val(tendanhmuc);
                $('#inputDescription').val(mota);
                $('#inputStatus').val(kichhoat);
                $('#formModal').modal('show');
            });
        });
        var id;
        $(document).on('click', '.deletes', function() {
            id = $(this).attr('id');
            $('#ok_button').text('Delete');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            $.ajax({
                url: "user-destroy/" + id,
                method: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    $('#ok_button').text('Deleting...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('.danhmuc_datatable').DataTable().ajax.reload();

                        toastr.success('Xóa thành công', 'Success');
                    }, 1000);
                }
            });
        });
        $('#create_data').on('click', function(event) {
            event.preventDefault();
            $('.modal-title').text('Thêm người dùng');
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#formModal').modal('show');
        });
    </script>
@endsection
