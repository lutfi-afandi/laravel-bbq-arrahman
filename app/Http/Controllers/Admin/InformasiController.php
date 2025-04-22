<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Informasi';
        $informasi = Informasi::with('gelombang')->first();
        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();

        return view('admin.informasi.index', compact(
            'informasi',
            'title',
            'tahuns',
        ));
    }

    public function status(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);
        // dd($request->all(), $informasi);
        $informasi->status_pendaftaran = $request->status_pendaftaran;
        $informasi->save();

        toast_notif('success', 'Status pendaftaran diubah');
        return back();
    }
    public function masa(Request $request, $id)
    {

        $informasi = Informasi::findOrFail($id);
        $masa_daftar = explode(" - ", $request->masa_daftar);
        $mulai_daftar = resetTanggal($masa_daftar[0]);
        $akhir_daftar = resetTanggal($masa_daftar[1]);

        DB::beginTransaction();
        try {
            $gelombang = Gelombang::where('nomor', $request->nomor)
                ->where('tahun_akademik', $request->tahun_akademik)
                ->first();
            if ($gelombang == null) {
                $gelombangBaru = [];

                for ($i = 1; $i <= 3; $i++) {

                    $gelombangBaru[] = Gelombang::create([
                        'nomor' => $i,
                        'tahun_akademik' => $request->tahun_akademik,
                    ]);
                    // dd($gelombangBaru, $request->tahun_akademik);
                }

                // Ambil gelombang yang sesuai dengan nomor yang diminta dalam request
                $gelombang = collect($gelombangBaru)->firstWhere('nomor', $request->nomor);
            }

            // dd($gelombang->id);

            $informasi->gelombang_id = $gelombang->id;
            $informasi->mulai_daftar = $mulai_daftar;
            $informasi->akhir_daftar = $akhir_daftar;

            $informasi->save();
            DB::commit();

            toast_notif('success', 'Status pendaftaran diubah');
            return back();
        } catch (\Throwable $th) {
            throw $th;
            swal_notif('error', 'Gagal', 'Terjadi kesalahan!');
            return back();
        }
    }

    public function agenda(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $informasi->launching = $request->launching;
        $informasi->mulai_kbm = $request->mulai_kbm;
        $informasi->mabit = $request->mabit;
        $informasi->jalasah = $request->jalasah;
        $informasi->talkshow = $request->talkshow;
        $informasi->save();

        swal_notif('success', 'Berhasil', 'Informasi telah update!');
        return back();
    }

    public function biaya(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $informasi->wa_konfirmasi = $request->wa_konfirmasi;
        $informasi->biaya = $request->biaya;
        $informasi->save();

        swal_notif('success', 'Berhasil', 'Informasi telah update!');
        return back();
    }

    public function pamflet(Request $request, $id)
    {
        $request->validate([
            'pamflet' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        // Ambil data informasi berdasarkan ID
        $informasi = Informasi::findOrFail($id);

        DB::beginTransaction();
        try {
            // Hapus pamflet lama jika ada
            if ($informasi->pamflet) {
                Storage::delete('public/pamflet/' . $informasi->pamflet);
            }

            // Simpan pamflet baru
            if ($request->hasFile('pamflet')) {
                $file = $request->file('pamflet');
                $fileName = time() . '_' . $file->getClientOriginalName(); // Generate nama unik
                $file->storeAs('public/pamflet', $fileName); // Simpan ke storage

                // Update database
                $informasi->pamflet = $fileName;
                $informasi->save();
            }

            DB::commit();

            swal_notif('success', 'Berhasil', 'Informasi telah update!');
            return back();
        } catch (\Throwable $th) {
            // throw $th;

            swal_notif('error', 'Gagal', 'Terjadi kesalahan!');
            return back();
        }
    }

    public function narahubung(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $informasi->nama_cp1 = $request->nama_cp1;
        $informasi->nama_cp2 = $request->nama_cp2;
        $informasi->cp1 = $request->cp1;
        $informasi->cp2 = $request->cp2;
        $informasi->save();

        swal_notif('success', 'Berhasil', 'Informasi telah update!');
        return back();
    }
}
