<?php

namespace App\Http\Requests\Adviser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdviserUpdateRequest extends FormRequest
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
            "cedula" => "integer",
            "birthday" => "date",
        ];
    }

    public function messages()
    {
        return [
            'cedula.integer' => 'La cedula no es un numero',
            'birthday.date' => 'La fecha de cumpleaños no esta en el formato correcto',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
