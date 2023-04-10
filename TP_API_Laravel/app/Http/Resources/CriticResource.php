<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CriticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'score' => $this->score,
            'comment' => $this->comment,
            'user_id' => $this->user_id,
            'film_id' => $this->film_id
        ];
    }
}
