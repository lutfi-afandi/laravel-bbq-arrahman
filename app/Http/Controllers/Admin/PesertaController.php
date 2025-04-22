<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $title = 'Data Peserta';
        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::with('gelombang')->first();

        $gelombang_id = $informasi->gelombang_id;
        $gelombang_selected = Gelombang::where('id', $gelombang_id)->first();
        // dd($gelombang_selected);

        $mahasiswas = Mahasiswa::with('gelombang', 'jurusan', 'kelas', 'dosen')->where('gelombang_id', $gelombang_id)->get();

        if ($request->all()) {
            $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();

            $mahasiswas = Mahasiswa::with('gelombang', 'jurusan', 'kelas', 'dosen')->where('gelombang_id', $gelombang_selected->id)->get();
        }
        return view('admin.mahasiswa.index', compact(
            'tahuns',
            'mahasiswas',
            'informasi',
            'gelombang_selected',
        ));
    }

    public function keterangan(Request $request)
    {
        $mahasiswa = Mahasiswa::findOrFail($request->id);

        $mahasiswa->keterangan = $request->keterangan;
        $mahasiswa->save();

        toast_notif('success', 'Berhasil mengubah data');
        return redirect()->back();
    }

    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}

    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::where('username', $mahasiswa->npm)->first();

        DB::beginTransaction();
        try {
            $mahasiswa->password = Hash::make($request->password);
            $user->password = Hash::make($request->password);
            $mahasiswa->save();
            $user->save();
            DB::commit();

            toast_notif('success', 'Password telah di-Reset!');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast_notif('error', 'terjadi kesalahan!');
            return redirect()->back();
            //throw $th;
        }
    }


    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::where('username', $mahasiswa->npm)->first();

        if ($user->id == Auth::user()->id) {
            swal_notif('error', 'Gagal!', 'Tidak dapat menghapus user yang aktif');
            return back();
        } else {
            DB::beginTransaction();
            try {
                $mahasiswa->delete();
                $user->delete();

                DB::commit();
                toast_notif('success', 'User dihapus!');
                return back();
            } catch (\Throwable $th) {
                swal_notif('error', 'Gagal!', 'Terjadi kesalahan');
                return back();
            }
        }
    }

    public function kbm(Request $request)
    {
        $title = 'Data Peserta';
        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::with('gelombang')->first();

        $gelombang_id = $informasi->gelombang_id;
        $gelombang_selected = Gelombang::where('id', $gelombang_id)->first();
        // dd($gelombang_selected);

        $mahasiswas = Mahasiswa::with('gelombang', 'kelas', 'jurusan', 'kelompok.jadwal.waktu', 'kelompok.jadwal.tutor')->where('gelombang_id', $gelombang_id)->get();

        if ($request->all()) {
            $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();

            $mahasiswas = Mahasiswa::with('gelombang', 'kelas', 'jurusan', 'kelompok.jadwal.waktu', 'kelompok.jadwal.tutor')->where('gelombang_id', $gelombang_selected->id)->get();
        }
        return view('admin.mahasiswa.kbm', compact(
            'tahuns',
            'mahasiswas',
            'informasi',
            'gelombang_selected',
        ));
    }
}
