@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div  class="card-header">{{ __('Liệt kê Chapter') }}</div>

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
                                    <th scope="col">Tên chapter</th>
                                    <th scope="col">Slug chapter</th>
                                    <th scope="col">Tóm tắt</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Thuộc truyện</th>
                                    <th scope="col">Trạng thái </th>
                                    <th scope="col">Quản lý </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chapter as $key => $cter)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $cter->tieude }}</td>
                                        <td>{{ $cter->slug_chapter }}</td>
                                        <td>{{ $cter->tomtat }}</td>
                                        <td>{{ $cter->noidung }}</td>
                                        <td>{{ $cter->truyen->tentruyen }}</td>
                                        <td>
                                            @if ($cter->kichhoat == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Chưa kích hoạt</span>
                                            @endif
                                        </td>
                                        <td class="d-flex flex-row gap-1">
                                            <a href="{{ route('chapter.edit', ['chapter' => $cter->id]) }}"
                                                class="btn btn-primary ">Sửa</a>
                                            <form action="{{ route('chapter.destroy', ['chapter' => $cter->id]) }} "
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa chapter này không')"
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
