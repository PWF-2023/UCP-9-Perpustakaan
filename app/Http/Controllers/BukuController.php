<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Contracts\View\View;

class BukuController extends Controller
{

    public function index(): View
    {
        return view('bukus.index', ['bukus' => Buku::all()]);
    }
}

