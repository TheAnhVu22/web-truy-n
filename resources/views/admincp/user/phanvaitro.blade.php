@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Cấp vai trò cho user : {{$user->name}} - {{$user->id}}</div>

                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif

                <hr>
                <form action="{{url('/assign_roles',[$user->id])}}" method="POST">
                      @csrf
                      
                     {{-- hiển thị tất cả các vai trò ra --}}
                    @foreach($role as $key => $r)

                        <div class="form-check form-check-inline">
                           <!--  ------------------ thẻ input ----------  -->
                          <input class="form-check-input" 
                         {{-- nếu user có vai trò thì checked vào vai trò đấy --}}
                          @if ($all_column_roles!= null)
                              
                           {{$r->id==$all_column_roles->id ? 'checked' : ''}}
                            @endif

                            type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}"> 
                            <!----------- end input --------------->

                          <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                        </div>
  
                    @endforeach
                    <hr>

                    <input type="submit" name="insertroles" value="Cấp vai trò cho user" class="btn btn-success">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form action="{{ url('/insert-roles') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="a">Tên Vai trò</label>
                        <input type="text" value="{{old('role1')}}" name="role1" class="form-control" >
                    </div>
                <input type="submit" name="themvaitro" value="Thêm vai trò" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
