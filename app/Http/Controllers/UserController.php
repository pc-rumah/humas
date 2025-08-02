<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(5);
        return view('manage_user.index', compact('user'));
    }

    public function create()
    {
        return view('manage_user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('admin');

        return redirect()->route('muser.index')->with('success', 'Berhasil Menambah User');
    }

    public function destroy(string $id)
    {
        $user = User::findOrfail($id);

        if (auth()->user()->id == $user->id) {
            return redirect()->route('muser.index')->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('muser.index')->with('success', 'Berhasil Menghapus User');
    }
}
