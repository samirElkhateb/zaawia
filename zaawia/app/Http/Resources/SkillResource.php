<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'skill_id' => $this->skill_id,
            'skill_name' => $this->skill_name,
            'is_completed' => $this->is_completed,
            'child_id' => $this->child_id,
            'message' => 'You are in skill ' . $this->skill_name,
        ];
    }
}
