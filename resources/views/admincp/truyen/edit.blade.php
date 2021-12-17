@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa thông tin truyện</div>

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
                    
                    <form method="POST" action="{{ route('truyen.update',$truyen->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="a">Tên truyện</label>
                            <input type="text" value="{{$truyen->tentruyen}}" name="tentruyen" class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="a">Tác giả</label>
                            <input type="text" value="{{$truyen->tacgia}}" name="tacgia" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="a">Slug Truyện</label>
                            <input type="text" value="{{$truyen->slug_truyen}}" name="slug_truyen" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="a1">Tóm tắt truyện</label>
                            <textarea class="form-control" name="tomtat" rows="5" style="resize: none;">{{$truyen->tomtat}}</textarea>
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="a">Từ khóa</label>
                            <input type="text" value="{{$truyen->tukhoa}}" name="tukhoa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="a">Lượt xem</label>
                            <input type="text" value="{{$truyen->views}}" name="views" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục truyện</label>
                              @foreach($danhmuc as $key => $muc)
                              <div class="form-check">
                                  <input class="form-check-input" 
                                  @if( $thuocdanhmuc->contains($muc->id) ) checked @endif
                                  name="danhmuc[]" type="checkbox" id="danhmuc_{{$muc->id}}" value="{{$muc->id}}">
                                  <label class="form-check-label" for="danhmuc_{{$muc->id}}">{{$muc->tendanhmuc}}</label>                  
                              </div>
                               @endforeach
                        </div>
                        <br>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tình trạng truyện</label>
                        <select name="truyen_noibat" class="custom-select">
                          @if($truyen->truyen_noibat==0)
                          <option selected value="0">Truyện mới</option>
                          <option value="1">Truyện nổi bật</option>
                          <option value="2">Truyện xem nhiều</option>
                          @elseif($truyen->truyen_noibat==1)
                          <option  value="0">Truyện mới</option>
                          <option selected value="1">Truyện nổi bật</option>
                          <option value="2">Truyện xem nhiều</option>
                          @else 
                          <option  value="0">Truyện mới</option>
                          <option  value="1">Truyện nổi bật</option>
                          <option selected value="2">Truyện xem nhiều</option>
                          @endif
                        </select>
                      </div>

                        <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thể loại</label>
                              @foreach($theloai as $key => $the)
                              <div class="form-check">
                                  <input class="form-check-input"
                                   @if( $thuoctheloai->contains($the->id) ) checked @endif
                                  name="theloai[]" type="checkbox" id="theloai_{{$the->id}}" value="{{$the->id}}">
                                  <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                                </div>
                               @endforeach
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="a">Hình ảnh Truyện</label>
                            <input type="file" name="hinhanh" class="form-control-file" >
                            <img src="{{ asset('uploads/truyen/'.$truyen->hinhanh) }}" width="150" height="100">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="custom-select" name="kichhoat">
                              <@if($truyen->kichhoat==0)
                                    <option value="0" selected>Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                 @else
                                    <option value="0" >Kích hoạt</option>
                                    <option value="1" selected>Không kích hoạt</option>
                                @endif
                            </select>
                        </div>
                        <br>
                        <button type="submit" name="themdanhmuc" class="btn btn-success">Cập nhật</button>
                        {{-- <input type="submit" value="thêm"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
