<?php

namespace App\Repositories;

use Illuminate\Http\Request;

//use App\Repositories\RepositoryInterface;

use Helper, DB;

abstract class BaseRepository
{
    //model muốn tương tác
    protected $model;
    protected $numberPerpage=10;
    protected $request_main;

    //khởi tạo
    public function __construct(){
        $this->model = app()->make(
            $this->getModel()
        );
    }

    //lấy model tương ứng
    abstract public function getModel();

    public function getRequest(){
        //dd($request->route()->getPrefix());
    }


    public function GetRelationsRepo(){
        return $this->model->GetRelations();
    }


    public function SetNumberPerPage($perpage){
        $this->numberPerpage = $perpage;
    }


    //lấy pagenumber tương ứng
    //abstract public function getNumberPerpage($category);

    /**
     * Set model
     */
    public function setModel($category='man')
    {
        return $this->model;

        /*$this->model = app()->make(
            $this->getModel()
        );
        return $this->model;*/
    }


    public function Query(){
        return $this->model;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng - hoặc lọc theo danh mục - hoặc tìm theo từ khóa - để hiển thị ra view
    |--------------------------------------------------------------------------
    */
    public function GetAll($type,$params=null,$relations=null,$showHienthi=false){
        $run_sql = $this->model;

        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($params){
            foreach($params as $k=>$v){
                if($k!='keyword' && $v>0){
                    $run_sql=$run_sql->where($k, $v);
                }
                if($k=='xoatam'){
                    $run_sql=$run_sql->where($k, $v);
                }
                if($k=='keyword'){
                    $run_sql=$run_sql->like('tenvi', $v);
                }
                if($k=='id_category'){
                    $run_sql=$run_sql->where($k, $v);
                }
            }
        }
        if($showHienthi){
            $run_sql = $run_sql->hienthi()->where('draft',0);
        }
        $run_sql = $run_sql->where('type', $type)->orderBy('stt', 'asc');

        if($run_sql){
            return $run_sql->get();
        }

        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng - hoặc lọc theo danh mục - hoặc tìm theo từ khóa - để hiển thị ra view
    |--------------------------------------------------------------------------
    */
    public function GetAllItems($type='', $params=null, $relations = null, $paginate=false, $showHienthi=false, $limit=0, $orderby=null){
        $run_sql = $this->model;
        $relations = $this->GetRelationsRepo();
        if($relations){
            $run_sql = $run_sql->with($relations);
        }
        if($params){
            foreach($params as $k=>$v){
                if($k=='level_1'){
                    $run_sql = $run_sql->whereRaw('FIND_IN_SET("'.$v.'", ids_level_1)');
                }else if($k=='level_2'){
                    $run_sql = $run_sql->whereRaw('FIND_IN_SET("'.$v.'", ids_level_2)');
                }else if($k=='level_3'){
                    $run_sql = $run_sql->whereRaw('FIND_IN_SET("'.$v.'", ids_level_3)');
                }else if($k=='id_category'){
                    $run_sql = $run_sql->whereIn($k, $v);
                }else if ($k == 'list_ids_level_1') {
                    $run_sql = $run_sql->whereIn('ids_level_1', $v);
                }else if ($k == 'list_ids_level_2') {
                    $run_sql = $run_sql->whereIn('ids_level_2', $v);
                }else if($k=='ids_level_1'){
                    //$run_sql=$run_sql->where($k, $v);
                    $run_sql = $run_sql->whereRaw('FIND_IN_SET("'.$v.'", ids_level_1)');
                }else{
                    if($k!='keyword' && $v>0){
                    $run_sql=$run_sql->where($k, $v);
                    }
                    else if($k=='xoatam' || $k=='level' ){
                        $run_sql=$run_sql->where($k, $v);
                    }
                    else if($k=='keyword'){
                        if($v!=''){$run_sql=$run_sql->like('tenvi', $v);}
                    }else if($k=='keyword_noidung'){
                        if($v!=''){$run_sql=$run_sql->like('noidungvi', $v);}
                    }else{
                        $run_sql=$run_sql->where($k, $v);
                    }
                }
            }
        }


        if($limit>0){
            $run_sql = $run_sql->limit($limit);
        }

        if($showHienthi){
            $run_sql = $run_sql->hienthi()->where('draft',0);
        }

        if($type!=''){
            $run_sql = $run_sql->where('type', $type);
        }

        // if($type=='product'){
        //     dd(Helper::showSQL($run_sql));
        // }

        if($orderby){
            foreach($orderby as $o=>$ord){
                $run_sql = $run_sql->orderBy($o, $ord);
            }
        }else{
            $run_sql = $run_sql->orderBy('stt', 'asc');
        }

        // if($orderby){
        //     foreach($orderby as $o=>$ord){
        //         if($o=='comment'){
        //             $run_sql = $run_sql->leftJoin('comment', 'post.id', '=', 'comment.id_post')->selectRaw("post.*, count(comment.id_post) as count_comment")->groupBy('post.id')->orderBy('count_comment', $ord);
        //         }else{
        //             $run_sql = $run_sql->orderBy($o, $ord);
        //         }
        //     }
        // }else{
        //     $run_sql = $run_sql->orderBy('stt', 'asc');
        // }
        //dd($run_sql->all());
        //dd($run_sql->get());

        //dd(Helper::showSQL($run_sql));

        if(!$paginate){
            return $run_sql->get()->toArray();
        }
        return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy 1 fiels của tất cả các dòng dữ liệu theo mảng params (điều kiện truy vấn) truyền vào
    |--------------------------------------------------------------------------
    */
    public function GetAllItemsByParamsPluck($field, $params){
        $run_sql = $this->model;
        foreach($params as $k=>$v){
            $run_sql=$run_sql->where($k, $v);
        }
        //dd(Helper::showSQL($run_sql));
        $run_sql=$run_sql->orderBy('stt', 'asc')->get()->pluck($field)->toArray();
        return $run_sql;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng - hoặc lọc theo danh mục - hoặc tìm theo từ khóa - nhưng ngoại trừ id hiện tại
    |--------------------------------------------------------------------------
    */
    public function GetAllItemsExceptId($type,$params=null,$relations=null,$paginate=false, $showHienthi=false){
        $run_sql = $this->model;

        $relations = $this->GetRelationsRepo();
        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($params){
            foreach($params as $k=>$v){
                if($k=='id_category' || $k=='ids_level_1'){
                    $run_sql=$run_sql->whereIn($k, $v);
                }else{
                    if($k=='id'){
                        $run_sql=$run_sql->where($k,'<>',$v);
                    }else{
                        $run_sql=$run_sql->where($k,$v);
                    }
                    if($k=='xoatam'){
                        $run_sql=$run_sql->where($k, $v);
                    }
                }
            }
        }

        if($showHienthi){
            $run_sql = $run_sql->hienthi()->where('draft',0);
        }

        $run_sql = $run_sql->where('type', $type)->orderBy('stt', 'asc');

        //dd(Helper::showSQL($run_sql));

        if(!$paginate){
            return $run_sql->get()->toArray();
        }
        return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type và điều kiện tìm kiếm để hiển thị ra view
    |--------------------------------------------------------------------------
    */
    public function GetItemsBySearch($type,$keyword, $relations=null, $showHienthi=false){
        $run_sql = $this->model;

        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($showHienthi){
            $run_sql = $run_sql->hienthi()->where('draft',0);
        }

        return $run_sql->where('type', $type)->like('tenvi', $keyword)->orderBy('stt', 'asc')->paginate($this->numberPerpage)->withQueryString();
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy 1 dòng dữ liệu theo ids
    |--------------------------------------------------------------------------
    */
    public function GetAllItemByIds($ids, $relations=null, $paginate=false){
        if($ids){
            $run_sql = $this->model;

            $relations = $this->GetRelationsRepo();
            if($relations){
                $run_sql = $run_sql->with($relations);
            }

            if($relations){
                $run_sql = $run_sql->with($relations);
            }

            $run_sql = $run_sql->whereIn('id', $ids)->orderBy('stt', 'asc');

            if(!$paginate){
                return $run_sql->get()->toArray();
            }

            return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
        }
        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy nhiều dòng dữ liệu theo chuỗi danh sách id truyền vào
    |--------------------------------------------------------------------------
    */
    public function GetItemByListId($listid){
        if($listid){
            $ids = explode(",", $listid);
            return $this->model->whereIn('id', $ids)->get()->toArray();
        }
        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng -
    |--------------------------------------------------------------------------
    */
    public function GetAllItemsFindInSet($type, $tag_id , $list_id=null, $relations=null, $paginate=false, $showHienthi=false){
        $run_sql = $this->model;

        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($showHienthi){
            $run_sql = $run_sql->hienthi()->where('draft',0);
        }

        $run_sql = $run_sql->where('type', $type)->whereRaw('FIND_IN_SET('.$tag_id.',"'.$list_id.'")')->orderBy('stt', 'asc');

        if(!$paginate){
            return $run_sql->get()->toArray();
        }
        return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng -
    |--------------------------------------------------------------------------
    */
    public function GetAllItemsFindInSetField($type, $tag_id , $field_search=null, $relations=null, $paginate=false, $showHienthi=false){
        $run_sql = $this->model;

        $relations = $this->GetRelationsRepo();
        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        /*if($relations){
            $run_sql = $run_sql->with($relations);
        }*/

        if($showHienthi){
            $run_sql = $run_sql->hienthi()->where('draft',0);
        }

        $run_sql = $run_sql->where('type', $type)->whereRaw('FIND_IN_SET('.$tag_id.','.$field_search.')')->orderBy('stt', 'asc');

        if(!$paginate){
            return $run_sql->get()->toArray();
        }
        return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy 1 dòng dữ liệu theo id chính
    |--------------------------------------------------------------------------
    */
    public function GetOneItem($id, $relations=null){
        if($id){
            $run_sql = $this->model;

            $relations = $this->GetRelationsRepo();
            if($relations){
                $run_sql = $run_sql->with($relations);
            }

            // if($relations){
            //     $run_sql = $run_sql->with($relations);
            // }

            $row = $run_sql->where('id', $id)->first();

            if($row){
                return $row->toArray();
            }
            return null;
        }
        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy 1 dòng dữ liệu theo params truyền vào
    |--------------------------------------------------------------------------
    */
    public function GetItem($params=null,$relations=null,$paginate=false){
        $run_sql = $this->model;

        $relations = $this->GetRelationsRepo();
        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($params){
            foreach($params as $k=>$v){
                if($k!='keyword' && $v>0){
                    $run_sql=$run_sql->where($k, $v);
                }
                if($k=='xoatam'){
                    $run_sql=$run_sql->where($k, $v);
                }
                if($k=='keyword' && $v!=''){
                    $run_sql=$run_sql->like('tenvi', $v);
                }
                $run_sql=$run_sql->where($k, $v);
            }
        }
        $run_sql = $run_sql->first();
        if($run_sql){
            $run_sql = $run_sql->toArray();
        }else{
            $run_sql = null;
        }
        return $run_sql;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy nhiều dòng dữ liệu theo params truyền vào
    |--------------------------------------------------------------------------
    */
    public function GetItems($params=null,$relations=null,$orderby=null){
        $run_sql = $this->model;

        $relations = $this->GetRelationsRepo();
        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($params){
            foreach($params as $k=>$v){
                if($k!='keyword' && $v>0){
                    $run_sql=$run_sql->where($k, $v);
                }
                if($k=='xoatam'){
                    $run_sql=$run_sql->where($k, $v);
                }
                if($k=='keyword' && $v!=''){
                    $run_sql=$run_sql->like('tenvi', $v);
                }
                $run_sql=$run_sql->where($k, $v);
            }
        }

        if($orderby){
            foreach($orderby as $o=>$ord){
                $run_sql = $run_sql->orderBy($o, $ord);
            }
        }else{
            $run_sql = $run_sql->orderBy('stt', 'asc');
        }


        $run_sql = $run_sql->get();
        if($run_sql){
            $run_sql = $run_sql->toArray();
        }else{
            $run_sql = null;
        }
        return $run_sql;
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy 1 dòng dữ liệu theo id chính
    |--------------------------------------------------------------------------
    */
    public function CheckOneItemByParams($params){
        $run_sql = $this->model;
        if($params){
            foreach($params as $k=>$v){
                $run_sql=$run_sql->where($k, $v);
            }
        }
        return ($run_sql->first()) ? $run_sql->first() : null;
    }


    /*
    |--------------------------------------------------------------------------
    | Lưu mới - cập nhật dữ liệu
    |--------------------------------------------------------------------------
    | Biến $data: Mảng dữ liệu đầu vào
    |--------------------------------------------------------------------------
    | Biến $id: Nếu có thì cập nhật. Ngược lại thì tạo mới
    */
    public function SaveItem($data,$id=null){
        return $this->model->updateOrCreate(['id'=>$id], $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Lưu mới - cập nhật dữ liệu
    |--------------------------------------------------------------------------
    | Biến $data: Mảng dữ liệu đầu vào
    |--------------------------------------------------------------------------
    | Biến $id: Nếu có thì cập nhật. Ngược lại thì tạo mới
    */
    public function SaveMultiItem($data,$ids=array()){
        return $this->model->whereIn('id', $ids)->update($data);
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa 1 dòng dữ liệu theo id chính
    |--------------------------------------------------------------------------
    */
    public function DeleteOneItem($id, $folder_name=''){
        $row = $this->model->find($id);
        if($folder_name!=''){
            $path = Helper::GetFolder($folder_name).$row['photo'];
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        if($row) $this->model->find($id)->delete();
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy nhiều dòng dữ liệu theo chuỗi danh sách id
    |--------------------------------------------------------------------------
    */
    public function DeleteMultiItem($listid, $folder_name=''){
        $ids = explode(",", $listid);
        foreach($ids as $i=>$id_photo){
            $this->DeleteOneItem($id_photo, $folder_name);
        }
        $this->model->whereIn('id', $ids)->delete();
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa tạm 1 dòng dữ liệu theo id chính : sử dụng field xoatam trong db
    |--------------------------------------------------------------------------
    */
    public function DeleteTMPOneItem($id){
        $row = $this->model->find($id);
        $path = Helper::GetFolder('product').$row['photo'];
        if (file_exists($path)) {
            @unlink($path);
        }

        if($row) $this->SaveItem(['xoatam'=>1],$id);
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa tạm nhiều dòng dữ liệu theo chuỗi danh sách id
    |--------------------------------------------------------------------------
    */
    public function DeleteTMPMultiItem($listid){
        $ids = explode(",", $listid);
        foreach($ids as $i=>$id){
            $this->DeleteTMPOneItem($id);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả các dòng dữ liệu theo id_photo và type tương ứng
    |--------------------------------------------------------------------------
    */
    public function GetAllGallery($type,$idphoto,$com='product',$params=null){
        $row = $this->model;
        if($params){
            foreach($params as $k=>$v){
                $row = $row->where($k, $v);
            }
        }
        $row = $row->where('type', $type)->where('id_photo', $idphoto)->where('com', $com)->orderBy('stt', 'asc')->get();
        if($row){
            return $row->toArray();
        }
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Xóa nhiều dòng dữ liệu theo chuỗi danh sách id truyền vào
    |--------------------------------------------------------------------------
    | Trường hợp khi xóa 1 sản phẩm hay 1 bài viết
    |
    */
    public function DeleteGallery($id_photo,$kind,$type,$folder,$com){
        $gallery_items = $this->GetAllGallery($type,$id_photo,$com);
        foreach($gallery_items as $k=>$v){
            $row = $this->GetOneItem($v['id']);
            $path = Helper::GetFolder($folder).$row['photo'];
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        if($gallery_items) $this->model->where('id_photo', $id_photo)->where('kind', $kind)->where('type', $type)->where('com', $com)->delete();
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa nhiều dòng dữ liệu theo chuỗi danh sách id truyền vào
    |--------------------------------------------------------------------------
    | Trường hợp khi xóa nhiều sản phẩm hay nhiều bài viết
    |
    */
    public function DeleteMultiGallery($listid,$kind,$type,$folder,$com){
        $ids = explode(",", $listid);

        foreach($ids as $i=>$id_photo){
            $this->DeleteGallery($id_photo,$kind,$type,$folder,$com);
        }

        $this->model->whereIn('id_photo', $ids)->where('kind', $kind)->where('type', $type)->where('com', $com)->delete();
    }


    /*
    |--------------------------------------------------------------------------
    | Đếm số dòng dữ liệu gallery
    |--------------------------------------------------------------------------
    */
    public function CountItems($type){
        return $this->model->where('type', $type)->get()->count();
    }
}
