<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Sach;
use App\Models\Chapter;
use App\Models\Theloai;
use App\Models\Info;
use App\Models\ThuocDanh;
use App\Models\ThuocLoai;
use storage;
class IndexController extends Controller
{
    public function kytu(Request $request,$kytu){
        $theloai = Theloai::orderBy('id','DESC')->get();
       
        $slide_truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();

        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        if($kytu=='0-9'){

            $rand = [0,1,2,3,4,5,6,7,8,9];

            $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->where(

            function ($query) use($rand) {

                for ($i = 0; $i <= 9; $i++){
                    $query->orwhere('tentruyen', 'LIKE',  $rand[$i] .'%');
                }

            })->paginate(12);

        }else{
            $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->where('tentruyen','LIKE', $kytu.'%')->orderBy('id','DESC')->where('kichhoat',0)->paginate(10);
        }

        return view('pages.kytu')->with(compact('danhmuc','truyen','theloai','slide_truyen'));
    }
    public function home()
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $slide_truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->where('truyen_noibat',1)->take(8)->get();
         $truyenmoi = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->where('truyen_noibat',0)->paginate(4);
         $truyenxemnhieu = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->where('truyen_noibat',2)->paginate(4);
        return view('pages.home1',compact('danhmuc','truyenmoi','theloai','slide_truyen','truyenxemnhieu'));
    }
    public function xemsachnhanh(Request $request)
    {
        $sach_id = $request->sach_id;

        $sach = Sach::find($sach_id);

        $output['tieude_sach'] = $sach->tensach;
        $output['noidung_sach'] = $sach->noidung;

        echo json_encode($output);
    }
    public function tabs_danhmuc(Request $request){
        $data = $request->all();
        $output ='';
        $id = $data['danhmuc_id'];
        $danhmuctruyen = DanhmucTruyen::find($id);
        $nhiutruyen = [];
        foreach($danhmuctruyen->nhieutruyen as $danh){
            $nhiutruyen[] = $danh->id;
        }

        $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->whereIn('id',$nhiutruyen)->paginate(12);
        foreach($truyen as $key => $value){
            $anh1 = 'uploads/truyen/'.$value->hinhanh;
            $output.='
            <div class="card shadow-sm mt-2 col-3">
            <img src="'.$anh1.'" alt="" height="200px">
            <div class="card-body">        
                <div class="btn-group">
                  <a  href="'.url('doc-truyen/'.$value->slug_truyen).'" style="color:black; text-decoration:none;">
                            <h4 style="color:black;  ">'.$value->tentruyen.'</h4>
                            </a>
              </div>
            </div>
          </div>

            ';

        }
        echo $output;

    }
    public function docsach()
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
         $sach = Sach::orderBy('id','DESC')->where('kichhoat',0)->get();
        return view('pages.sach',compact('sach','danhmuc','theloai'));
    }
    public function doctruyen($slug)
    {      
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::with('DanhmucTruyen','theloai')->where('slug_truyen',$slug)->where('kichhoat',0)->first();
        $chapter = Chapter::with('Truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->get();
        $chapter_dau = Chapter::with('Truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chapter_moinhat = Chapter::with('Truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();
        $cungdanhmuc = Truyen::with('DanhmucTruyen','theloai')->where('danhmuc_id',$truyen->DanhmucTruyen->id)->whereNotIn('id',[$truyen->id])->get();
        $truyenxemnhieu = Truyen::orderBy('id','DESC')->where('kichhoat',0)->where('truyen_noibat',2)->take(3)->get();

        return view('pages.truyen',compact('danhmuc','truyen','chapter','cungdanhmuc','chapter_dau','theloai','chapter_moinhat','truyenxemnhieu'));
    }
    public function danhmuc($slug)
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
         $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

         $danhmuc_id = DanhmucTruyen::where('slug_danhmuc',$slug)->first();
         $tendanhmuc = $danhmuc_id->tendanhmuc;

         $danhmuctruyen = DanhmucTruyen::find($danhmuc_id->id);
        $nhiutruyen = [];
        foreach($danhmuctruyen->nhieutruyen as $danh){
            $nhiutruyen[] = $danh->id;
        }

        $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->whereIn('id',$nhiutruyen)->paginate(12);
        
        return view('pages.danhmuc',compact('danhmuc','truyen','theloai','tendanhmuc'));
    }
    public function theloai($slug)
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
         $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
         $theloai_id = Theloai::where('slug_theloai',$slug)->first();
          $theloaitruyen = Theloai::find($theloai_id->id);
        // dd($danhmuctruyen->nhieutruyen);
        $nhiutruyen = [];
        foreach($theloaitruyen->nhieutheloaitruyen as $the){
            $nhiutruyen[] = $the->id;
        }
         $tentheloai = $theloai_id->tentheloai;
       $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->whereIn('id',$nhiutruyen)->paginate(12);
        
        return view('pages.theloai',compact('danhmuc','truyen','theloai','tentheloai'));
    }
    public function xemchapter($slug)
    {   
        
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $truyen = Chapter::where('slug_chapter',$slug)->first();
        //breadcrumb
        $truyen_breadcrumb = Truyen::with('DanhmucTruyen')->where('id',$truyen->truyen_id)->first();

        //đếm lượt xem
        $id_truyen = $truyen_breadcrumb->id;
        $luotxem = $truyen_breadcrumb->views;
        $luotxem = $luotxem +1;
        $capnhat = Truyen::find($id_truyen);
        $capnhat->views = $luotxem;
        $capnhat->save();
        //end breadcrumb
        $chapter = Chapter::with('Truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        $allchapter = Chapter::with('Truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();
        $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');
        $pre_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');
        $max_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();
        return view('pages.chapter',compact('danhmuc','truyen_breadcrumb','chapter','allchapter','pre_chapter','next_chapter','max_id','min_id','theloai','luotxem'));
    }
    public function timkiem(Request $request)
    {   
        $data = $request->all();
        $tukhoa = $data['tukhoa'];
        
        
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $slide_truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
         $truyen =  Truyen::with('DanhmucTruyen','Theloai')->where('tentruyen','LIKE','%'.$tukhoa.'%')->orWhere('tomtat','LIKE','%'.$tukhoa.'%')->orWhere('tacgia','LIKE','%'.$tukhoa.'%')->get();
          $sach =  Sach::where('tensach','LIKE','%'.$tukhoa.'%')->orWhere('tomtat','LIKE','%'.$tukhoa.'%')->orWhere('tacgia','LIKE','%'.$tukhoa.'%')->get();
        return view('pages.timkiem',compact('danhmuc','truyen','theloai','slide_truyen','tukhoa','sach'));
    }
    public function timkiem_ajax(Request $request)
    {
        $data = $request->all();
        if($request->get('query'))
        {
            $query = $request->get('query');
            $truyen = Truyen::where('kichhoat',0)->where('tentruyen','LIKE','%'.$data['query'].'%')->get(); 
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
            foreach($truyen as $key => $value)
            {
               $output .= '
               <li class="li_search_ajax"><a href="#">'.$value->tentruyen.'</a></li>
               ';
           }
           $output .= '</ul>';
           echo $output;
       }
    }
    public function tag($tag)
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
         $slide_truyen = Truyen::with('DanhmucTruyen','Theloai')->orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
         $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $tags = explode("-",$tag);
        $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->where(
            function ($query) use($tags) {
            for ($i = 0; $i < count($tags); $i++){
                $query->orwhere('tukhoa', 'like',  '%' . $tags[$i] .'%');
            }
            })->paginate(12);

        return view('pages.tag')->with(compact('danhmuc','truyen','theloai','slide_truyen','tag'));
        
    }
    
}
