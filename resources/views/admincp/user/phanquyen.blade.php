@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Cấp quyền cho user : {{$user->name}} - {{$user->id}}</div>

                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif

                <hr>
                <form action="{{url('/assign_permission',[$user->id])}}" method="POST">
                  @csrf

                  @if (isset ($name_roles))
                      Vai trò hiện tại: {{$name_roles}}
                  @endif
                  <br>
                <label>Các quyền :</label>
                
                @foreach($permission as $key => $r)
            
                    <div class="form-check">
                          
                        <input class="form-check-input" name="permission[]"
                          @foreach ($get_permission_via_role as $key => $get)
                              @if ($get->id == $r->id)
                                 checked
                              @endif
                          @endforeach
                           type="checkbox" id="{{$r->id}}" value="{{$r->id}}">
                        <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>   
                    </div>
                @endforeach  
      
                <hr>
                <input type="submit" name="insertroles" value="Cấp quyền cho user" class="btn btn-success">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form action="{{ url('/insert-per') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="a">Tên Quyền</label>
                        <input type="text" value="{{old('permission1')}}" name="permission1" class="form-control" >
                    </div>
                <input type="submit" name="themquyen" value="Thêm quyền" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
