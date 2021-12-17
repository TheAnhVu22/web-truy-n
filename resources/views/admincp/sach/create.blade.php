@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm sách</div>

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
                    
                    <form method="POST" action="{{ route('sach.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="a">Tên sách</label>
                            <input type="text" value="{{old('tensach')}}" name="tensach" class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="a">Tác giả</label>
                            <input type="text" value="{{old('tacgia')}}" name="tacgia" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="a">Slug sách</label>
                            <input type="text" value="{{old('slug_sach')}}" name="slug_sach" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="a1">Tóm tắt sách</label>
                            <textarea class="form-control" name="tomtat" rows="4" style="resize: none;"></textarea>
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="a1">Nội dung sách</label>
                            <textarea id="noidung_sach" class="form-control" name="noidung" rows="7" style="resize: none;"></textarea>
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
                        
                        <br>
                        <div class="form-group">
                            <label for="a">Hình ảnh sách</label>
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
                        <button type="submit" name="themsach" class="btn btn-success">Thêm</button>
                        {{-- <input type="submit" value="thêm"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
