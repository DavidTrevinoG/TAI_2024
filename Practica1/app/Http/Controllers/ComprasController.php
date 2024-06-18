<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Compras;

class ComprasController extends Controller
{
    public function index(): View
    {
        return view('compras.index', [
            'compras' => Compras::latest()->paginate(4)
        ]);
    }
}
