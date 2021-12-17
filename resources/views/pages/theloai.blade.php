@extends('..\layout')
{{-- @section('slide')
  @include('pages.slide')
@endsection --}}
@section('content')
<!---------------------- hiển thị đường dẫn -------------------------->
     <div class="card">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active">{{$tentheloai}}</li>
        </ol>
      </nav>
    </div>
</div>
     <h2>{{$tentheloai}}</h2> 
<!------------------sách theo thể loại---------------->
        <hr>
        <h2>Danh sách truyện:</h2>
    <div class="album py-5 ">
    <div class="container">
    <div class="row">
      @php
        $dem = count($truyen);
      @endphp
      @if ($dem==0)
        <div class="card text-center">
          <div class="card-body">
            <h4 class="card-title">Truyện đang cập nhật</h4>
          </div>
        </div>
      @else
      
      @foreach ($truyen as $key => $dulieu)
        
        <div class="col-3">
          <div class="card shadow-sm">
            <img src="{{ asset('uploads/truyen/'.$dulieu->hinhanh) }}" alt="" height="250px">
            <div class="card-body">
                <h5>{{$dulieu->tentruyen}}</h5>
              <p class="card-text">
                      @php
                        $tomtat = substr($dulieu->tomtat, 0,50);
                      @endphp
                      {{$tomtat.'....'}}      
               </p>
              @foreach($dulieu->thuocnhieudanhmuctruyen as $thuocdanh)          
                <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge bg-primary cy-2">{{$thuocdanh->tendanhmuc}}</span></a>
                @endforeach

              @foreach($dulieu->thuocnhieutheloaitruyen as $thuocloai)
                             
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge bg-primary cy-2">{{$thuocloai->tentheloai}}</span></a>
               @endforeach

              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{url('doc-truyen/'.$dulieu->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Xem ngay <i class="fas fa-eye"></i> {{$dulieu->views}}</a>
                  
                </div>
                <small class="text-muted">{{ $dulieu->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>

      @endforeach
        </div>
        
        @endif {{--  end if --}}
      </div>
    </div>  {{-- end sách mới --}}
@endsection