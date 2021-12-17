<div class="container">
    
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
        </li>
        @role('admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý user
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('user.create') }}">Thêm user</a></li>
            <li><a class="dropdown-item" href="{{ route('user.index') }}">Xem danh sách user</a></li>
          </ul>
        </li>
        @endrole
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý danh mục
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('danhmuc.create') }}">Thêm danh mục</a></li>
            <li><a class="dropdown-item" href="{{ route('danhmuc.index') }}">Xem danh mục</a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý thể loại
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('theloai.create') }}">Thêm thể loại</a></li>
            <li><a class="dropdown-item" href="{{ route('theloai.index') }}">Xem thể loại</a></li>
          </ul>
        </li>
        
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý truyện
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('truyen.create') }}">Thêm truyện</a></li>
            <li><a class="dropdown-item" href="{{ route('truyen.index') }}">Xem danh sách truyện</a></li>
          </ul>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý sách
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('sach.create') }}">Thêm sách</a></li>
            <li><a class="dropdown-item" href="{{ route('sach.index') }}">Xem danh sách sách</a></li>
          </ul>
        </li>
        @hasanyrole('writer|admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Quản lý chapter
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('chapter.create') }}">Thêm </a></li>
            <li><a class="dropdown-item" href="{{ route('chapter.index') }}">Xem chapter</a></li>
          </ul>
        </li>
        @endhasanyrole
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
      </form>
    </div>
  </div>
</nav>
</div>
