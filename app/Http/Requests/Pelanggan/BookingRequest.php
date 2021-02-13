<?php

namespace App\Http\Requests\Pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'id_pelanggan' => 'required',
            'id_kendaraan' => 'required',
            'nama' => 'required|string',
            'telp' => 'required|numeric',
            'alamat' => 'required|string',
            'nomor_ktp' => 'required|string|max:50',
            'tanggal_mulai_peminjaman' => 'required|date',
            'tanggal_akhir_peminjaman' => 'required|date',
            'harga_sewa' => 'required|numeric',
            'denda' => 'required|numeric',
            'is_transfer' => 'required|between:0,1',
            'is_diantar' => 'required|between:0,1',
            'nama_bank' => 'required_if:is_transfer,1',
            'nama_rekening' => 'required_if:is_transfer,1',
            'nomor_rekening' => 'required_if:is_transfer,1',
            'alamat_antar' => 'required_if:is_diantar,1',
            'waktu_antar' => 'required_if:is_diantar,1',
        ];
    }
}
