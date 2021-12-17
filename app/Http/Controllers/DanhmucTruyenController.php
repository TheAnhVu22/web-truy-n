<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
class DanhmucTruyenController extends Controller
{
     public function __construct()
    {
        // có 1 trong các quyền này thì sẽ vào đc index + show
        $this->middleware('permission:publish danh muc|edit danh muc|delete danh muc|add danh muc',['only' => ['index','show']]);
        // với mỗi quyền thì có các chức năng riêng nữa
         $this->middleware('permission:add danh muc', ['only' => ['create','store']]);
         $this->middleware('permission:edit danh muc', ['only' => ['edit','update']]);
         $this->middleware('permission:delete danh muc', ['only' => ['destroy']]);
    }
    public function index()
    {
        // $mangdl = DanhmucTruyen::all();
        $mangdl = DanhmucTruyen::orderBy('id','DESC')->get();
       return view('admincp.danhmuctruyen.index',compact('mangdl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admincp.danhmuctruyen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // kiểm tra validate cho form
        $data = $request->validate(
            [
            'tendanhmuc' => 'required|unique:danhmuc|max:255',
            'slug_danhmuc' => 'required|unique:danhmuc|max:255',
            'mota' => 'required',
            'kichhoat' => 'required',
            ],
        // tùy chỉnh thông báo validate
            [
            'tendanhmuc.unique' => 'Tên danh mục đã có, điền tên khác!',
            'slug_danhmuc.unique' => 'slug danh mục đã có, điền slug khác!',
            'tendanhmuc.max' => 'Tối đa 255 ký tự!',
            'tendanhmuc.required' => 'Điền tên danh mục !',
            'mota.required' => 'Ghi mô tả !', 
            ]
    );
        //$data = $request->all();
        // cách 1: dùng Eloquent Model
        $DanhmucTruyen = new DanhmucTruyen();
        $DanhmucTruyen->tendanhmuc = $data['tendanhmuc'];
        $DanhmucTruyen->slug_danhmuc = $data['slug_danhmuc'];
        $DanhmucTruyen->mota = $data['mota'];
        $DanhmucTruyen->kichhoat = $data['kichhoat'];
        $DanhmucTruyen->save();
        
        // trả về trang gửi dữ liệu đến nó+status
        return redirect()->back()->with('status',"thêm danh mục thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('admincp.danhmuctruyen.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $danhmuc = DanhmucTruyen::find($id);
        return view('admincp.danhmuctruyen.edit',compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // kiểm tra validate cho form
        $data = $request->validate(
            [
            'tendanhmuc' => 'required|max:255',
            'slug_danhmuc' => 'required|max:255',
            'mota' => 'required',
            'kichhoat' => 'required',
            ],
        // tùy chỉnh thông báo validate
            [
            'slug_danhmuc.unique' => 'slug danh mục đã có, điền slug khác!',
            'tendanhmuc.required' => 'Điền tên danh mục !',
            'mota.required' => 'Ghi mô tả !', 
            ]
    );
        //$data = $request->all();
        // cách 1: dùng Eloquent Model
        $DanhmucTruyen = DanhmucTruyen::find($id);
        $DanhmucTruyen->tendanhmuc = $data['tendanhmuc'];
        $DanhmucTruyen->slug_danhmuc = $data['slug_danhmuc'];
        $DanhmucTruyen->mota = $data['mota'];
        $DanhmucTruyen->kichhoat = $data['kichhoat'];
        $DanhmucTruyen->save();
        // // cách 2 dùng Model Mass Assignment
        // $DanhmucTruyen = DanhmucTruyen::create(Input::all());
        // trả về trang gửi dữ liệu đến nó+status
        return redirect()->route('danhmuc.index')->with('status',"Cập nhật danh mục thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= DanhmucTruyen::find($id)->delete();
         return redirect()->back()->with('status',"xóa danh mục thành công");
    }
}
