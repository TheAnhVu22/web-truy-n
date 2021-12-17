<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];
    public $timestamps = false;
    protected $fillable =[
        'tensach','slug_sach','created_at','updated_at','kichhoat','views','tomtat','noidung','tukhoa','tacgia'
    ];
    protected $primaryKey = 'id';
    protected $table = 'sach';
}
