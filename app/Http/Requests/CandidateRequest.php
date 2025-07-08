<?php

namespace App\Http\Requests;

use App\Enums\Position;
use App\Enums\Sect;
use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'sect' => 'required|in:' . implode(',', array_column(Sect::cases(), 'value')),
            'position' => 'required|in:' . implode(',', array_column(Position::cases(), 'value')),
            'list_model_id' => 'required|exists:list_models,id',
            'electoral_district_id' => 'required|exists:electoral_districts,id',
            'won' => 'nullable|boolean',
            'votes_count' => 'nullable|integer|min:0',
        ];
    }
}
