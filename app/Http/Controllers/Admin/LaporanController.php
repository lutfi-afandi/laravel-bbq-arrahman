<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Jadwal Tutor';
        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::first();
        $gelombang_selected = Gelombang::where('id', $informasi->gelombang_id)->first();

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
        // dd($laporans[0]->jadwal);
        return view('admin.laporan.index', compact(
            'title',
            'informasi',
            // 'tutor',
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
