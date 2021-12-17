@extends('..\layout')
{{-- @section('slide')
  @include('pages.slide')
@endsection --}}
@section('content')
  <!---------------------- hiển thị đường dẫn -------------------------->
  <div class="card">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb"">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="{{ url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc) }}">{{$truyen->danhmuctruyen->tendanhmuc}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$truyen->tentruyen}}</li>
        </ol>
      </nav>
    </div>
  </div>
  <hr>
  <!---------------------- hiển thị nội dung truyện -------------------------->
    <div class="row">
       <div class="col-10">
        <!---------------------- Tổng quan truyện -------------------------->
          <div class="row">
              <div class="col-3">
                <img src="{{ asset('uploads/truyen/'.$truyen->hinhanh) }}" alt="" width="100%" height="200" class="card-img-top">
              </div>
              <div class="col-9">
                <style type="text/css">
                  .infotruyen{
                    list-style: none;
                  }
                </style>
                  <ul class="infotruyen">

            <!----------- lấy biến wishlist xử lý trong layout --->
                  <input type="hidden" value="{{$truyen->tentruyen}}" class="wishlist_title">
                  <input type="hidden" value="{{\URL::current()}}" class="wishlist_url">
                 <input type="hidden" value="{{$truyen->id}}" class="wishlist_id">
            <!-----------end lấy biến wishlist xử lý trong layout --->

                    <li><h4>Tên truyện: {{$truyen->tentruyen}}</h4></li>
                    <li>Tác giả: {{$truyen->tacgia}}</li>
                    <li>Danh mục truyện: 
                      @foreach($truyen->thuocnhieudanhmuctruyen as $thuocdanh)  
                          <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge bg-primary cy-2">{{$thuocdanh->tendanhmuc}}</span></a>
                       @endforeach
                    </li>
                    <li>Thể loại: 
                        @foreach($truyen->thuocnhieutheloaitruyen as $thuocloai)   <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge bg-primary cy-2">{{$thuocloai->tentheloai}}</span></a>
                         @endforeach
                     </li>
                    <li>Số lượt xem: <i class="fas fa-eye"></i> {{$truyen->views}}</li>
                    <li>Ngày đăng: {{ $truyen->created_at->diffForHumans()}}</li>
                    <li>Số chapter: {{count($chapter)}}</li>
                    <li><a href="">Xem mục lục</a></li>
                   
                    @if (!$chapter_dau)
                      <h4>Chuyện đang cập nhật</h4>
                    @else
                      <li><a href="{{ url('xem-chapter/'.$chapter_dau->slug_chapter) }}" class="btn btn-info"><i class="fas fa-glasses"></i> Đọc online</a></li>
                      <li>
                        <button class="btn btn-danger btn-thich_truyen mt-2"><i class="fa fa-heart" aria-hidden="true"></i> Thích truyện</button>
                      </li>
                      <li><a href="{{ url('xem-chapter/'.$chapter_moinhat->slug_chapter) }}" class="btn btn-success mt-2">Đọc chương mới nhất <i class="fas fa-angle-right"></i></a></li>
                    @endif
                    
                  </ul>
              </div>
          </div> 
          <!---------------------- mô tả truyện -------------------------->
          <div class="col-md-12">
            <h4>Tóm tắt truyện:</h4>
            {{$truyen->tomtat}}
          </div>
          <hr>

          <!-------------thẻ tag-------------->
          <h4>Từ khóa: </h4>
          @php
          // explode: chia chuỗi theo dấu phẩy, hoặc thay bằng dấu khác
            $tukhoa = explode(",", $truyen->tukhoa)
          @endphp
          @foreach ($tukhoa as $key => $tu)
         {{--  Str::slug : helper trong laravel, giúp tạo url thân thiện hơn(bằng dấu - thay vì % giữa các từ)  --}}
            <a href="{{ url('tag/'.\Str::slug($tu)) }}"><span class="badge bg-primary cy-2" style="padding: 10px; "> {{$tu}}</span></a>
          @endforeach
          
          <!---------------------- Mục lục -------------------------->
          <h4>Mục lục</h4>
          <ul class="mucluc">
            @php
              $dem = count($chapter); 
            @endphp
            @if ($dem==0)
              <div class="card">
                <div class="card-body">
                  <h3>Truyện đang được cập nhật</h3>
                </div>
              </div>
            @else
           @foreach ($chapter as $key => $dulieu)
             <li><a href="{{ url('xem-chapter/'.$dulieu->slug_chapter) }}">{{$dulieu->tieude}}</a></li>
           @endforeach 
           @endif          
          </ul>

          <!-- ----------------------------------------- chia sẻ facebook ------------------------------------>
          <div class="fb-share-button" data-href="{{\URL::current()}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2F{{\URL::current()}}%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
           <!-- ----------------------------------------- comment facebook ------------------------------------>
          <div class="fb-comments" data-href="{{\URL::current()}}" data-width="" data-numposts="10"></div>

          <!---------------------- Sách cùng thể loại -------------------------->
          <h4>Sách cùng thể loại</h4>
            <div class="row">
              @foreach ($cungdanhmuc as $key => $dulieu)
        
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
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{url('doc-truyen/'.$dulieu->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Xem ngay <i class="fas fa-eye"></i> {{$dulieu->views}}</a>
                  
                </div>
                <small class="text-muted">{{ $truyen->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>

      @endforeach
            </div> {{-- End row sách cùng thể loại--}}
        <br>
        <a href="{{ url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc) }}" class="btn btn-outline-info">Xem tất cả</a>
        <!---------------------- end sách cùng thể loại -------------------------->
      </div>  {{-- End col-9 hiển thị nội dung--}}
     
{{-- Sách xem nhiều --}}
       <div class="col-2">
         <h3>Sách hay xem nhiều:</h3>
         @foreach ($truyenxemnhieu as $key => $dulieu)
        <div class="card shadow-sm mt-1">
            <img src="{{ asset('uploads/truyen/'.$dulieu->hinhanh) }}" alt="">
            <div class="card-body">
                <h5>{{$dulieu->tentruyen}}</h5>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{url('doc-truyen/'.$dulieu->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Xem ngay <i class="fas fa-eye"></i> {{$dulieu->views}}</a>
                  
                </div>
          
              </div>
            </div>
          </div>
      @endforeach
{{-- hiển thị truyện yêu thích --}}
<hr>
      <h3 class="title_truyen" class="card-header">Truyện yêu thích:</h3>
    <div id="yeuthich"></div>

       </div>
{{--end Sách xem nhiều --}}

    </div> {{-- End row toàn bộ--}}
@endsection