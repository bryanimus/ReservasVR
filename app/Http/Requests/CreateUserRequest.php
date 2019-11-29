<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'email|required|unique:users,email',
            'role_id' => 'required',
            'ministry_id' => 'required_if:opcType,==,1',
            'department_id' => 'required_if:opcType,==,2',
            'password' => 'required|confirmed'
        ];
    }

    public function messages(){
        return [
            'role_id.required' => 'El campo Rol es obligatorio',
            'ministry_id.required_if' => 'El campo Ministerio es obligatorio',
            'department_id.required_if' => 'El campo Departamento es obligatorio'
        ];
    }
}
