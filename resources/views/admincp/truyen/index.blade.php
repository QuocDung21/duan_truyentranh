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
                                <table class="table table-striped table-bordered truyen_datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên truyện</th>
                                            <th>Tác giả</th>
                                            <th>Slug truyện</th>
                                            {{-- <th>Tóm tắt</th> --}}
                                            <th>Trạng thái truyện</th>
                                            <th>Thể loại</th>
                                            <th>Danh mục</th>
                                            <th>Trạng thái</th>
                                            <th>Hình ảnh</th>
                                            <th>Quản lý </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="sample_form" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Bạn chắc chắn muốn xóa ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.truyen_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('truyen.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tentruyen',
                        name: 'tentruyen'
                    },
                    {
                        data: 'tacgia',
                        name: 'tacgia'
                    },
                    {
                        data: 'slug_truyen',
                        name: 'slug_truyen'
                    },
                    // {
                    //     data: 'tomtat',
                    //     name: 'tomtat'
                    // },
                    {
                        data: 'trangthai_truyen',
                        name: 'Trạng thái truyện',
                        render: function(data) {
                            var status = data === 0 ? 'Hoàn thành' : 'Đang cập nhật';
                            var colorClass = data === 0 ? 'text-success' : 'text-danger';
                            return '<span class="' + colorClass + '">' + status + '</span>';
                        }
                    },
                    {
                        data: 'theloai',
                        name: 'theloai'
                    },
                    {
                        data: 'danhmuc',
                        name: 'danhmuc',
                    },
                    {
                        data: 'kichhoat',
                        name: 'Kích hoạt',
                        render: function(data) {
                            var status = data != 0 ? 'Chưa kích hoạt' : 'Đã kích hoạt';
                            var colorClass = data != 0 ? 'text-danger' : 'text-success';
                            return '<span class="' + colorClass + '">' + status + '</span>';
                        }
                    },
                    {
                        data: 'hinhanh',
                        name: 'hinhanh',
                        render: function(data) {
                            return ' <img src="' + data +
                                ' " width="120" height = "120" alt = "" > ';
                        }
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
        var user_id;
        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });


        $('#ok_button').click(function() {
            $.ajax({
                url: "truyen-destroy/" + user_id,
                method: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                // beforeSend: function() {
                //     $('#ok_button').text('Deleting...');
                // },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('.truyen_datatable').DataTable().ajax.reload();
                        toastr.success('Xóa thành công', 'Success');
                    }, 1000);
                }
            });
        });
    </script>
@endsection
