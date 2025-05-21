<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BioimpedanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'exam_date' => $this->exam_date,
            'weight' => $this->weight,
            'imc' => $this->imc,
            'fat_percentage' => $this->fat_percentage,
            'muscle_percentage' => $this->muscle_percentage,
            'basal_metabolism' => $this->basal_metabolism,
            'metabolic_age' => $this->metabolic_age,
            'visceral_fat' => $this->visceral_fat,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 