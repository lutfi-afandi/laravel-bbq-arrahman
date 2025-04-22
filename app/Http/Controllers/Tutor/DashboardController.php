<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Jadwal;
use App\Models\Tutor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Peserta';

        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::with('gelombang')->first();

        $gelombang_id = $informasi->gelombang_id;
        $gelombang_selected = Gelombang::where('id', $gelombang_id)->first();

        $tutor = Tutor::where('username', auth()->user()->username)->first();

        $kelompoks = Jadwal::with('tutor', 'gelombang', 'waktu', 'kelompok.mahasiswa')
            ->where('gelombang_id', $informasi->gelombang_id)
            ->where('tutor_id', $tutor->id)
            ->get();

        if ($request->all()) {
            $gelombang_selected = Gelombang::where('nomor', $request->nomor)->where('tahun_akademik', $request->ta)->first();
            // dd($gelombang_selected);
            $kelompoks = Jadwal::with('tutor', 'gelombang', 'waktu', 'kelompok.mahasiswa')
                ->where('gelombang_id', $gelombang_selected->id)
                ->where('tutor_id', $tutor->id)
                ->get();
        }
        // dd($gelombang_selected->id, $kelompoks->isEmpty());

        return view('tutor.dashboard', compact(
            'title',
            'informasi',
            'tutor',
            'kelompoks',
            'gelombang_selected',
            'tahuns',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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
        //
    }
}
