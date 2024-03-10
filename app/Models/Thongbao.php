<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongbao extends Model
{
    use HasFactory;

    protected $table = "thongbao";

    protected $guarded = [];


    /*
    |--------------------------------------------------------------------------
    | Danh sách scope hỗ trợ cho truy vấn
    |--------------------------------------------------------------------------
    */
    public function scopeLike($query, $field, $value){
        return $query->where($field, 'LIKE', "%".$value."%");
    }

    public function scopeHienthi($query,$val=1){
        return $query->where('hienthi', $val);
    }
}
