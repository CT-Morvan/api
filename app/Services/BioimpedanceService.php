<?php

namespace App\Services;

use App\Models\Bioimpedance;

class BioimpedanceService
{
    public function create(int $user_id, array $data)
    {
        return Bioimpedance::create([
            'user_id' => $user_id,
            ...$data,
        ]);
    }

    public function getLatestByUser(int $user_id, int $limit = 10)
    {
        return Bioimpedance::query()
            ->where('user_id', $user_id)
            ->orderBy('exam_date', 'DESC')
            ->limit($limit)
            ->get();
    }
}