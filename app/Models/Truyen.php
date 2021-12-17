<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;

    // xử lý hiển thị ngày đăng
     protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];
     public $timestamps=false; 
    protected $fillable =[
        'tentruyen','tomtat','kichhoat','slug_truyen','hinhanh','danhmuc_id','created_at','updated_at','views','truyen_noibat'
    ];
    // nếu khóa chính là id thì không cần khai báo
    protected $primaryKey ="id";
    // nếu tên bảng là tên model thì không cần khai báo
    protected $table = 'truyen';
    // tạo liên kết giữa các bảng
    public function danhmuctruyen()
    {
        return $this->belongsTo('App\Models\DanhmucTruyen','danhmuc_id','id');
    }
    public function theloai()
    {
        return $this->belongsTo('App\Models\Theloai','theloai_id','id');
    }
    public function chapter()
    {
        return $this->hasMany('App\Models\Chapter','truyen_id','id');
    }
    public function thuocnhieudanhmuctruyen(){
        return $this->belongsToMany(DanhmucTruyen::class,'thuocdanh','truyen_id','danhmuc_id');
    }
    public function thuocnhieutheloaitruyen(){
        return $this->belongsToMany(Theloai::class,'thuocloai','truyen_id','theloai_id');
    }
}
