<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Truyen;
use App\Models\ThuocDanh;
use App\Models\ThuocLoai;
use App\Models\DanhmucTruyen;
use App\Models\Theloai;
use App\Models\Chapter;
use Storage;
class TruyenController extends Controller
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
         $list_truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->get();
         
        return view('admincp.truyen.index',compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
        $mangdl = DanhmucTruyen::where('kichhoat','=','0')->orderBy('id','DESC')->get();
        return view('admincp.truyen.create',compact("mangdl",'theloai'));
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
            'tentruyen' => 'required|unique:truyen|max:255',
            'tacgia' => 'required|max:255',
            'theloai' => 'required',
            'truyen_noibat' => 'required',
            'tukhoa' => 'required',
            'views' => 'required',
            'slug_truyen' => 'max:255',
            'tomtat' => 'required',
            'kichhoat' => 'required',
            'danhmuc' => 'required',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000'
            ],
        // tùy chỉnh thông báo validate
            [
            'tentruyen.unique' => 'Tên truyện đã có, điền tên khác!',
            'views.required' => 'Yêu cầu nhập lượt xem',
            'tentruyen.max' => 'Tối đa 255 ký tự!',
            'tentruyen.required' => 'Điền tên truyện !',
            'tukhoa.required' => 'Điền từ khóa !',
            'tacgia.required' => 'Điền tên tác giả !',
            'tomtat.required' => 'Ghi mô tả !',
            'hinhanh.required' => 'Thêm hình ảnh !', 
            ]
    );
        $Truyen = new Truyen();
        $Truyen->tentruyen = $data['tentruyen'];
        $Truyen->tacgia = $data['tacgia'];
        $Truyen->tukhoa = $data['tukhoa'];
        
        $Truyen->slug_truyen = $data['slug_truyen'];
        $Truyen->tomtat = $data['tomtat'];
        $Truyen->kichhoat = $data['kichhoat'];
        
        $Truyen->views = $data['views'];
        $Truyen->truyen_noibat = $data['truyen_noibat'];
        // lấy thời gian hiện tại
        $Truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        foreach($data['danhmuc'] as $key => $value) {
           $Truyen->danhmuc_id = $value[0]; 
        }
        foreach($data['theloai'] as $key => $value1) {
           $Truyen->theloai_id = $value1[0]; 
        }
        // xử lý ảnh
        $get_image = $request->hinhanh; 
        $path = 'uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $Truyen->hinhanh=$new_image;
        $Truyen->save();
        $Truyen->thuocnhieudanhmuctruyen()->attach($data['danhmuc']);
        $Truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);

        //xong xử lý ảnh
        // trả về trang gửi dữ liệu đến nó+status
        return redirect()->back()->with('status',"thêm truyện thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);
        $thuocdanhmuc = $truyen->thuocnhieudanhmuctruyen;
        $thuoctheloai = $truyen->thuocnhieutheloaitruyen;
        $danhmuc = DanhmucTruyen::where('kichhoat','=','0')->orderBy('id','DESC')->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        return view('admincp.truyen.edit',compact('truyen','danhmuc','theloai','thuocdanhmuc','thuoctheloai'));
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
        $data = $request->validate(
            [
            'tentruyen' => 'required|max:255',
            'tacgia' => 'required|max:255',
            'slug_truyen' => 'required|max:255',
            'truyen_noibat' => 'required',
            'views' => 'required',
            'theloai' => 'required',
            'tukhoa' => 'required',
            'tomtat' => 'required',
            'kichhoat' => 'required',
            'danhmuc' => 'required',
            'hinhanh' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000'
            ],
        // tùy chỉnh thông báo validate
            [
            'tentruyen.max' => 'Tối đa 255 ký tự!',
            'tentruyen.required' => 'Điền tên truyện !',
            'views.required' => 'Điền lượt xem !',
            'tukhoa.required' => 'Điền từ khóa !',
            'tacgia.required' => 'Điền tên tác giả !',
            'tomtat.required' => 'Ghi mô tả !', 
            ]
    );
       
        $Truyen = Truyen::find($id);
        $Truyen->thuocnhieudanhmuctruyen()->sync($data['danhmuc']);
        $Truyen->thuocnhieutheloaitruyen()->sync($data['theloai']);
        $Truyen->tentruyen = $data['tentruyen'];
        $Truyen->tacgia = $data['tacgia'];
        $Truyen->tukhoa = $data['tukhoa'];
        $Truyen->slug_truyen = $data['slug_truyen'];
        $Truyen->tomtat = $data['tomtat'];
        $Truyen->kichhoat = $data['kichhoat'];
        $Truyen->views = $data['views'];
        $Truyen->truyen_noibat = $data['truyen_noibat'];
        foreach($data['danhmuc'] as $key => $value) {
            $Truyen->danhmuc_id = $value[0];
        }
        foreach($data['theloai'] as $key => $value1) {
            $Truyen->theloai_id = $value1[0];
        }
        // lấy thời gian hiện tại
        $Truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        // xử lý ảnh
        $get_image = $request->hinhanh; 
        if($get_image){
        $path = 'uploads/truyen/'.$Truyen->hinhanh;
        if (file_exists($path)) {
           unlink($path);
       }
        $path = 'uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $Truyen->hinhanh=$new_image;
        }
        $Truyen->save();

        //xong xử lý ảnh
        // trả về trang gửi dữ liệu đến nó+status
        return redirect()->route('truyen.index')->with('status',"Cập nhật truyện thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $Truyen = Truyen::find($id);
       $path = 'uploads/truyen/'.$Truyen->hinhanh;
       if (file_exists($path)) {
           unlink($path);
       }
       $Truyen->thuocnhieudanhmuctruyen()->detach($Truyen->danhmuc_id);
        $Truyen->thuocnhieutheloaitruyen()->detach($Truyen->theloai_id);
       Truyen::find($id)->delete();
       return redirect()->back()->with('status',"xóa truyện thành công");
    }
     public function truyennoibat(Request $request){
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->save();

    }
}
