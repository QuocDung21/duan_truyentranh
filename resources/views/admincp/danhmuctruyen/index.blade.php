@extends('layouts.app')
@section('content')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Liệt kê danh mục truyện') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Slug danh mục</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Trạng thái </th>
                                    <th scope="col">Quản lý </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhmuctruyen as $key => $danhmuc)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $danhmuc->tendanhmuc }}</td>
                                        <td>{{ $danhmuc->slug_danhmuc }}</td>
                                        <td>{{ $danhmuc->mota }}</td>
                                        <td>
                                            @if ($danhmuc->kichhoat == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Chưa kích hoạt</span>
                                            @endif
                                        </td>
                                        <td class="d-flex flex-row gap-1">
                                            <a href="{{ route('danhmuc.edit', ['danhmuc' => $danhmuc->id]) }}"
                                                class="btn btn-primary ">Sửa</a>
                                            <form action="{{ route('danhmuc.destroy', ['danhmuc' => $danhmuc->id]) }} "
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa danh mục này không')"
                                                    class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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
                            var status = data === 0 ? 'Chưa kích hoạt' : 'Đã kích hoạt';
                            var colorClass = data === 0 ? 'text-danger' : 'text-success';
                            return '<span class="' + colorClass + '">' + status + '</span>';
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
                event.preventDefault(); // Ngăn việc tải lại trang
                var form = $(this); // Lấy form được gửi
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(), // Chuyển dữ liệu form thành chuỗi query
                    success: function(response) {
                        // Xử lý kết quả thành công ở đây (ví dụ: thông báo thành công)
                        alert('Danh mục đã được thêm thành công');
                        $('.danhmuc_datatable').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Đã xảy ra lỗi khi thêm danh mục');
                    }
                });
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
                        toastr.success('Data Deleted Successfully', 'Success');
                    }, 2000);
                }
            })
        });
    </script>
@endsection
