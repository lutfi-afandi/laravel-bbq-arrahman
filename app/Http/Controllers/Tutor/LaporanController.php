<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Jadwal;
use App\Models\Laporan;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Peserta';

        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::with('gelombang')->first();

        $gelombang_id = $informasi->gelombang_id;
        $gelombang_selected = Gelombang::where('id', $gelombang_id)->first();

        $tutor = Tutor::where('username', auth()->user()->username)->first();

        $laporans = Laporan::with('gelombang', 'jadwal')
            ->where('gelombang_id', $informasi->gelombang_id)
            ->whereHas('jadwal', function ($query) use ($tutor) {
                $query->where('tutor_id', $tutor->id);
            })
            ->orderBy('id', 'DESC')
            ->get();

        if ($request->all()) {
            $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();
            $laporans = Laporan::with('gelombang', 'jadwal')
                ->where('gelombang_id', $gelombang_selected->id)
                ->whereHas('jadwal', function ($query) use ($tutor) {
                    $query->where('tutor_id', $tutor->id);
                })
                ->orderBy('id', 'DESC')
                ->get();
        }
        // dd($laporans[0]->jadwal);
        return view('tutor.laporan.index', compact(
            'title',
            'informasi',
            'tutor',
            'laporans',
            'gelombang_selected',
            'tahuns',
        ));
    }

    public function create()
    {
        $title = 'Data Peserta';

        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::with('gelombang')->first();
        $tutor = Tutor::where('username', auth()->user()->username)->first();

        $jadwals = Jadwal::with('tutor', 'gelombang', 'waktu', 'kelompok.mahasiswa')
            ->where('gelombang_id', $informasi->gelombang_id)
            ->where('tutor_id', $tutor->id)
            ->get();

        return view('tutor.laporan.create', compact(
            'title',
            'tahuns',
            'informasi',
            'tutor',
            'jadwals',
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validasi =  [
            'jadwal_id' => 'required|exists:jadwals,id',
            'gelombang_id' => 'required',
            'no_pertemuan' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'jumlah_peserta' => 'required|integer|min:0',
            'hadir' => 'required|integer|min:0',
            'izin' => 'required|integer|min:0',
            'absen' => 'required|integer|min:0',
            'materi' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'foto'     => 'required|file|mimes:jpg,jpeg,png,gif|max:512',
        ];

        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), $validasi);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput(); // Agar input sebelumnya tidak hilang
            }

            $laporan = new Laporan();
            $laporan->jadwal_id = $request->jadwal_id;
            $laporan->gelombang_id = $request->gelombang_id;
            $laporan->no_pertemuan = $request->no_pertemuan;
            $laporan->tanggal = $request->tanggal;
            $laporan->jumlah_peserta = $request->jumlah_peserta;
            $laporan->hadir = $request->hadir;
            $laporan->izin = $request->izin;
            $laporan->absen = $request->absen;
            $laporan->materi = $request->materi;
            $laporan->keterangan = $request->keterangan;

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');

                $filename = "Laporan-gel" . date('His') . "." . $file->getClientOriginalExtension();
                $path = $file->storeAs('laporan', $filename, 'public');
                $laporan->foto = $path;
            }
            $laporan->save();

            DB::commit();
            swal_notif('success', 'Berhasil!', 'Data berhasil disimpan.');
            return redirect()->route('tutor.laporan.index');
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
            swal_notif('error', 'Gagal!', 'Terjadi kesalahan. ' + $e);
            return redirect()->back();
        }
    }

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        $laporan  = Laporan::findOrFail($id);
        if ($laporan->foto) {
            Storage::delete('public/' . $laporan->foto);
        }
        $laporan->delete();

        toast_notif('success', 'Laporan telah dihapus');
        return back();
    }
}
