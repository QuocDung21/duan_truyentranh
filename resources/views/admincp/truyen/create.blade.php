@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Thêm truyện') }}</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('truyen.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                                <input type="text" value="{{ old('tentruyen') }}" placeholder="Tên truyện..."
                                    name="tentruyen" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                <input type="text" value="{{ old('tacgia') }}" placeholder="Tác giả..." name="tacgia"
                                    class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt truyện</label>
                                <textarea rows="5" type="text" value="{{ old('tomtat') }}" name="tomtat" placeholder="Tóm tắt truyện..."
                                    class="form-control" id="exampleInputEmail1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ảnh truyện</label>
                                <input type="file" class="form-control" name="hinhanh" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                                <select name="kichhoat" class="form-select" aria-label="Default select example">
                                    <option value={{ 0 }} selected>Kích hoạt</option>
                                    <option value={{ 1 }}>Không kích hoạt</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Danh mục truyện</label>
                                <select name="danhmuc_id" class="form-select" aria-label="Default select example">
                                    @foreach ($danhmuc as $dmuc)
                                        <option value={{ $dmuc->id }}>{{ $dmuc->tendanhmuc }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Thể loại</label>
                                <select name="theloai_id" class="form-select" aria-label="Default select example">
                                    @foreach ($theloai as $tloai)
                                        <option value={{ $tloai->id }}>{{ $tloai->tentheloai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="content-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm truyện</h1>
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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Truyện</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Tên danh mục</label>
                                <input type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Project Description</label>
                                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                <select id="inputStatus" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    <option>On Hold</option>
                                    <option>Canceled</option>
                                    <option>Success</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Client Company</label>
                                <input type="text" id="inputClientCompany" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputProjectLeader">Project Leader</label>
                                <input type="text" id="inputProjectLeader" class="form-control">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Budget</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEstimatedBudget">Estimated budget</label>
                                <input type="number" id="inputEstimatedBudget" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputSpentBudget">Total amount spent</label>
                                <input type="number" id="inputSpentBudget" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputEstimatedDuration">Estimated project duration</label>
                                <input type="number" id="inputEstimatedDuration" class="form-control">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create new Project" class="btn btn-success float-right">
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div> --}}
@endsection
