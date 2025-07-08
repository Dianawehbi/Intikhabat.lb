<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdScanRequest extends FormRequest
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
            'image_path' => 'required|string|max:255',
            'extracted_date' => 'required|date', // you can change this if it's not in date format
            'matched' => 'required|boolean',
            'uploaded_at' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
