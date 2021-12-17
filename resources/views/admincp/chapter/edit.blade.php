@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật chapter</div>

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
                    
                    <form method="POST" action="{{ route('chapter.update',$chapter->id) }}">
                        @csrf
                        @method('PUT')
                        

                        <div class="form-group">
                            <label for="a">Tiêu đề chapter:</label>
                            <input type="text" value="{{$chapter->tieude}}" name="tieude" class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="a">Slug chapter:</label>
                            <input type="text" value="{{$chapter->slug_chapter}}" name="slug_chapter" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="a1">Tóm tắt:</label>
                            <input type="text" value="{{$chapter->tomtat}}" name="tomtat" class="form-control" id="a1" >
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="a1">Nội dung chapter:</label>
                            <textarea id="noidung_chapter" class="form-control" name="noidung">{!!$chapter->noidung!!}</textarea>
                            <br>
                        </div>
                        <div class="form-group">
                            <label>Thuộc truyện</label>
                            <select class="custom-select" name="truyen_id">
                                @foreach ($truyen as $key => $dulieu)
                                    <option {{ $chapter->truyen_id == $dulieu->id ? 'selected':''}} value="{{$dulieu->id}}">{{$dulieu->tentruyen}}</option>
                           
                                @endforeach
                              
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="custom-select" name="kichhoat">
                              @if($chapter->kichhoat==0)
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
