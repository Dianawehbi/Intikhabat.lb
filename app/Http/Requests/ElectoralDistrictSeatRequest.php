<?php

namespace App\Http\Requests;

use App\Enums\Sect;
use Hamcrest\Core\Set;
use Illuminate\Foundation\Http\FormRequest;

class ElectoralDistrictSeatRequest extends FormRequest
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
            'electoral_district_id' => 'required|exists:electoral_districts,id',
            'sect' => 'required|in:' . implode(',', array_column(Sect::cases(), 'value')),
            'seat_count' => 'required|integer|min:1',
        ];
    }
}
