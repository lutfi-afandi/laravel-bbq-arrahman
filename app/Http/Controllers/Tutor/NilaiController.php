<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function show(string $id)
    {
        $jadwal = Jadwal::find($id);
        $title = 'Daftar Nilai';
        $kelompoks = Kelompok::with('mahasiswa')->where('jadwal_id', $jadwal->id)
            ->get();
        // dd($kelompoks[0]->p2 === null);
        return view('tutor.nilai.index', compact(
            'title',
            'jadwal',
            'kelompoks',
        ));
    }

    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $kelompok = Kelompok::findOrFail($id);

        DB::beginTransaction();

        try {
            $kelompok->kehadiran       = $request->kehadiran;
            $kelompok->mutabaah        = $request->mutabaah;
            $kelompok->uts             = $request->uts;
            $kelompok->kegiatan_wajib  = $request->kegiatan_wajib;
            $kelompok->wudhu           = $request->wudhu;
            $kelompok->sholat          = $request->sholat;
            $kelompok->tilawah         = $request->tilawah;
            $kelompok->uas_tertulis    = $request->uas_tertulis;
            $kelompok->nilai_akhir     = $request->nilai_akhir;
            $kelompok->huruf_mutu     = $request->huruf_mutu;
            $kelompok->updated_nilai   = now(); // atau pakai $request->updated_nilai jika kamu memang mengirimnya

            $kelompok->save();
            DB::commit();

            toast_notif('success', 'Berhasil menyimpan nilai kelompok');
            return back();
        } catch (\Throwable $th) {
            return $th;
            DB::rollBack();
            toast_notif('error', 'Terjadi Kesalahan! ' . $th->getMessage());
            return back();
        }
    }

    public function index() {}

    public function create() {}
    public function edit(string $id) {}

    public function store(Request $request) {}


    public function destroy(string $id) {}
}
