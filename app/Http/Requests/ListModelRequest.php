<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListModelRequest extends FormRequest
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
            'party_id' => 'nullable|exists:parties,id',
            'electoral_district_id' => 'required|exists:electoral_districts,id',
            'election_id' => 'required|exists:elections,id',
        ];
    }
}
