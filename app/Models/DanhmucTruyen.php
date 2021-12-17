<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucTruyen extends Model
{
    use HasFactory;
    public $timestamps=false; 
    protected $fillable =[
        'tendanhmuc','mota','kichhoat','slug_danhmuc'
    ];
    // nếu khóa chính là id thì không cần khai báo
    protected $primaryKey ="id";
    // nếu tên bảng là tên model thì không cần khai báo
    protected $table = 'danhmuc';
    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen','danhmuc_id','id');
    }
    public function nhieutruyen(){
        return $this->belongsToMany(Truyen::class,'thuocdanh','danhmuc_id','truyen_id');
    }
}
