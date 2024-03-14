<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataCutiKaryawanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'jenis_cuti' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'lama_cuti' => 'required',
            'alasan_cuti' => 'required'
        ];
    }
}
