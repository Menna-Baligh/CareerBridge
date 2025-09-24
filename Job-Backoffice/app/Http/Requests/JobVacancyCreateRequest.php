<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacancyCreateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'type' => 'required|in:Full-Time,Contract,Remote,Hybrid',
            'description' => 'required|string',
            'companyId' => 'required|exists:companies,id',
            'categoryId' => 'required|exists:job_categories,id',
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Title is required',
            'location.required' => 'Location is required',
            'salary.required' => 'Salary is required',
            'type.required' => 'Type is required',
            'description.required' => 'Description is required',
            'companyId.required' => 'Company is required',
            'categoryId.required' => 'Category is required',
            'companyId.exists' => 'Company not found',
            'categoryId.exists' => 'Category not found',
            'type.in' => 'Type must be Full-Time,Contract,Remote,Hybrid',
        ];
    }
}
