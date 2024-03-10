<?php

namespace App\Repositories\Repo;

use App\Repositories\BaseRepository;

class HistoryPayRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {             
        return \App\Models\HistoryPay::class;
    }
}