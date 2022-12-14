<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriBukuRequest extends FormRequest
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

        $rules = [
            'nama_kategori' => 'required',
        ];
        return $rules;
    }
    public function attributes()
    {
        return [
            'nama_kategori'            => 'nama kategori',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute ini wajib diisi',
        ];
    }
}
