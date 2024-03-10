<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";
    //protected $fillable = ['tenvi', 'tenen', 'tenkhongdauvi', 'tenkhongdauen', 'motavi', 'motaen', 'noidungvi', 'noidungen', 'hienthi', 'stt', 'type', 'photo'];
    protected $guarded = ['slugvi','slugen'];

    /*
    |--------------------------------------------------------------------------
    | Mặc định số lượng dòng dữ liệu trên 1 trang
    |--------------------------------------------------------------------------
    */
    private $numberPerpage = 10;
    private $category = 'man';


    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    | Dựa theo category mà controller truyền vào để xác định model tương ứng .Sau đó mapping tới table trong database
    |--------------------------------------------------------------------------
    | Số lượng dòng trên 1 trang sẽ được thay đổi theo cấu hình trong file config_all.numberperpages
    |
    */
    public function __construct($category='man'){
        $this->numberPerpage = config('config_all.numberperpage.product');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasLevelOne() {
        return $this->belongsTo('App\Models\Category','ids_level_1')->where('hienthi',1);
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasDanhGia() {
        return $this->hasMany('App\Models\DanhGia','id_product')->where('hienthi',1);
    }


    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    | Dựa theo category mà controller truyền vào để xác định model tương ứng .Sau đó mapping tới table trong database
    |--------------------------------------------------------------------------
    | Số lượng dòng trên 1 trang sẽ được thay đổi theo cấu hình trong file config_all.numberperpages
    |
    */
    public function Allrating(){
        return $this->hasMany('App\Models\DanhGia','id_product');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    // public function MaxStar($id_product) {
    //     return $this->hasMany('App\Models\DanhGia','id_product')->addSelect(['maxstar' => DanhGia::selectRaw('sum(star)')->where('id_product',$id_product)]);
    // }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasProductOptions() {
        return $this->hasMany('App\Models\ProductOption','id_product')->where('xoatam',0)->where('phienbanmau',0);
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasProductOptionsSample() {
        return $this->hasOne('App\Models\ProductOption','id_product')->where('xoatam',0)->where('phienbanmau',1);
    }



    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product
    |--------------------------------------------------------------------------
    */
    public function HasProductOptionsAll() {
        return $this->hasMany('App\Models\ProductOption','id_product');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasAllChild() {
        return $this->hasMany('App\Models\Product','id');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: sản phẩm thuộc nhãn hiệu
    |--------------------------------------------------------------------------
    */
    public function BelongToBrand() {
        return $this->belongsTo('App\Models\Brand','id_brand')->where('hienthi',1);
    }

    /*
    |--------------------------------------------------------------------------
    | RelationShip: sản phẩm thuộc nhãn hiệu
    |--------------------------------------------------------------------------
    */
    public function HasProperty() {
        return $this->hasMany('App\Models\ProductProperty','id_product')->with('BelongProperty');
        // $array_tmp = $this->hasMany('App\Models\ProductProperty','id_product');
        // $collection = collect($array_tmp->get()->toArray());
         
        // $keyed = $collection->mapWithKeys(function ($item) {
        //     return [$item['id_property'] => $item];
        // });
         
        // $keyed->all();
        // return $keyed;
    }


    public function MaxStar(){
        return $this->hasOne('App\Models\DanhGia','id_product')
                    ->select('id_product',DB::raw('sum(star) as sum'))
                    ->groupBy('id_product');
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy ds relation ship của model
    |--------------------------------------------------------------------------
    */
    public function GetRelations(){
        return ['HasDanhGia', 'HasProductOptions', 'HasProductOptionsSample', 'HasProductOptionsAll', 'HasAllChild', 'BelongToBrand', 'HasLevelOne','Allrating', 'MaxStar', 'HasProperty'];
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
