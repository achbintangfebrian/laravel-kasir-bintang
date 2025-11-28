<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
            'nama' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategori_produk,id',
            'image' => 'required|string|max:100',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            // For update requests, make fields optional
            $rules = [
                'nama' => 'sometimes|required|string|max:100',
                'harga' => 'sometimes|required|integer',
                'stok' => 'sometimes|required|integer',
                'kategori_id' => 'sometimes|required|exists:kategori_produk,id',
                'image' => 'sometimes|required|string|max:100',
            ];
        }

        return $rules;
    }
}