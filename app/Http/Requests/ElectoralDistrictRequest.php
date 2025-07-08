<?php

namespace App\Http\Requests;

use App\Enums\Region;
use Illuminate\Foundation\Http\FormRequest;

class ElectoralDistrictRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'region' => 'required|in:' . implode(',', array_column(Region::cases(), 'value')),
            'seats_available' => 'nullable|integer|min:0',
        ];
    }
}
