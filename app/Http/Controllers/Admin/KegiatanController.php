<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $title = 'Data Kegiatan';
        $kegiatans = Kegiatan::orderBy('id', 'desc')->get();
        return view('admin.kegiatan.index', compact(
            'kegiatans',
            'title',
        ));
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024', // Validasi file gambar
        ]);

        // Ambil data kegiatan berdasarkan ID
        $kegiatan = new Kegiatan();

        DB::beginTransaction();
        try {
            // Simpan foto baru
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate nama_kegiatan unik
            $file->storeAs('public/kegiatan', $fileName); // Simpan ke storage

            // Update database
            $kegiatan->foto = $fileName;
            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->save();

            DB::commit();

            swal_notif('success', 'Berhasil', 'Kegiatan telah ditambah!');
            return back();
        } catch (\Throwable $th) {
            // throw $th;

            swal_notif('error', 'Gagal', 'Terjadi kesalahan!');
            return back();
        }
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->foto) {
            Storage::delete('public/kegiatan/' . $kegiatan->foto);
        }

        $kegiatan->delete();

        swal_notif('success', 'Berhasil', 'Data telah dihapus!');
        return back();
    }
}
