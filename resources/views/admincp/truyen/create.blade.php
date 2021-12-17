@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm truyện</div>

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
                    
                    <form method="POST" action="{{ route('truyen.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="a">Tên truyện</label>
                            <input type="text" value="{{old('tentruyen')}}" name="tentruyen" class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="a">Tác giả</label>
                            <input type="text" value="{{old('tacgia')}}" name="tacgia" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="a">Slug Truyện</label>
                            <input type="text" value="{{old('slug_truyen')}}" name="slug_truyen" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="a1">Tóm tắt truyện</label>
                            <textarea class="form-control" name="tomtat" rows="5" style="resize: none;"></textarea>
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="a">từ khóa</label>
                            <input type="text" value="{{old('tukhoa')}}" name="tukhoa" class="form-control" >
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Lượt xem</label>
                        <input type="text" class="form-control" value="{{old('views')}}" name="views" placeholder="Lượt xem">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục truyện</label>
                      @foreach($mangdl as $key => $muc)
                      <div class="form-check">
                          
                          <input class="form-check-input" name="danhmuc[]" type="checkbox" id="danhmuc_{{$muc->id}}" value="{{$muc->id}}">
                          <label class="form-check-label" for="danhmuc_{{$muc->id}}">{{$muc->tendanhmuc}}</label>
                         
                      </div>
                       @endforeach     
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Tình trạng truyện</label>
                            <select class="custom-select" name="truyen_noibat">
                              <option value="0">Truyện mới cập nhật</option>
                              <option value="1">Truyện nổi bật</option>
                              <option value="2">Truyện xem nhiều</option>
                            </select>
                        </div>
                     
                        <br>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Thể loại</label>
                      @foreach($theloai as $key => $the)
                      <div class="form-check">
                          
                          <input class="form-check-input" name="theloai[]" type="checkbox" id="theloai_{{$the->id}}" value="{{$the->id}}">
                          <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                         
                      </div>
                       @endforeach  
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="a">Hình ảnh Truyện</label>
                            <input type="file" name="hinhanh" class="form-control-file" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="custom-select" name="kichhoat">
                              <option value="0" active>Kích hoạt</option>
                              <option value="1">Không kích hoạt</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" name="themdanhmuc" class="btn btn-success">Thêm</button>
                        {{-- <input type="submit" value="thêm"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
