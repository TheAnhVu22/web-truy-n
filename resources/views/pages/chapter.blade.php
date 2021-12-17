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
          <li class="breadcrumb-item"><a href="{{ url('danh-muc/'.$truyen_breadcrumb->danhmuctruyen->slug_danhmuc) }}">{{$truyen_breadcrumb->danhmuctruyen->tendanhmuc}}</a></li>
          <li class="breadcrumb-item"><a href="{{ url('doc-truyen/'.$truyen_breadcrumb->slug_truyen) }}">{{$truyen_breadcrumb->tentruyen}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$chapter->tieude}}</li>
        </ol>
      </nav>
    </div>
  </div>
  <style type="text/css">
    .isDisable{
      color: currentColor;
      pointer-events: none;
      opacity: 0.5;
      text-decoration: none;
    }
  </style>
  <div class="row">
    <div class="col-12">
      <h4>{{$chapter->truyen->tentruyen}}</h4>
      <p>Chương hiện tại: {{$chapter->tieude}}</p>
      <a href="{{ url('xem-chapter/'.$pre_chapter) }}" class="btn btn-success {{$chapter->id==$min_id->id? 'isDisable':''}}">Chương trước</a>
      <select class="custom-select selectchapter" name="selectchapter">
        <label>Chọn chương:</label>
        @foreach ($allchapter as $key => $dulieu)
          <option value="{{ url('xem-chapter/'.$dulieu->slug_chapter) }}">{{$dulieu->tieude}}</option>
        @endforeach
      </select>
      <a href="{{ url('xem-chapter/'.$next_chapter) }}" class="btn btn-success {{$chapter->id==$max_id->id? 'isDisable':''}}">Chương sau</a>
      <hr>

      <div class="noidungchuong">
        {!!$chapter->noidung!!}
      </div>

      <hr>
      <a href="{{ url('xem-chapter/'.$pre_chapter) }}" class="btn btn-success {{$chapter->id==$min_id->id? 'isDisable':''}}">Chương trước</a>
      <select class="custom-select selectchapter" name="selectchapter">
        <label>Chọn chương:</label>
        @foreach ($allchapter as $key => $dulieu)
          <option value="{{ url('xem-chapter/'.$dulieu->slug_chapter) }}">{{$dulieu->tieude}}</option>
        @endforeach
      </select>
      <a href="{{ url('xem-chapter/'.$next_chapter) }}" class="btn btn-success {{$chapter->id==$max_id->id? 'isDisable':''}}">Chương sau</a>

    </div>
    <!-- ----------------------------------------- chia sẻ facebook ------------------------------------>
          <div class="fb-share-button" data-href="{{\URL::current()}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2F{{\URL::current()}}%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
           <!-- ----------------------------------------- comment facebook ------------------------------------>
          <div class="fb-comments" data-href="{{\URL::current()}}" data-width="" data-numposts="10"></div>

  </div>
  @endsection