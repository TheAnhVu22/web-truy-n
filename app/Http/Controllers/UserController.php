<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;
use Session;
class UserController extends Controller
{
    // -------------------------------xử lý login nhanh giữa các tài khoản -------------------------------
    public function impersonate($id){
        $user = User::find($id);
        if($user){
            // lưu session có tên impersonate, giá trị là:$user->id
            Session::put('impersonate',$user->id);
        }
        return redirect('/home');
    }

    // -------------------------------xử lý phân vai trò -------------------------------
    public function assign_roles(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        // phân vai trò: syncRoles: nếu có thì xóa cái cũ đi, thêm cái mới vào
        $user->syncRoles($data['role']);
        return redirect()->back()->with('status','Thêm vai trò cho user thành công');
    }
    public function phanvaitro($id)
    {
        $user = User::find($id);
        $all_column_roles = $user->roles->first();
        // dd($all_column_roles);
        // die();
        $role = Role::orderBy('id','DESC')->get();
        return view('admincp.user.phanvaitro')->with(compact('role','user','all_column_roles'));
    }

    // -------------------------------xử lý phân quyền -------------------------------
    public function assign_permission(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        $role_id = $user->roles->first()->id;
        // phân quyền: ghi đè lên quyền cũ
        $role = Role::find($role_id);
        $role->syncPermissions($data['permission']);
        
        return redirect()->back()->with('status','Thêm quyền cho user thành công');
    }
    public function phanquyen($id)
    {
        $user = User::find($id);
        $name_roles = $user->roles->first()->name;
        $permission = Permission::orderBy('id','DESC')->get();
        $get_permission_via_role = $user->getPermissionsViaRoles();
        // dd($get_permission_via_role);
        return view('admincp.user.phanquyen')->with(compact('permission','user','name_roles','get_permission_via_role'));
    }

    // -------------------------------thêm quyền + vai trò -------------------------------
    public function insert_per(Request $request)
    {
        $data = $request->all();
        // câu lệnh tạo quyền mới
        Permission::create(['name' =>$data['permission1']]);
        return redirect()->back()->with('status','Thêm quyền mới thành công');
    }
    public function insert_rol(Request $request)
    {
        $data = $request->all();
        // câu lệnh để tạo vai trò
        Role::create(['name' =>$data['role1']]);
        return redirect()->back()->with('status','Thêm vai trò mới thành công');
    }

    // -------------------------------hiển thị trang index -------------------------------
    public function index()
    {   
        //roles và permissions là bảng trong DB
        $user = User::with('roles','permissions')->orderBy('id','DESC')->get();
        return view('admincp.user.index',compact('user'));

        /*------------- Tạo vai trò + quyền ------
            $role = Role::create(['name' => 'admin']);
            $permission = Permission::create(['name' => 'view articles']);

        ------ gán quyền cho vai trò ------------
             $role = Role::find(2);
             $permission = Permission::find(4);
             $role->givePermissionTo($permission);

        ----xóa quyền của role-----------
            $role->revokePermissionTo($permission);

        ---- gán quyền cho user-------------
            auth()->user()->givePermissionTo('edit articles');

        ------ gán vai trò cho user -------
             $user = User::find(1);
             $user->assignRole('admin'); 

        ------ hiển thị quyền cho user -------
             return auth()->user()->permissions;

        ----------- gán quyền trực tiếp cho user----------
            return auth()->user()->getDirectPermissions();

        ------ hiển thị tất cả quyền cho user -------
             return auth()->user()->getAllPermissions();

        --------- lấy quyền của user thông qua vai trò---------
             return auth()->user()->getPermissionsViaRoles();

        ---------lấy user có vai trò là xxx---------
             return User::role('writer')->get();

        ------------ xóa vai trò user --------
            auth()->user()->removeRole('writer');

            return User::permission('add articles')->get(); */
        
    }

    public function create()
    {
        return view('admincp.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
            'email' => 'required|unique:users|max:255',
            'name' => 'required|max:255',
            'password' => 'required|min:8',
            ],
            [
            'email.unique' => 'Email đã được sử dụng!',
            'email.required' => 'Yêu cầu nhập email',
            'email.max' => 'Tối đa 255 ký tự!',
            'name.required' => 'Điền tên người dùng !',
            'password.required' => 'Điền mật khẩu !',
            'password.min' => 'Mật khẩu ít nhất 8 ký tự !',
            
            ]
        );
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];

        // Băm mật khẩu bằng Bcrypt trong Laravel:
        $user->password = Hash::make($data['password']);
       
        $user->save();
        return redirect()->back()->with('status','Thêm user thành công');
    }

 
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
