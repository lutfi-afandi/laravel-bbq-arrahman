<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';
        $user = User::where('id', Auth::user()->id)->first();
        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::first();
        $gelombang_selected = Gelombang::where('id', $informasi->gelombang_id)->first();

        return view('admin.dashboard', compact(
            'title',
            'tahuns',
            'gelombang_selected',
            'user'
        ));
    }

    public function grafikJk(Request $request)
    {
        $nomor = $request->nomor;
        $ta = $request->ta;

        $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();
        $data = DB::table('mahasiswas')
            ->select('jk', DB::raw('COUNT(*) as jumlah'))
            ->where('gelombang_id', $gelombang_selected->id)
            ->groupBy('jk')
            ->get();

        // Pisahkan label dan data
        $labels = [];
        $jumlah = [];

        foreach ($data as $item) {
            $labels[] = $item->jk;
            $jumlah[] = $item->jumlah;
        }

        $view = view('admin.dashboard.pie', compact(
            'gelombang_selected',
            'data',
            'labels',
            'jumlah',
        ))->render();

        // dd($labels, $jumlah);
        return response()->json([
            'success' => true,
            'view' => $view,
        ]);
    }
    public function grafikJurusan(Request $request)
    {
        $nomor = $request->nomor;
        $ta = $request->ta;

        $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();
        $data = DB::table('jurusans')
            ->leftJoin('mahasiswas', function ($join) use ($gelombang_selected) {
                $join->on('jurusans.id', '=', 'mahasiswas.jurusan_id')
                    ->where('mahasiswas.gelombang_id', '=', $gelombang_selected->id);
            })
            ->select('jurusans.nama', DB::raw('COUNT(mahasiswas.id) as jumlah'))
            ->groupBy('jurusans.id', 'jurusans.nama')
            ->get();


        // Pisahkan label dan data
        $labels = [];
        $jumlah = [];
        foreach ($data as $item) {
            $labels[] = $item->nama;
            $jumlah[] = $item->jumlah;
        }
        // dd($labels, $jumlah);

        $view = view('admin.dashboard.jurusan', compact(
            'gelombang_selected',
            'data',
            'labels',
            'jumlah',
        ))->render();

        // dd($labels, $jumlah);
        return response()->json([
            'success' => true,
            'view' => $view,
        ]);
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
