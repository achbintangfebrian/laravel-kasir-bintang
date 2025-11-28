<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriProdukRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:100',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            // For update requests, make fields optional
            $rules = [
                'name' => 'sometimes|required|string|max:100',
            ];
        }

        return $rules;
    }
}