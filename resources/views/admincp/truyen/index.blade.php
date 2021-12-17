@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row justify-content-center">
            
                <div class="card-header">Danh sách truyện</div>

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
                                <th>Tên truyện</th>
                                <th>Ảnh truyện</th>
                                <th>Slug truyện</th>
                                <th>Tác giả</th>
                                {{-- <th>Tóm tắt</th> --}}
                                <th>Từ khóa</th>
                                <th>Danh mục truyện</th>
                                <th>Thể loại truyện</th>
                                <th>Trạng thái</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                <th>Lượt xem</th>
                                <th>Tình trạng truyện</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        @foreach ($list_truyen as $key => $truyen)
                        <tbody>
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$truyen->tentruyen}}</td>
                                <td><img src="{{ asset('uploads/truyen/'.$truyen->hinhanh) }}" width="150" height="100">
                                </td>
                                <td>{{$truyen->slug_truyen}}</td>
                                <td>{{$truyen->tacgia}}</td>
                                {{-- <td>{{$truyen->tomtat}}</td> --}}
                                <td>{{$truyen->tukhoa}}</td>
                                <td>
                            @foreach($truyen->thuocnhieudanhmuctruyen as $thuocdanh)
                              <span class="badge bg-primary cy-2">{{$thuocdanh->tendanhmuc}}</span>
                           @endforeach
                          </td>
                          <td>
                           @foreach($truyen->thuocnhieutheloaitruyen as $thuocloai)
                            <span class="badge bg-primary cy-2">{{$thuocloai->tentheloai}}</span>

                           @endforeach
                          </td>
                                <td>
                                    @if($truyen->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
       <!-------------------------------Hiển thị ngày đăng - Thời gian từ lúc đăng đến bây giờ------------------------------>
                                <td>{{$truyen->created_at}} - {{ $truyen->created_at->diffForHumans()}}</td>
        <!-------------------------------Hiển thị ngày cập nhật - Thời gian từ lúc đăng đến bây giờ------------------------------>
                                <td>
                                    @if ($truyen->updated_at!='')
                                        {{$truyen->updated_at}} - {{ $truyen->updated_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>{{$truyen->views}}</td>
                     <!----------------- truyện nổi bật ------------>           <td width="10%">
                                        @if ($truyen->truyen_noibat==0)
                                            <form>
                                                @csrf
                                                <select class="custom-select truyen_noibat" name="truyen_noibat" data-truyen_id="{{$truyen->id}}">
                                                  
                                                  <option value="0" selected>Truyện mới</option>
                                                  <option value="1">Truyện nổi bật</option>
                                                  <option value="2">Truyện xem nhiều</option>
                                                </select>
                                            </form>
                                        @elseif ($truyen->truyen_noibat==1)
                                            <form>
                                                @csrf
                                                <select class="custom-select truyen_noibat" name="truyen_noibat" data-truyen_id="{{$truyen->id}}">
                                                  
                                                  <option value="0" >Truyện mới</option>
                                                  <option value="1" selected>Truyện nổi bật</option>
                                                  <option value="2">Truyện xem nhiều</option>
                                                </select>
                                            </form>
                                        @else
                                            <form>
                                                @csrf
                                                <select class="custom-select truyen_noibat" name="truyen_noibat" data-truyen_id="{{$truyen->id}}">
                                                  
                                                  <option value="0" >Truyện mới</option>
                                                  <option value="1">Truyện nổi bật</option>
                                                  <option value="2" selected>Truyện xem nhiều</option>
                                                </select>
                                            </form>
                                        @endif

                                    </td>
                     <!----------- nút sửa, xóa ----------->
                                <td><a href="{{ route('truyen.edit',[$truyen->id])}}" class="btn btn-success">Sửa</a></td>
                                <td>
                                    
                                    <form action="{{ route('truyen.destroy',[$truyen->id])}}" method="POST">
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
