@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
            
                <div class="card-header">Danh sách Chapter</div>

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
                                <th>Tên chapter</th>
                                <th>Slug chapter</th>
                                <th>Tên truyện</th>
                                <th>Tóm tắt</th>
                               {{--  <th>Nội dung chapter</th> --}}
                                <th>Trạng thái</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        @foreach ($Chapter as $key => $chapter)
                        <tbody>
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$chapter->tieude}}</td>
                                <td>{{$chapter->slug_chapter}}</td>
                                <td>{{$chapter->Truyen->tentruyen}}</td>
                                <td>{{$chapter->tomtat}}</td>
                               {{--  <td>{!!$chapter->noidung!!}</td> --}}
                                <td>
                                    @if($chapter->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('chapter.edit',[$chapter->id])}}" class="btn btn-success">Sửa</a></td>
                                <td>
                                    
                                    <form action="{{ route('chapter.destroy',[$chapter->id])}}" method="POST">
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
