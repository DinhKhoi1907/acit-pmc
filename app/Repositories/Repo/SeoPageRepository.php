<?php



namespace App\Repositories\Repo;



use App\Repositories\BaseRepository;



class SeoPageRepository extends BaseRepository

{

    //lấy model tương ứng

    public function getModel()

    {        

        return \App\Models\SeoPage::class;       

    }



    /*

    |--------------------------------------------------------------------------

    | Lấy 1 dòng dữ liệu theo params truyền vào

    |--------------------------------------------------------------------------

    */

    public function GetRepoStatic($params=null){

        $run_sql = $this->model;



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

        $run_sql = $run_sql->get()->keyBy('type');

        if($run_sql){

            $run_sql = $run_sql->toArray();

        }else{

            $run_sql = null;

        }

        return $run_sql;

    }

    

}