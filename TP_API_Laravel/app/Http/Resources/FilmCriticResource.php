<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmCriticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'release_year' => $this->release_year,
            'length' => $this->length,
            'description' => $this->description,
            'rating' => $this->rating,
            'language' => $this->language->name,
            'special_features' => $this->special_features,
            'image' => $this->image,
            'critics' => CriticResource::collection($this->critics)
        ];
    }
}
