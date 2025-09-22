<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:companies,name',
            'address' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'website' => 'nullable|string|url|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Company name is required',
            'name.unique' => 'Company name already exists',
            'name.max' => 'Company name should not be more than 255 characters',
            'address.required' => 'Company address is required',
            'address.max' => 'Company address should not be more than 255 characters',
            'industry.required' => 'Company industry is required',
            'industry.max' => 'Company industry should not be more than 255 characters',
            'website.url' => 'Company website should be a valid URL',
            'owner_name.required' => 'Owner name is required',
            'owner_name.max' => 'Owner name should not be more than 255 characters',
            'owner_email.required' => 'Owner email is required',
            'owner_email.email' => 'Owner email should be a valid email address',
            'owner_email.unique' => 'Owner email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password should be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ];
    }
}
