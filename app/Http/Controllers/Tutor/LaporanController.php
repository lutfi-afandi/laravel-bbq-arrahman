<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Laporan;
use App\Models\Tutor;
use Illuminate\Http\Request;

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
            ->orderBy('id', 'DESC')
            ->get();

        if ($request->all()) {
            $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();
            $laporans = Laporan::with('gelombang', 'jadwal')
                ->where('gelombang_id', $gelombang_selected->id)
                ->orderBy('id', 'DESC')
                ->get();
        }

        return view('tutor.laporan.index', compact(
            'title',
            'informasi',
            'tutor',
            'laporans',
            'gelombang_selected',
            'tahuns',
        ));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
