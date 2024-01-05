<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'instructor_id' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'level' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'instructor_id.required' => 'The instructor field is required.'
        ];
    }
}
