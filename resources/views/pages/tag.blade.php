@extends('..\layout')
{{-- @section('slide')
  @include('pages.slide')
@endsection --}}
@section('content')
<!---------------------- hiển thị đường dẫn -------------------------->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Trang chủ</li>
          <li class="breadcrumb-item active">Tìm kiếm</li>
        </ol>
      </nav>
     <h2>Từ khóa tìm kiếm: {{$tag}}</h2> 
<!------------------sách theo danh mục---------------->

        <hr>
        <h2>Danh sách truyện:</h2>
    <div class="album py-5 bg-light">
    <div class="container">
    <div class="row">
      @php
        $dem = count($truyen);
      @endphp
      @if ($dem==0)
        <div class="card text-center">
          <div class="card-body">
            <h4 class="card-title">Không tìm thấy truyện</h4>
          </div>
        </div>
      @else
      
      @foreach ($truyen as $key => $dulieu)
        
        <div class="col-3">
          <div class="card shadow-sm">
            <img src="{{ asset('uploads/truyen/'.$dulieu->hinhanh) }}" alt="" height="200px">
            <div class="card-body">
                <h5>Tên: {{$dulieu->tentruyen}}</h5>
                <p class="card-text">Tác giả: {{$dulieu->tacgia}}</p>
              <p class="card-text">
                      @php
                        $tomtat = substr($dulieu->tomtat, 0,50);
                      @endphp
                      {{$tomtat.'....'}}      
               </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{url('doc-truyen/'.$dulieu->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Xem ngay</a>
                  <a href="" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>1233</a>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>

      @endforeach
        </div>
        <br>
        <a href="" class="btn btn-outline-info">Xem tất cả</a>
        @endif {{--  end if --}}
      </div>
    </div>  {{-- end sách mới --}}

    
    {{-- {{$truyen->links('pagination::bootstap-5')}} --}}
@endsection