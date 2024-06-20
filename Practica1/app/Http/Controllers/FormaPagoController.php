<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\FormaPago;

class FormaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Función para mostrar la lista de productos
    public function index(): View
    {
        return view('formapago.index', [
            'FormaPago' => FormaPago::latest()->paginate()
        ]);
    }
}
