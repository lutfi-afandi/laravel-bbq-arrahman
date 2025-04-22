<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard peserta';
        $mahasiswa = Mahasiswa::with('kelompok')->where('npm', Auth::user()->username)->first();

        $jadwalId = $mahasiswa->kelompok?->jadwal->id;
        $jadwal = Jadwal::with('tutor', 'gelombang', 'waktu', 'kelompok.mahasiswa')
            ->where('id', $jadwalId)->first();

        $mahasiswas = Mahasiswa::whereHas('kelompok', function ($query) use ($jadwalId) {
            $query->where('jadwal_id', $jadwalId);
        })->get();

        // dd($jadwal, $mahasiswas[0]->kelompok);

        return view('peserta.dashboard.index', compact(
            'title',
            'mahasiswa',
            'jadwal',
            'mahasiswas',
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
