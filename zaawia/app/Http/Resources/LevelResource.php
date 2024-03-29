<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'level_id' => $this->level_id,
            'game_id' => $this->game_id,
            'level_number' => $this->level_number,
            'child_answer' => $this->child_answer,
            'message' => 'You are in level ' . $this->level_number,
        ];
    }
}
