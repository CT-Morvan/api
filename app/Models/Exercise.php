<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'video_url',
        'image_url',
    ];
    
    public function exerciseMaximums(): HasMany
    {
        return $this->hasMany(ExerciseMaximum::class);
    }
}
