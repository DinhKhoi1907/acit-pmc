<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'phonenumber',
        'photo',
        'kichhoat',
        'hienthi',
        'social_provider',
        'social_id',
        'social_name',
        'avatar_url',
        'diachi',
        'ngaysinh',
        'gioitinh',
        'mathanhvien',
        'nganhang',
        'sotaikhoan',
        'tongxu',
        'vip',
        'timeopen',
        'timeup',
        'likes'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



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
    public function __construct(){}


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function BelongPost()
    {
        return $this->hasOne('App\Models\Post', 'id_user');
    }


    /*
    |--------------------------------------------------------------------------
    | RelationShip: Lấy tất cả dòng dữ liệu của product option relation với product theo id_product nhưng tạm thời bị xóa
    |--------------------------------------------------------------------------
    */
    public function HasNganhang()
    {
        return $this->belongsTo('App\Models\Post', 'nganhang');
    }

    /*
    |--------------------------------------------------------------------------
    | Lấy ds relation ship của model
    |--------------------------------------------------------------------------
    */
    public function GetRelations(){
        return ['BelongPost', 'HasNganhang'];
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng - hoặc lọc theo danh mục - hoặc tìm theo từ khóa - để hiển thị ra view
    |--------------------------------------------------------------------------
    */
    public function GetAllItems($params,$paginate=false){        
        $run_sql = $this;//::with(['BelongPost']);

        $relations = $this->GetRelations();
        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($params){
            foreach($params as $k=>$v){
                if($k!='keyword' && $v>0){
                    $run_sql=$run_sql->where($k, $v);
                }
                if($k=='keyword'){
                    $run_sql=$run_sql->like('username', $v);
                }
            }
        }
        //$run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
        //return $run_sql;        
        if(!$paginate){
            return $run_sql->get()->toArray();
        }/*else{
            $this->numberPerpage = $limit;
        }*/
        return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
    }

    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type và điều kiện tìm kiếm để hiển thị ra view
    |--------------------------------------------------------------------------
    */
    public function GetItemsBySearch($type,$keyword){
        return $this->like('name', $keyword)->paginate($this->numberPerpage)->withQueryString();
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy 1 dòng dữ liệu theo id chính
    |--------------------------------------------------------------------------
    */
    public function GetOneItem($id){
        if($id){
            $run_sql = $this;

            $relations = $this->GetRelations();
            if($relations){
                $run_sql = $run_sql->with($relations);
            }

            $run_sql = $run_sql->where('id', $id)->first();
            if($run_sql){return $run_sql->toArray();}
        }
        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy 1 dòng dữ liệu theo ids
    |--------------------------------------------------------------------------
    */
    public function GetAllItemByIds($ids){
        if($ids){
            $run_sql = $this;  

            $relations = $this->GetRelations();
            if($relations){
                $run_sql = $run_sql->with($relations);
            }
                      
            return $run_sql->whereIn('id', $ids)->orderBy('stt', 'asc')->get()->toArray();
        }
        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy dòng dữ liệu theo id chính
    |--------------------------------------------------------------------------
    */
    public function GetItemOther($id){
        if($id){
            return $this->where('id', '<>', $id)->get()->toArray();
        }
        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lưu mới - cập nhật dữ liệu
    |--------------------------------------------------------------------------
    | Biến $data: Mảng dữ liệu đầu vào
    |--------------------------------------------------------------------------
    | Biến $id: Nếu có thì cập nhật. Ngược lại thì tạo mới
    */
    public function SaveItem($data,$id='null'){
        return $this->updateOrCreate(['id'=>$id], $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa 1 dòng dữ liệu theo id chính
    |--------------------------------------------------------------------------
    */
    public function DeleteOneItem($id){
        $row = $this->GetOneItem($id);
        if($row){$this->find($id)->delete();}
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy nhiều dòng dữ liệu theo chuỗi danh sách id
    |--------------------------------------------------------------------------
    */
    public function DeleteMultiItem($listid){
        $ids = explode(",", $listid);        
        $this->whereIn('id', $ids)->delete();
    }


    /*
    |--------------------------------------------------------------------------
    | Danh sách scope hỗ trợ cho truy vấn
    |--------------------------------------------------------------------------
    */
    public function scopeLike($query, $field, $value){
        return $query->where($field, 'LIKE', "%".$value."%");
    }
}
