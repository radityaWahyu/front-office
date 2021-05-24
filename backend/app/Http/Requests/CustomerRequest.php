<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CustomerRequest extends FormRequest
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
        $fields = [
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'telp' => 'required|numeric',
        ];

        return $fields;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus disi angka'
        ];
    }
}
