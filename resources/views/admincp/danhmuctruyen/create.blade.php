@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid m-3">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
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
                        <h1>Thêm danh mục </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Project Add</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Danh mục</h3>
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
                                            <th>ID</th>
                                            <th>Tên danh mục</th>
                                            <th>Trạng thái</th>
                                            <th>Mô tả</th>
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
                    <form method="POST" action="{{ route('danhmuc.store') }}" enctype="multipart/form-data"
                        class="ajax-form">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Add New Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <div class="form-group">
                                <label for="inputName">Tên danh mục</label>
                                <input name="tendanhmuc" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Mô tả danh mục</label>
                                <textarea name="mota" value="{{ old('mota') }}" id="inputDescription" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group editpass">
                                <label>Trạng thái</label>
                                <select id="inputStatus" name="kichhoat" class="form-control custom-select"
                                    aria-label="Default select example">
                                    <option value={{ 0 }} selected>Kích hoạt</option>
                                    <option value={{ 1 }}>Không kích hoạt</option>
                                </select>
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
                ajax: "{{ route('danhmuc.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tendanhmuc',
                        name: 'tendanhmuc'
                    },
                    {
                        data: 'kichhoat',
                        name: 'Kích hoạt',
                        render: function(data) {
                            return data === 0 ? 'Chưa kích hoạt' : 'Kích hoạt';
                        }
                    },
                    {
                        data: 'mota',
                        name: 'mota'
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
            $('.ajax-form').submit(function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(), // Chuyển dữ liệu form thành chuỗi query
                    success: function(response) {
                        toastr.success('Thêm danh mục thành công', 'Success');
                        $('.danhmuc_datatable').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Đã xảy ra lỗi khi thêm danh mục');
                    }
                });
            });
        });
        $(document).ready(function() {
            // Xử lý sự kiện click vào nút sửa
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
        $('#ok_button').click(function() {
            $.ajax({
                url: "users/destroy/" + user_id,
                beforeSend: function() {
                    $('#ok_button').text('Deleting...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                        alert('Data Deleted');
                    }, 2000);
                }
            })
        });
    </script>
@endsection
