<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function show(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kelompoks = Kelompok::where('jadwal_id', $id)->get();
        $title = 'Kelompok Tutor';

        return view('tutor.index', compact(
            'kelompoks',
            'title',
            'jadwal',
        ));
    }

    public function index() {}

    public function create() {}

    public function store(Request $request) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
