@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row justify-content-center">
            
                <div class="card-header">Danh sách user</div>

                <div class="card-body">
                    <div id="thongbao" class="text-success"></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-hover table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên user</th>
                                <th>Email</th>
                                {{-- <th>Mật khẩu</th> --}}
                                <th>Vai trò</th>
                                <th>Quyền (permission)</th>
                                <th>Quản lý</th>
                                
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                @foreach ($user as $key => $dulieu)
                                    
                               
                                <td scope="row">{{$key}}</td>
                                <td scope="row">{{$dulieu->name}}</td>
                                <td scope="row">{{$dulieu->email}}</td>
                                {{-- <td scope="row">{{$dulieu->password}}</td> --}}
                                
                                <td scope="row">
                                   {{--  lấy ra role của user --}}
                                    @foreach ($dulieu->roles as $key => $role)
                                        {{$role->name}}
                                    @endforeach
                                </td>
                                <td scope="row">
                                    {{--  lấy ra quyền theo role --}}
                                    @if (isset($role))
                                        
                                    
                                    @foreach ($role->permissions as $key => $value)
                                        <span class="badge bg-primary cy-2">{{$value->name}}</span>
                                    @endforeach</td>
                                    @endif
                                <td scope="row">
                                    <a href="{{ url('phan-vaitro/'.$dulieu->id) }}" class="btn btn-success">Phân vai trò</a>

                                    <a href="{{ url('phan-quyen/'.$dulieu->id) }}" class="btn btn-info">phân quyền</a>

                                    <a href="{{ url('impersonate/user/'.$dulieu->id) }}" class="btn btn-danger">Login</a>
                                </td>
                            </tr>
                             @endforeach
                        </tbody>
                        
                    </table>
                </div>

    </div>
</div>
@endsection
