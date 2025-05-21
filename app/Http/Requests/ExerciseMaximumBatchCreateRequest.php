<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseMaximumBatchCreateRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'maximums' => 'required|array|min:1',
            'maximums.*.exercise_id' => 'required|integer|exists:exercises,id',
            'maximums.*.max_reps' => 'required|integer|min:1',
            'maximums.*.workload' => 'required|numeric|min:0',
            'maximums.*.date' => 'required|date',
        ];
    }
} 