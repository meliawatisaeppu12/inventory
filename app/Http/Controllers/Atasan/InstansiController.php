<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use App\Models\instansi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        $instansi = instansi::all();

        return view('atasan.content.instansi.index', compact('instansi'));
    }
}
