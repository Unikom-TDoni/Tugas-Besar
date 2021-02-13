<?php

namespace App\Http\Requests\pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class FilterOutlineProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_kota' => 'required|numeric|exclude_if:id_kota,0',
            'jenis' => 'required|string|exclude_if:jenis,0'
        ];
    }
}
