<?php

namespace App\Repositories\Repo;

use App\Repositories\BaseRepository;

class ProductPropertyRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {        
        $this->numberPerpage = config('config_all.numberperpage.product');
        return \App\Models\ProductProperty::class;
    }
}