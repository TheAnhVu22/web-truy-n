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
          <li class="breadcrumb-item active">Sách</li>
        </ol>
      </nav>
    </div>
</div>
<!------------------sách theo danh mục---------------->

        <hr>
        <h2>Danh sách Sách:</h2>
    <div class="album py-5">
    <div class="container">
    <div class="row">
      @php
        $dem = count($sach);
      @endphp
      @if ($dem==0)
        <div class="card text-center">
          <div class="card-body">
            <h4 class="card-title">Sách đang cập nhật</h4>
          </div>
        </div>
      @else
      
      @foreach ($sach as $key => $dulieu)
       
        <div class="col-3">
          <div class="card shadow-sm">
            <img src="{{ asset('uploads/sach/'.$dulieu->hinhanh) }}" width="100%" height="200 px">
            <div class="card-body">
                <h5>{{$dulieu->tensach}}</h5>
              <p class="card-text">
                      @php
                        $tomtat = substr($dulieu->tomtat, 0,50);
                      @endphp
                      {{$tomtat.'....'}}      
               </p>
              <div class="d-flex justify-content-between align-items-center">
                
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
                <small class="text-muted">{{ $dulieu->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>

      @endforeach
        
        
        @endif {{--  end if --}}
        </div>
      </div>
    </div>  {{-- end sách mới --}}
@endsection