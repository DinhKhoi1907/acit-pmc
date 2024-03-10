<?php

namespace App\Repositories\Repo;

use App\Repositories\BaseRepository;

use Helper;

class QuestionRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        $this->numberPerpage = config('config_all.numberperpage.question');
        return \App\Models\Question::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Lấy tất cả dòng dữ liệu theo type tương ứng - hoặc lọc theo danh mục - hoặc tìm theo từ khóa - để hiển thị ra view
    |--------------------------------------------------------------------------
    */
    public function GetQuestions($params=null, $relations = null, $paginate=false, $showHienthi=false, $limit=0){
        $run_sql = $this->model;

        if($relations){
            $run_sql = $run_sql->with($relations);
        }

        if($params){
            foreach($params as $k=>$v){
                if($k!='keyword' && $v>0){
                    $run_sql=$run_sql->where($k, $v);
                }
                else if($k=='xoatam'){
                    $run_sql=$run_sql->where($k, $v);
                }
                else if($k=='keyword_filter'){
                    $run_sql=$run_sql->Where('noidung', 'like', '%' . $v . '%')->orWhere('answer', 'like', '%' . $v . '%');
                }
                else if($k=='keyword'){
                    $run_sql=$run_sql->like('hoten', $v);
                }else{
                    $run_sql=$run_sql->where($k, $v);
                }
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
            //
            return $run_sql->get()->toArray();
        } 
        return $run_sql = $run_sql->paginate($this->numberPerpage)->withQueryString();
    }
}