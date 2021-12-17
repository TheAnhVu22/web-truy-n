@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm danh mục truyện</div>

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
                    
                    <form method="POST" action="{{ route('danhmuc.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="a">Tên danh mục</label>
                            <input type="text" value="{{old('tendanhmuc')}}" name="tendanhmuc" class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="a">Slug Tên danh mục</label>
                            <input type="text" value="{{old('slug')}}" name="slug_danhmuc" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="a1">Mô tả</label>
                            <input type="text" value="{{old('mota')}}" name="mota" class="form-control" id="a1" >
                            <br>
                        </div>
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
