<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelompokController extends Controller
{

    public function index() {}
    public function create() {}

    public function store(Request $request)
    {
        // dd($request->all(), $request->mahasiswa_id == null);
        if ($request->mahasiswa_id == null) {
            swal_notif('error', 'Gagal!', 'Pilih mahasiswa!');
            return back();
        } else {
            // 
            DB::beginTransaction();
            try {
                $mahasiswaIds = is_array($request->mahasiswa_id) ? $request->mahasiswa_id : explode(',', $request->mahasiswa_id);
                // dd(count($mahasiswaIds));
                for ($i = 0; $i < count($mahasiswaIds); $i++) {
                    $kelompok = new Kelompok();
                    $kelompok->jadwal_id = $request->jadwal_id;
                    $kelompok->mahasiswa_id = $mahasiswaIds[$i];
                    $kelompok->save();
                }

                DB::commit();

                toast_notif('success', 'Praktikan ditambahkan!');
                return back();
            } catch (\Throwable $th) {
                // throw $th;
                swal_notif('error', 'Gagal!', 'terjadi kesalahan!' . $th);
                return back();
            }
        }
    }


    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        $kelompok  = Kelompok::findOrFail($id);
        $kelompok->delete();

        toast_notif('success', 'Peserta telah dihapus');
        return back();
    }
}
