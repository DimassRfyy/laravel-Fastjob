<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobsRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string'],
            'skill_level' => ['required', 'string'],
            'type' => ['required', 'string'],
            'thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg,svg,webp'],
            'responsibilities.*' => 'required|string|max:255',
            'qualifications.*' => 'required|string|max:255',
        ];
    }
}
