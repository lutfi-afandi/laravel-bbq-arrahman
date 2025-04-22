<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function show(string $id)
    {
        $jadwal = Jadwal::find($id);
        $title = 'Daftar Kehadiran';
        $kelompoks = Kelompok::with('mahasiswa')->where('jadwal_id', $jadwal->id)
            ->get();
        // dd($kelompoks[0]->p2 === null);
        return view('tutor.absen.index', compact(
            'title',
            'jadwal',
            'kelompoks',
        ));
    }

    public function update(Request $request, string $id)
    {
        $kelompok = Kelompok::findOrFail($id);

        DB::beginTransaction();

        try {
            $kelompok->p1  = $request->p1;
            $kelompok->p2  = $request->p2;
            $kelompok->p3  = $request->p3;
            $kelompok->p4  = $request->p4;
            $kelompok->p5  = $request->p5;
            $kelompok->p6  = $request->p6;
            $kelompok->p7  = $request->p7;
            $kelompok->p8  = $request->p8;
            $kelompok->p9  = $request->p9;
            $kelompok->p10 = $request->p10;
            $kelompok->p11 = $request->p11;
            $kelompok->p12 = $request->p12;
            $kelompok->save();
            DB::commit();

            toast_notif('success', 'Berhasil menyimpan kehadiran');
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            toast_notif('error', 'Terjadi Kesalahan! ' . $th);
        }
    }

    public function index() {}
    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
    public function destroy(string $id) {}
}
