<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Vendedores;

class VendedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Función para mostrar la lista de productos
    public function index(): View
    {
        return view('vendedores.index', [
            'vendedores' => Vendedores::latest()->paginate(4)
        ]);
    }
}
