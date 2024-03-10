<?php

namespace App\Repositories\Repo;

use App\Repositories\BaseRepository;

class CategoryPropertyRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {        
        $this->numberPerpage = config('config_all.numberperpage.category');
        return \App\Models\CategoryProperty::class;
    }
}