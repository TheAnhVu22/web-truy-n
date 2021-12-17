@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
            
                <div class="card-header">Danh sách danh mục truyện</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Slug danh mục</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        @foreach ($mangdl as $key => $danhmuc)
                        <tbody>
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$danhmuc->tendanhmuc}}</td>
                                <td>{{$danhmuc->slug_danhmuc}}</td>
                                <td>{{$danhmuc->mota}}</td>
                                <td>
                                    @if($danhmuc->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('danhmuc.edit',[$danhmuc->id])}}" class="btn btn-success">Sửa</a></td>
                                <td>
                                    
                                    <form action="{{ route('danhmuc.destroy',[$danhmuc->id])}}" method="POST">
                                     @method('DELETE')
                                     @csrf
                                     <button onclick="return confirm('Xác nhận xóa');" type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>

    </div>
</div>
@endsection
