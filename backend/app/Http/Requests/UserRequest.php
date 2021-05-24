<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UseranameRule;

class UserRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:superuser,admin,principal',
            'departement' => 'required_if:role,admin',
            'email' => 'email'
        ];

        if($this->id){
            $fields += array( 'username' => 'required|new UsernameRule');
        } else {
            $fields += array( 'username' => 'required');
        }

        return $fields;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'email' => 'format :attribute tidak sesuai',
            'min' => 'Minimal :attribute tidak sesuai',
            'required_if' => 'Jurusan harus dipilih'
        ];
    }
}
