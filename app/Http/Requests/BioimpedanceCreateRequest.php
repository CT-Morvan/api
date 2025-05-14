<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BioimpedanceCreateRequest extends FormRequest
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
            'exam_date' => 'required|date',
            'weight' => 'required|numeric',
            'imc' => 'required|numeric',
            'fat_percentage' => 'required|numeric',
            'muscle_percentage' => 'required|numeric',
            'basal_metabolism' => 'required|numeric',
            'metabolic_age' => 'required|numeric',
            'visceral_fat' => 'required|numeric',
        ];
    }
}
