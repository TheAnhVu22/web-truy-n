<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen;
use App\Models\Chapter;
class ChapterController extends Controller
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
    {   // không thấy khác nhau
        $Chapter = Chapter::with('Truyen')->orderBy('id',"DESC")->get();
         $Chapter = Chapter::orderBy('id',"DESC")->get();
        return view('admincp.chapter.index',compact('Chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id','DESC')->get();
        return view('admincp.chapter.create',compact('truyen'));
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
                'tieude' =>'required|max:255',
                'tomtat' => 'required|max:255',
                'noidung' => 'required', 
                'slug_chapter' => 'max:255',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'tieude.required' => 'Nhập tiêu đề chapter!',
                'tomtat.required' => 'Nhập tóm tắt chapter!',
                'noidung.required' => 'Nhập nội dung chapter!',
                'tieude.max' => 'Tiêu đề Tối đa 255 ký tự !',
                'tomtat.max' => 'Tóm tắt Tối đa 255 ký tự !',
            ]
        );
        $Chapter = new Chapter();
        $Chapter->truyen_id = $data['truyen_id'];
        $Chapter->tieude = $data['tieude'];
        
        $Chapter->tomtat = $data['tomtat'];
        $Chapter->noidung = $data['noidung'];
        
        $Chapter->kichhoat = $data['kichhoat'];
        $Chapter->slug_chapter = $data['slug_chapter'];
       
        $Chapter->save();
        return redirect()->back()->with('status','Thêm chapter thành công');
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id','DESC')->get();
        return view('admincp.chapter.edit',compact('chapter','truyen'));
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
                'tieude' =>'required|max:255',
                'tomtat' => 'required|max:255',
                'noidung' => 'required', 
                'slug_chapter' => 'max:255',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'tieude.required' => 'Nhập tiêu đề chapter!',
                'tomtat.required' => 'Nhập tóm tắt chapter!',
                'noidung.required' => 'Nhập nội dung chapter!',
                'tieude.max' => 'Tiêu đề Tối đa 255 ký tự !',
                'tomtat.max' => 'Tóm tắt Tối đa 255 ký tự !',
            ]
        );
        $noidung = $data['noidung'];
        // echo $noidung;
        $Chapter = Chapter::find($id);
        $Chapter->truyen_id = $data['truyen_id'];
        $Chapter->tieude = $data['tieude'];
        
        $Chapter->tomtat = $data['tomtat'];
        $Chapter->noidung =  $noidung;
        
        $Chapter->kichhoat = $data['kichhoat'];
        $Chapter->slug_chapter = $data['slug_chapter'];
       
        $Chapter->save();
         return redirect()->route('chapter.index')->with('status','Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dulieu = Chapter::find($id)->delete();
        return redirect()->back()->with('status',"Xóa chapter thành công");
    }
}
