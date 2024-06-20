<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Cotizaciones;

class CotizacionesController extends Controller
{
    public function index(): View
    {
        return view('cotizaciones.index', [
            'Cotizaciones' => Cotizaciones::latest()->paginate()
        ]);
    }
}
