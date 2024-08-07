<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $mahasiswas = User::where('role', 'mahasiswa')->where('is_verified', false)->get();
        return view('admin.dashboard', compact('mahasiswas'));
    }

    public function verify($id)
    {
        $user = User::find($id);
        $user->is_verified = true;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Mahasiswa berhasil diverifikasi.');
    }
}
