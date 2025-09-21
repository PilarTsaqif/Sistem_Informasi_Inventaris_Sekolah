<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Menampilkan halaman landing (halaman utama publik).
     */
    public function index()
    {
        return view('landing');
    }
}