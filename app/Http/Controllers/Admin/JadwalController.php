<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Jadwal;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\Tutor;
use App\Models\Waktu;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Jadwal Tutor';
        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::first();
        $gelombang_selected = Gelombang::where('id', $informasi->gelombang_id)->first();
        $waktus = Waktu::all();
        $jadwals = Jadwal::with('tutor', 'gelombang', 'waktu', 'kelompok.mahasiswa')->where('gelombang_id', $informasi->gelombang_id)->get();

        $tutors = Tutor::all();

        // dd($jadwals);
        if ($request->all()) {
            $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();
            // dd($gelombang_selected, $request->all());
            $jadwals = Jadwal::with('tutor', 'gelombang', 'waktu', 'kelompok.mahasiswa')->where('gelombang_id', $gelombang_selected->id)->get();
            // 
        }

        return view('admin.jadwal.index', compact(
            'title',
            'tahuns',
            'jadwals',
            'gelombang_selected',
            'informasi',
            'tutors',
            'waktus',
        ));
    }


    public function create() {}

    public function show(string $id)
    {
        $jadwal = Jadwal::with('tutor', 'gelombang', 'waktu', 'kelompok.mahasiswa')->findOrFail($id);
        $kelompoks = Kelompok::with('mahasiswa', 'jadwal')->where('jadwal_id', $jadwal->id)->get();

        $mahasiswas = Mahasiswa::with('kelompok')->doesntHave('kelompok')
            ->where('gelombang_id', $jadwal->gelombang_id)
            ->where('jk', $jadwal->tutor->jenis_kelamin)
            ->get();
        // dd($mahasiswas);

        return view('admin.jadwal.show', compact(
            'jadwal',
            'kelompoks',
            'mahasiswas',
        ));
    }

    public function store(Request $request)
    {
        $gelombang = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();
        $tutor_id = $request->tutor_id;
        $waktu_id = $request->waktu_id;

        $jadwal_exist = Jadwal::where('tutor_id', $tutor_id)
            ->where('waktu_id', $waktu_id)
            ->where('gelombang_id', $gelombang->id)
            ->first();

        if (!$jadwal_exist) {

            $jadwal = new Jadwal();
            $jadwal->gelombang_id = $gelombang->id;
            $jadwal->tutor_id = $tutor_id;
            $jadwal->waktu_id = $waktu_id;
            $jadwal->save();

            swal_notif('success', 'Berhasil', 'Jadwal telah disimpan!');
            return back();
        } else {
            swal_notif('error', 'Gagal', 'Jadwal Sudah Ada!');
            return back()->withInput();
        }
    }


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
        $jadwal  = Jadwal::findOrFail($id);
        $jadwal->delete();

        toast_notif('success', 'Jadwal telah dihapus');
        return back();
    }
}
