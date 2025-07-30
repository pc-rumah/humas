<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Inventory;

class WelcomeController extends Controller
{
    public function index()
    {
        $inventori = Inventory::all();
        $carousel = Carousel::first();

        return view('welcome', compact('inventori', 'carousel'));
    }
}
