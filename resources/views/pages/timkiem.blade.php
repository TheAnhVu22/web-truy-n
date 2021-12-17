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
     <h2>Từ khóa tìm kiếm: {{$tukhoa}}</h2> 
<!------------------sách theo danh mục---------------->

        <hr>
        <h2>Danh sách truyện:</h2>
    <div class="album py-5">
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

        
        @endif {{--  end if --}}

        <hr>
      <h3>Danh sách Sách:</h3>
      @php
        $dem1 = count($sach);
      @endphp
      @if ($dem1==0)
        <div class="card text-center">
          <div class="card-body">
            <h4 class="card-title">Không tìm thấy sách</h4>
          </div>
        </div>
      @else
      @foreach ($sach as $key => $dulieu)
        
        <div class="col-3">
          <div class="card shadow-sm">
            <img src="{{ asset('uploads/sach/'.$dulieu->hinhanh) }}" alt="" height="250px">
            <div class="card-body">
                <h5>Tên: {{$dulieu->tensach}}</h5>
                <p class="card-text">Tác giả: {{$dulieu->tacgia}}</p>
              <p class="card-text">
                      @php
                        $tomtat = substr($dulieu->tomtat, 0,50);
                      @endphp
                      {{$tomtat.'....'}}      
               </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <form>
                  @csrf

                  <!-- Button trigger modal -->
                  <button type="button" id="{{$dulieu->id}}"class="btn btn-primary xemsachnhanh" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                   <i class="fas fa-eye"></i> {{$dulieu->views}} Xem nhanh 
                  </button>
                
                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel"><div id="tieude_sach"></div></h5>

                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div id="noidung_sach"></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                  
                </div>
                <small class="text-muted">{{ $dulieu->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>

      @endforeach
      @endif
      </div>
      </div>
    </div>  {{-- end sách mới --}}
@endsection