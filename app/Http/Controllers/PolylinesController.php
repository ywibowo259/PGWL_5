<?php

namespace App\Http\Controllers;

use App\Models\polylinesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini kembali untuk konversi geometri

class PolylinesController extends Controller
{
    protected $polylines; // ← tambahkan property ini

    public function __construct()
    {
        $this->polylines = new polylinesModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi input (disesuaikan dengan form field polylines Anda)
        $request->validate([
            'geometry_polylines' => 'required',
            'name' => 'required',
            'description' => 'required',
        ], [
            'geometry_polylines.required' => 'Geometri polylines harus diisi.',
            'name.required' => 'Nama harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
        ]);

        $data = [
            // Gunakan DB::raw agar database PostgreSQL mengerti format spasialnya
            'geom' => DB::raw("ST_GeomFromText('".$request->geometry_polylines."')"),
            'name' => $request->name,
            'description' => $request->description,
        ];

        // simpan data ke database
        if (!$this->polylines->create($data)) {
            return redirect()->back()->with('error', 'Polylines gagal disimpan!');
        }

        // kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Polylines berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
