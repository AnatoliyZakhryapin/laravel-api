<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string', Rule::unique('projects')->ignore($this->project)],
            'content' => 'nullable|min:5|string',
            'url' => ['required', 'max:255', 'string', Rule::unique('projects')->ignore($this->project)],
            'tecnologies' => 'exists:tecnologies,id'
        ];
    }
}
