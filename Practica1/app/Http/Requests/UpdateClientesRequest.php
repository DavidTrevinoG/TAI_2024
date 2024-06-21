<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:250',
            'correo' => 'required|string|max:250',
            'telefono' => 'required|string|max:250',
            'direccion' => 'required|string|max:250',
            'rfc' => 'required|string|max:250',
            'razon_social' => 'required|string|max:250',
            'codigo_postal' => 'required|string|max:250',
            'regimen_fiscal' => 'required|string|max:250'
        ];
    }
}
