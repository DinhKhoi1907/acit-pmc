<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Helper;

class Category extends Model
{
    use HasFactory;

    protected $table = "category";
    protected $guarded = ['slugvi','slugen'];

    /*
    |--------------------------------------------------------------------------
    | Mặc định số lượng dòng dữ liệu trên 1 trang
    |--------------------------------------------------------------------------
    */
    private $numberPerpage = 10;

    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    | Dựa theo category mà controller truyền vào để xác định model tương ứng .Sau đó mapping tới table trong database
    |--------------------------------------------------------------------------
    | Số lượng dòng trên 1 trang sẽ được thay đổi theo cấu hình trong file config_all.numberperpages
    |
    */
    public function __construct(){
        $this->numberPerpage = config('config_all.numberperpage.category');
    }

    /*
    |--------------------------------------------------------------------------
    | RelationShip - Belongto: Lấy 1 dòng dữ liệu từ bảng product theo id_product của product_option
    |--------------------------------------------------------------------------
    */
    public function CategoryParent() {
        return $this->belongsTo('App\Models\Category', 'ids_level_1');
    }

    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasLevelChild() {
        return $this->hasMany('App\Models\Category','ids_level_1');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function GetPhotos() {
        return $this->hasMany('App\Models\Gallery','id_photo')->where('type','product')->where('com','category')->orderBy('stt');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasAllChild() {
        return $this->hasMany('App\Models\Product','ids_level_1')->with(['HasProductOptionsAll']);
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasAllChildLimit() {
        return $this->hasMany('App\Models\Product','ids_level_1')->with(['HasProductOptionsAll','Allrating','MaxStar']);//->limit(10);
    }



    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasAllProduct() {
        return $this->hasMany('App\Models\Product','id_category')->with(['HasProductOptionsAll','Allrating','MaxStar']);
    }

    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasAllPost() {
        return $this->hasMany('App\Models\Post','ids_level_1')->orderBy('stt','asc');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasAllAlbum() {
        return $this->hasMany('App\Models\Album','id_category');
    }



    /*
    |--------------------------------------------------------------------------
    | Lấy ds relation ship của model
    |--------------------------------------------------------------------------
    */
    public function GetRelations(){
        return ['CategoryParent', 'HasAllChild', 'HasAllProduct', 'HasAllPost', 'HasAllAlbum','HasLevelChild','HasAllChildLimit', 'GetPhotos'];
    }



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
