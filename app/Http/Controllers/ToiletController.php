<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToiletController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string',
            'description' => 'nullable|string',
            'facilities'  => 'nullable|array',
            'open'        => 'nullable',
            'close'       => 'nullable',
            'fee'         => 'nullable|string|max:50',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'contact'     => 'nullable|string|max:100',
            'access'      => 'nullable|array',
        ]);

        // Simpan foto jika ada
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('toilets', 'public');
        }

        // Simpan data ke database (contoh, pastikan model Toilet sudah ada)
        // \App\Models\Toilet::create([
        //     'name'        => $validated['name'],
        //     'address'     => $validated['address'],
        //     'description' => $validated['description'] ?? null,
        //     'facilities'  => json_encode($validated['facilities'] ?? []),
        //     'open'        => $validated['open'] ?? null,
        //     'close'       => $validated['close'] ?? null,
        //     'fee'         => $validated['fee'] ?? null,
        //     'photo'       => $validated['photo'] ?? null,
        //     'contact'     => $validated['contact'] ?? null,
        //     'access'      => json_encode($validated['access'] ?? []),
        // ]);

        // Untuk demo, hanya redirect dengan pesan sukses
        return back()->with('success', 'Data toilet berhasil dikirim!');
    }
}