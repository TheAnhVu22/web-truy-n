@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa thông tin Sách</div>

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
                   {{--  // hiển thị thông báo --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('sach.update',$sach->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="a">Tên Sách</label>
                            <input type="text" value="{{$sach->tensach}}" name="tensach" class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="a">Tác giả</label>
                            <input type="text" value="{{$sach->tacgia}}" name="tacgia" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="a">Slug Sách</label>
                            <input type="text" value="{{$sach->slug_sach}}" name="slug_sach" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="a1">Tóm tắt Sách</label>
                            <textarea class="form-control" name="tomtat" rows="4" style="resize: none;">{{$sach->tomtat}}</textarea>
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="a1">Nội dung Sách</label>
                            <textarea id="noidung_sach" class="form-control" name="noidung" rows="7" style="resize: none;">{{$sach->noidung}}</textarea>
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="a">Từ khóa</label>
                            <input type="text" value="{{$sach->tukhoa}}" name="tukhoa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="a">Lượt xem</label>
                            <input type="text" value="{{$sach->views}}" name="views" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="a">Hình ảnh Sách</label>
                            <input type="file" name="hinhanh" class="form-control-file" >
                            <img src="{{ asset('uploads/sach/'.$sach->hinhanh) }}" width="150" height="100">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="custom-select" name="kichhoat">
                              <@if($sach->kichhoat==0)
                                    <option value="0" selected>Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                 @else
                                    <option value="0" >Kích hoạt</option>
                                    <option value="1" selected>Không kích hoạt</option>
                                @endif
                            </select>
                        </div>
                        <br>
                        <button type="submit" name="themsach" class="btn btn-success">Cập nhật</button>
                        {{-- <input type="submit" value="thêm"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
