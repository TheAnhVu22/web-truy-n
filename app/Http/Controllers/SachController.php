<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use Carbon\Carbon;
class SachController extends Controller
{
    public function __construct()
    {
        // có 1 trong các quyền này thì sẽ vào đc index + show
        $this->middleware('permission:publish truyen|edit truyen|delete truyen|add truyen',['only' => ['index','show']]);
        // với mỗi quyền thì có các chức năng riêng nữa
         $this->middleware('permission:add truyen', ['only' => ['create','store']]);
         $this->middleware('permission:edit truyen', ['only' => ['edit','update']]);
         $this->middleware('permission:delete truyen', ['only' => ['destroy']]);
    }
    public function index()
    {
       $mangdl = Sach::orderBy('id','DESC')->get();
        return view('admincp.sach.index',compact('mangdl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.sach.create'); 
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
            'tensach' => 'required|unique:sach|max:255',
            'tacgia' => 'required|max:255',
            'noidung' => 'required',
            'tukhoa' => 'required',
            'views' => 'required',
            'slug_sach' => 'max:255',
            'tomtat' => 'required',
            'kichhoat' => 'required',
            
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000'
            ],
        // tùy chỉnh thông báo validate
            [
            'tensach.unique' => 'Tên sách đã có, điền tên khác!',
            'views.required' => 'Yêu cầu nhập lượt xem',
            'tensach.max' => 'Tối đa 255 ký tự!',
            'tensach.required' => 'Điền tên sách !',
            'tukhoa.required' => 'Điền từ khóa !',
            'tacgia.required' => 'Điền tên tác giả !',
            'tomtat.required' => 'Ghi mô tả !',
            'noidung.required' => 'Ghi mô tả !',
            'hinhanh.required' => 'Thêm hình ảnh !', 
            ]
    );
        $sach = new Sach();
        $sach->tensach = $data['tensach'];
        $sach->tacgia = $data['tacgia'];
        $sach->tukhoa = $data['tukhoa'];
        
        $sach->slug_sach = $data['slug_sach'];
        $sach->tomtat = $data['tomtat'];
        $sach->kichhoat = $data['kichhoat'];
        $sach->noidung = $data['noidung'];
        $sach->views = $data['views'];
        
        // lấy thời gian hiện tại
        $sach->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        // xử lý ảnh
        $get_image = $request->hinhanh; 
        $path = 'uploads/sach/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $sach->hinhanh=$new_image;
        $sach->save();
        //xong xử lý ảnh
        // trả về trang gửi dữ liệu đến nó+status
        return redirect()->back()->with('status',"thêm sách thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $sach = Sach::find($id);
     return view('admincp.sach.edit',compact('sach'));
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
            'tensach' => 'required|max:255',
            'tacgia' => 'required|max:255',
            'noidung' => 'required',
            'tukhoa' => 'required',
            'views' => 'required',
            'slug_sach' => 'max:255',
            'tomtat' => 'required',
            'kichhoat' => 'required',
            
            'hinhanh' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000'
            ],
        // tùy chỉnh thông báo validate
            [
            'views.required' => 'Yêu cầu nhập lượt xem',
            'tensach.max' => 'Tối đa 255 ký tự!',
            'tensach.required' => 'Điền tên sách !',
            'tukhoa.required' => 'Điền từ khóa !',
            'tacgia.required' => 'Điền tên tác giả !',
            'tomtat.required' => 'Ghi mô tả !',
            'noidung.required' => 'Ghi mô tả !',
            
            ]
    );
        $sach = Sach::find($id);
        $sach->tensach = $data['tensach'];
        $sach->tacgia = $data['tacgia'];
        $sach->tukhoa = $data['tukhoa'];
        
        $sach->slug_sach = $data['slug_sach'];
        $sach->tomtat = $data['tomtat'];
        $sach->kichhoat = $data['kichhoat'];
        $sach->noidung = $data['noidung'];
        $sach->views = $data['views'];
        
        // lấy thời gian hiện tại
        $sach->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        // xử lý ảnh
        $get_image = $request->hinhanh; 
        if($get_image){
        $path = 'uploads/sach/'.$sach->hinhanh;
        if (file_exists($path)) {
           unlink($path);
       }
        $path = 'uploads/sach/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $sach->hinhanh=$new_image;
        }
        $sach->save();
        //xong xử lý ảnh
        // trả về trang gửi dữ liệu đến nó+status
        return redirect()->route('sach.index')->with('status',"Cập nhật sách thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sach = Sach::find($id);
       $path = 'uploads/sach/'.$sach->hinhanh;
       if (file_exists($path)) {
           unlink($path);
       }
       Sach::find($id)->delete();
        return redirect()->route('sach.index')->with('status',"xóa sách thành công");
    }
}
