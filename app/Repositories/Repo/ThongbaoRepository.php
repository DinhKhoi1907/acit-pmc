<?php

namespace App\Repositories\Repo;

use App\Repositories\BaseRepository;

use Helper;

class ThongbaoRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        $this->numberPerpage = config('config_all.numberperpage.question');
        return \App\Models\Thongbao::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng - hoặc lọc theo danh mục - hoặc tìm theo từ khóa - để hiển thị ra view
    |--------------------------------------------------------------------------
    */
    public function GetThongbaos($params=null, $relations = null, $paginate=false, $showHienthi=false, $limit=0){
        $run_sql = $this->model;

        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($params){
            foreach($params as $k=>$v){
                $run_sql=$run_sql->where($k, $v);
            }
        }

        if($limit>0){
            $run_sql = $run_sql->limit($limit);
        }
        
        if($showHienthi){
            $run_sql = $run_sql->hienthi();
        }

        $run_sql = $run_sql->orderBy('ngaytao', 'desc');

        if(!$paginate){
            return $run_sql->get()->toArray();
        } 
        return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
    }

}