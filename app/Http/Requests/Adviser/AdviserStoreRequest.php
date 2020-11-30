<?php

namespace App\Http\Requests\Adviser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdviserStoreRequest extends FormRequest
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
            "name" => "required",
            "cedula" => "required|integer",
            "birthday" => "required|date",
            "gender" => "required",
            "client" => "required",
            "headquarter" => "required",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'cedula.required' => 'La cedula es obligatoria',
            'cedula.integer' => 'La cedula no es un numero',
            'birthday.required' => 'La fecha de cumpleaños es obligatoria',
            'gender.required' => 'El genero es obligatorio',
            'headquarter.required' => 'La sede es obligatoria',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
