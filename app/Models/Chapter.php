<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps=false; 
    protected $fillable =[
        'truyen_id','tomtat','kichhoat','slug_chapter','noidung','tieude'
    ];
    // nếu khóa chính là id thì không cần khai báo
    protected $primaryKey ="id";
    // nếu tên bảng là tên model thì không cần khai báo
    protected $table = 'chapter';
    public function truyen()
    {
        return $this->belongsTo('App\Models\Truyen','truyen_id','id');
    }
}
