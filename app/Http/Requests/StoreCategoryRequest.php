<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30|unique:categories,name',
            'icon' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada, silakan gunakan nama lain.',
            'icon.required' => 'Icon kategori wajib diupload.',
            'icon.mimes'    => 'Icon harus berupa file jpeg, png, jpg, atau svg.',
        ];
    }
}
