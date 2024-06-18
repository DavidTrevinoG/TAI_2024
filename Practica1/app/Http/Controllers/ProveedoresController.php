<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Proveedores;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Función para mostrar la lista de productos
    public function index(): View
    {
        return view('proveedores.index', [
            'Proveedores' => Proveedores::latest()->paginate(4)
        ]);
    }
}
