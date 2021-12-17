<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theloai;

class TheloaiController extends Controller
{
    public function __construct()
    {
        // có 1 trong các quyền này thì sẽ vào đc index + show
        $this->middleware('permission:publish the loai|edit the loai|delete the loai|add the loai',['only' => ['index','show']]);
        // với mỗi quyền thì có các chức năng riêng nữa
         $this->middleware('permission:add the loai', ['only' => ['create','store']]);
         $this->middleware('permission:edit the loai', ['only' => ['edit','update']]);
         $this->middleware('permission:delete the loai', ['only' => ['destroy']]);
    }
    public function index()
    {
        $mangdl = Theloai::orderBy('id','DESC')->get();
        return view('admincp.theloai.index',compact('mangdl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.theloai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tentheloai' => 'required|unique:theloai|max:255',
                'slug_theloai' => 'required',
                'mota' => 'required'
            ],
            [
                'tentheloai.required' => 'Nhập tên thể loại !',
                'tentheloai.unique' => 'Tên thể loại đã tồn tại, nhập lại !',
                'tentheloai.max' => 'Tối đa 255 ký tự !',
                'slug_theloai.required' => 'không được để trống',
                'mota.required' => 'Nhập mô tả !'
            ]
        );
        $theloai = new Theloai();
        $theloai->tentheloai = $data['tentheloai'];
        $theloai->slug_theloai = $data['slug_theloai'];
        $theloai->mota = $data['mota'];
        $theloai->save();
        return redirect()->route('theloai.index')->with('status','Thêm thể loại thành công');
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
        $theloai = Theloai::find($id);
        return view('admincp.theloai.edit',compact('theloai'));
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
                'tentheloai' => 'required|max:255',
                'slug_theloai' => 'required',
                'mota' => 'required'
            ],
            [
                'tentheloai.required' => 'Nhập tên thể loại !',
                'tentheloai.max' => 'Tối đa 255 ký tự !',
                'slug_theloai.required' => 'không được để trống',
                'mota.required' => 'Nhập mô tả !'
            ]
        );
        $theloai = Theloai::find($id);
        $theloai->tentheloai = $data['tentheloai'];
        $theloai->slug_theloai = $data['slug_theloai'];
        $theloai->mota = $data['mota'];
        $theloai->save();
        return redirect()->route('theloai.index')->with('status','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theloai = Theloai::find($id)->delete();
        return redirect()->back()->with('status','Xóa thành công');
    }
}
