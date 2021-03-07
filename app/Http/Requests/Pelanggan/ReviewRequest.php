<?php

namespace App\Http\Requests\pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'kode_transaksi' => 'required',
            'id_pelanggan' => 'required',
            'id_kendaraan' => 'required',
            'telp' => 'required',
            'nama' => 'required',
            'ulasan' => 'required|string',
            'rating' => 'required|numeric'
        ];
    }
}
