@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="mb-3 ">
                               <label class="m-3" for="">Tóm tắt :</label>
                                {{ $chapter->tomtat }}
                            </div>
                            <div class="mb-3 editor">
                                <textarea type="text"  name="noidung" id="noidung_chapter" placeholder="Nội dung chapter..." class="form-control"
                                    value="{{ $chapter->noidung }}" id="exampleInputEmail1" rows="5">{{ $chapter->noidung }}</textarea>
                            </div>
                            <a href="{{ route('chapter_check.data') }}" class="btn btn-primary">Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
