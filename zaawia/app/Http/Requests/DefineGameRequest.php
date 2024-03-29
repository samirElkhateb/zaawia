<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DefineGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'game_id' => 'required|integer',
            'game_name' => 'required|string|max:255',
            'skill_id' => 'required|integer',
            'is_completed' => 'required|boolean',
        ];
    }
}
