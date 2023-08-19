@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">{{ __('Liệt kê Truyện') }}</div>

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
                                    <th scope="col">Tên truyện</th>
                                    <th scope="col">Tác giả</th>
                                    <th scope="col">Slug truyện</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">truyện</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Quản lý </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($truyen as $key => $tr)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $tr->tentruyen }}</td>
                                        <td>{{ $tr->tacgia ? $tr->tacgia : 'Đang cập nhật' }}</td>
                                        <td>{{ $tr->slug_truyen }}</td>
                                        <td>{{ $tr->tomtat }}</td>
                                        <td>{{ $tr->danhmuctruyen->tendanhmuc }}</td>
                                        <td class="">
                                            @if ($tr->kichhoat == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Chưa kích hoạt</span>
                                            @endif
                                        <td>
                                            <img src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}" width="150"
                                                height="150" alt="">
                                        </td>
                                        </td>
                                        <td class="d-flex flex-row gap-1">
                                            <a href="{{ route('truyen.edit', ['truyen' => $tr->id]) }}"
                                                class="btn btn-primary ">Sửa</a>
                                            <form action="{{ route('truyen.destroy', ['truyen' => $tr->id]) }} "
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa truyện này không')"
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
    </div>
@endsection
