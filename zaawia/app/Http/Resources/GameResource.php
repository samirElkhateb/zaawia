<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'game_id' => $this->game_id,
            'game_name' => $this->game_name,
            'is_completed' => $this->is_completed,
            'skill_id' => $this->skill_id,
            'message' => 'You are in game ' . $this->game_name,
        ];
    }
}
