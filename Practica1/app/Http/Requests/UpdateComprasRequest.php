<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComprasRequest extends FormRequest
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
            'id_proveedores' => 'required|integer',
            'id_productos' => 'required|integer',
            'id_forma_pago' => 'required|integer',
            'fecha_compra' => 'required|date',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'descuento' => 'required|numeric',
            'total' => 'required|numeric'
        ];
    }
}
