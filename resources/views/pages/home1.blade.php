@extends('..\layout')
@section('slide')
  @include('pages.slide')
@endsection
@section('content')
<!------------------sách mới---------------->
<style type="text/css">
  a.kytu {
    font-weight: bold;
    padding: 3px 5px;
    color: black;
    font-size: 15px;
    background: burlywood;
    cursor: pointer;
    
}
td a{
  text-decoration: none;
  color: white;
}
</style>
        <hr>
        <h2>Sách, truyện mới cập nhật:</h2>
    <div class="album py-5">
    <div class="container">
    <div class="row">
      @foreach ($truyenmoi as $key => $dulieu)
        
        <div class="col-3">
          <div class="card shadow-sm card-da">
            <img src="{{ asset('uploads/truyen/'.$dulieu->hinhanh) }}" alt="" height="250px">
            <div class="card-body">
                <h5>Tên: {{$dulieu->tentruyen}}</h5>
                <p class="card-text">Tác giả: {{$dulieu->tacgia}}</p>
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
                <small class="text-muted btn">{{ $dulieu->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>

      @endforeach
      {{-- Phân trang sử dụng paginate trong INdexcontroller --}}
   {{$truyenmoi->onEachSide(1)->links('pagination::bootstrap-4')}}
        </div>
        <br>
        <a href="" class="btn btn-outline-info">Xem tất cả</a>
      </div>
    </div>  {{-- end sách mới --}}
    <!------------------sách hot---------------->
        <hr>
        <h2>Sách, truyện xem nhiều:</h2>
    <div class="album py-5">
      <div class="container">
    <div class="row">
      @foreach ($truyenxemnhieu as $key => $dulieu)
        
        <div class="col-3">
          <div class="card shadow-sm card-da">
            <img src="{{ asset('uploads/truyen/'.$dulieu->hinhanh) }}" alt="" height="250px">
            <div class="card-body">
                <h5>Tên: {{$dulieu->tentruyen}}</h5>
                <p class="card-text">Tác giả: {{$dulieu->tacgia}}</p>
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
                <small class="text-muted btn">{{ $dulieu->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>

      @endforeach
      {{-- Phân trang sử dụng paginate trong INdexcontroller --}}
   {{$truyenxemnhieu->onEachSide(1)->links('pagination::bootstrap-4')}}
        </div>
        <br>
        <a href="" class="btn btn-outline-info">Xem tất cả</a>
      </div>
      
    </div>  {{-- end sách hot --}}
    <!------------------Truyện theo thể loại---------------->
        <hr>
        <h2>Truyện theo thể loại:</h2>
    <div class="album">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        @php
        $i = 0;
        @endphp
        @foreach($danhmuc as $key => $tab_danhmuc)
        @php
        $i++;
        @endphp
        <form>
            @csrf
        <li class="nav-item {{$i==1 ? 'active' : ''}}">
          <a data-danhmuc_id="{{$tab_danhmuc->id}}" class="nav-link tabs_danhmuc" data-toggle="tab" href="#{{$tab_danhmuc->slug_danhmuc}}">{{$tab_danhmuc->tendanhmuc}}</a>
        </li>
        </form>

        @endforeach

      </ul>
     <div id="tab_danhmuctruyen" class="row"></div>
    </div>  {{-- end thể loại --}}

   {{--  Lọc truyện theo ký tự --}}
   <hr>
    <h3 class="title_truyen">Lọc truyện sách theo A - Z</h3>
    <a class="kytu" href="{{url('/kytu/0-9')}}">0-9</a>
    @foreach (range('A', 'Z') as $char)
    <a class="kytu" href="{{url('/kytu/'.$char)}}">{{$char}}</a>
    @endforeach

@endsection