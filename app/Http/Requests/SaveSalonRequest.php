<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSalonRequest extends FormRequest
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
            'nombre' => 'required',
            'capacidad' => 'integer|required',
            'convention_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'convention_id.required' => 'El campo Centro de Convención es obligatorio'
        ];
    }
}
