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
}