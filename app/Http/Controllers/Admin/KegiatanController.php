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
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:1024',
        ]);

        DB::beginTransaction();

        try {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kegiatan', $fileName);

            Kegiatan::create([
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'deskripsi' => $validated['deskripsi'],
                'foto' => $fileName,
            ]);

            DB::commit();

            swal_notif('success', 'Berhasil', 'Kegiatan telah ditambah!');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();

            report($th); // logging profesional

            swal_notif('error', 'Gagal', 'Terjadi kesalahan sistem!');
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
