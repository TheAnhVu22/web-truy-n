@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row justify-content-center">
            
                <div class="card-header">Danh sách Sách</div>

                <div class="card-body">
                    <div id="thongbao" class="text-success"></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-hover table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Sách</th>
                                <th>Ảnh Sách</th>
                                <th>Slug Sách</th>
                                <th>Tác giả</th>
                                {{-- <th>Tóm tắt</th> --}}
                                <th>Từ khóa</th>
                                
                                <th>Trạng thái</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                <th>Lượt xem</th>
                                
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        @foreach ($mangdl as $key => $sach)
                        <tbody>
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$sach->tensach}}</td>
                                <td><img src="{{ asset('uploads/sach/'.$sach->hinhanh) }}" width="150" height="100">
                                </td>
                                <td>{{$sach->slug_sach}}</td>
                                <td>{{$sach->tacgia}}</td>
                                {{-- <td>{{$sach->tomtat}}</td> --}}
                                <td>{{$sach->tukhoa}}</td>
                                
                                <td>
                                    @if($sach->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
       <!-------------------------------Hiển thị ngày đăng - Thời gian từ lúc đăng đến bây giờ------------------------------>
                                <td>{{$sach->created_at}} - {{ $sach->created_at->diffForHumans()}}</td>
        <!-------------------------------Hiển thị ngày cập nhật - Thời gian từ lúc đăng đến bây giờ------------------------------>
                                <td>
                                    @if ($sach->updated_at!='')
                                        {{$sach->updated_at}} - {{ $sach->updated_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>{{$sach->views}}</td>
                    
                     <!----------- nút sửa, xóa ----------->
                                <td><a href="{{ route('sach.edit',[$sach->id])}}" class="btn btn-success">Sửa</a></td>
                                <td>
                                    
                                    <form action="{{ route('sach.destroy',[$sach->id])}}" method="POST">
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
