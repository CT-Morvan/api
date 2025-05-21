<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseMaximumListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get the 10 most recent exercise maximums for this exercise
        $maximums = $this->whenLoaded('exerciseMaximums', function () {
            return $this->exerciseMaximums
                ->sortByDesc('date')
                ->take(10);
        });
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'video_url' => $this->video_url,
            'image_url' => $this->image_url,
            'maximums' => ExerciseMaximumResource::collection($maximums),
        ];
    }
} 