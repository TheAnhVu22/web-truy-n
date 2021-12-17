<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    use HasFactory;
    public $timestamps=false; 
    protected $fillable =[
        'tentheloai','mota','slug_theloai'
    ];
    // nếu khóa chính là id thì không cần khai báo
    protected $primaryKey ="id";
    // nếu tên bảng là tên model thì không cần khai báo
    protected $table = 'theloai';
    // tạo liên kết giữa các bảng
    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen','theloai_id','id');
    }
    public function nhieutheloaitruyen(){
        return $this->belongsToMany(Truyen::class,'thuocloai','theloai_id','truyen_id');
    }
}
