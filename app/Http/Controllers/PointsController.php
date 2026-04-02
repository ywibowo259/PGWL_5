<?php

namespace App\Http\Controllers;

use App\Models\pointsModel; // Memastikan menggunakan model Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan ini ditambahkan untuk konversi geom

class PointsController extends Controller
{
    protected $points;

    public function __construct()
    {
        $this->points = new pointsModel();
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
        // validasi input
        $request->validate([
            'geometry_point' => 'required',
            'name' => 'required',
            'description' => 'required',
        ], [
            'geometry_point.required' => 'Geometri point harus diisi.',
            'name.required' => 'Nama harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
        ]);

        $data = [
            // Gunakan DB::raw agar database bisa membaca format geometri
            'geom' => DB::raw("ST_GeomFromText('".$request->geometry_point."')"),
            'name' => $request->name,
            'description' => $request->description,
        ];

        // simpan data ke database
        if ($this->points->create($data)) {
            // kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Data point berhasil disimpan!');
        }

        // kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'Gagal menyimpan data point!');
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
