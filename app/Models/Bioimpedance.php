<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bioimpedance extends Model
{
    protected $fillable = [
        'user_id',
        'exam_date',
        'weight',
        'imc',
        'fat_percentage',
        'muscle_percentage',
        'basal_metabolism',
        'metabolic_age',
        'visceral_fat'
    ];
}
