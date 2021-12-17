@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm người dùng</div>

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
                    
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="a">Tên người dùng</label>
                            <input type="text" value="{{old('name')}}" name="name" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="a">Email</label>
                            <input type="text" value="{{old('email')}}" name="email" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="a">Mật khẩu</label>
                            <input type="text" value="{{old('password')}}" name="password" class="form-control" >
                        </div>
                        
                        <button type="submit" name="themuser" class="btn btn-success">Thêm user</button>
                        {{-- <input type="submit" value="thêm"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
