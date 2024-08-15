<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventariosRequest extends FormRequest
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
            'id_productos' => 'required|exists:products,id',
            'fecha_entrada' => 'nullable|date',
            'fecha_salida' => 'nullable|date',
            'motivo' => 'required|string',
            'movimiento' => 'required|string',
            'cantidad' => 'required|numeric|min:0'
            // Agrega esta línea
        ];
    }
}
