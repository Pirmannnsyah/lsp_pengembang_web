<?php

namespace App\Http\Controllers;

use App\Models\Daftarmahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaftarmahasiswaController extends Controller
{
    // Menampilkan daftar registrasi
    public function index()
    {
        // Retrieve all Daftarmahasiswa records
        $daftarmahasiswa = Daftarmahasiswa::all();

        // Pass the data to the view
        return view('daftarmahasiswa.index', compact('daftarmahasiswa'));
    }

    // Menampilkan formulir pendaftaran
    public function create()
    {
        return view('daftarmahasiswa.create');
    }

    // Menyimpan data registrasi
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'religion' => 'required|string|max:255',
            'address' => 'required|string',
            'program_study' => 'required|string|max:255',
            'entry_path' => 'required|string|max:255',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Mengupload file bukti pembayaran
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filePath = $file->store('payment_proofs', 'public');
        }

        // Menyimpan data registrasi
        Daftarmahasiswa::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'birth_date' => $request->input('birth_date'),
            'religion' => $request->input('religion'),
            'address' => $request->input('address'),
            'program_study' => $request->input('program_study'),
            'entry_path' => $request->input('entry_path'),
            'payment_proof' => $filePath ?? null,
        ]);

        return redirect()->route('daftarmahasiswa.index')->with('success', 'Pendaftaran berhasil!');
    }

    // Menampilkan formulir untuk mengedit data
    public function edit($id)
    {
        $daftarmahasiswa = Daftarmahasiswa::find($id);
        return view('daftarmahasiswa.edit', compact('daftarmahasiswa'));
    }

    // Mengupdate data registrasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'religion' => 'required|string|max:255',
            'address' => 'required|string',
            'program_study' => 'required|string|max:255',
            'entry_path' => 'required|string|max:255',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $daftarmahasiswa = Daftarmahasiswa::findOrFail($id);

        // Mengupload file bukti pembayaran jika ada
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filePath = $file->store('payment_proofs', 'public');
            // Menghapus file lama jika ada
            if ($daftarmahasiswa->payment_proof) {
                Storage::disk('public')->delete($daftarmahasiswa->payment_proof);
            }
        } else {
            $filePath = $daftarmahasiswa->payment_proof;
        }

        $daftarmahasiswa->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'birth_date' => $request->input('birth_date'),
            'religion' => $request->input('religion'),
            'address' => $request->input('address'),
            'program_study' => $request->input('program_study'),
            'entry_path' => $request->input('entry_path'),
            'payment_proof' => $filePath,
        ]);

        return redirect()->route('daftarmahasiswa.index')->with('success', 'Pendaftaran berhasil diperbarui!');
    }
}
