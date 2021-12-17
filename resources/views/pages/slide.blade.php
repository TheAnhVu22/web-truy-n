
<br>
<h2>Top truyện, sách hay nên đọc:</h2>
<hr>
<div class="owl-carousel owl-theme">
    @foreach ($slide_truyen as $key => $dulieu)
    <div class="card">
        <img src="{{ asset('uploads/truyen/'.$dulieu->hinhanh) }}" alt="" height="250px">
        <div class="card-body">
        <h5>{{$dulieu->tentruyen}}</h5>
        <p class="card-text">Tác giả: {{$dulieu->tacgia}}</p>
        
        @foreach($dulieu->thuocnhieudanhmuctruyen as $thuocdanh)  
            <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge bg-primary cy-2">{{$thuocdanh->tendanhmuc}}</span></a>
         @endforeach

         @foreach($dulieu->thuocnhieutheloaitruyen as $thuocloai)   <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge bg-primary cy-2">{{$thuocloai->tentheloai}}</span></a>
         @endforeach

        <a href="{{url('doc-truyen/'.$dulieu->slug_truyen)}}" class="btn btn-outline-danger">Xem chi tiết - <i class="fas fa-eye"></i> {{$dulieu->views}}</a>
        </div>
        </div>
    @endforeach
</div>