@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa danh mục truyện</div>

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
                    
                    <form method="POST" action="{{ route('danhmuc.update',$danhmuc->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="a">Tên danh mục</label>
                            <input type="text" value="{{$danhmuc->tendanhmuc}}" name="tendanhmuc" class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="a">Slug Tên danh mục</label>
                            <input type="text" value="{{$danhmuc->slug_danhmuc}}" name="slug_danhmuc" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="a1">Mô tả</label>
                            <input type="text" value="{{$danhmuc->mota}}" name="mota" class="form-control" id="a1" >
                            <br>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="custom-select" name="kichhoat">
                                @if($danhmuc->kichhoat==0)
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
                        {{-- <input type="submit" value="Cập nhật"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
