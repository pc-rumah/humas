<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $inventori = Inventory::all();

        return view('welcome', compact('inventori'));
    }
}
