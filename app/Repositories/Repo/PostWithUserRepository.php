<?php

namespace App\Repositories\Repo;

use App\Repositories\BaseRepository;

class PostWithUserRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {             
        return \App\Models\PostWithUser::class;
    }
}