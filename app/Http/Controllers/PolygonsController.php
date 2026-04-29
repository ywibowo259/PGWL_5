<?php

namespace App\Http\Controllers;


use App\Models\polygonsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib untuk konversi ST_GeomFromText

class PolygonsController extends Controller
{
    protected $polygons; // Tambahkan property ini sesuai referensi

    //fungsi koneksi model ke controller
    public function __construct()
    {
        $this->polygons = new polygonsModel();
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
        // Validasi input disesuaikan dengan field form Anda
        $request->validate([
            'geometry_polygon' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'geometry_polygon.required' => 'Geometri polygon harus diisi.',
            'name.required' => 'Nama harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'description.string' => 'Field description harus berupa string.',
            'image.mimes' => 'Field image harus berupa gambar.',
            'image.max' => 'Field image tidak boleh lebih dari 2MB.',
            'image.image' => 'Field image harus berupa gambar.',
        ]);

        // mengecek dan membuat dirktori
        if (!is_dir('storage/images')) {
        mkdir('./storage/images', 0777);
        }

        // get the upload image
        if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
        $image->move('storage/images', $name_image);
        } else {
        $name_image = null;

        }

        $data = [
            // Gunakan DB::raw agar database PostgreSQL menerima format spasialnya
            'geom' => DB::raw("ST_GeomFromText('".$request->geometry_polygon."')"),
            'name' => $request->name,
            'description' => $request->description,
            'description.string' => 'Field description harus berupa string.',
            'image.mimes' => 'Field image harus berupa gambar.',
            'image.max' => 'Field image tidak boleh lebih dari 2MB.',
            'image.image' => 'Field image harus berupa gambar.',
            'image' => $name_image,
        ];

        // Simpan data ke database
        if (!$this->polygons->create($data)) {
            return redirect()->back()->with('error', 'Polygon gagal disimpan!');
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Polygon berhasil disimpan!');
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
