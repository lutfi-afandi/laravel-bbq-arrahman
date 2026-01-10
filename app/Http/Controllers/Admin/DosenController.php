<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosens as Dosen;

class DosenController extends Controller
{
    public function index()
    {
        return view('admin.dosen.index', [
            'title' => 'Data Dosen'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|unique:dosens',
            'nama' => 'required'
        ]);

        $dosen = Dosen::create($data);

        return response()->json($dosen);
    }

    public function edit(Dosen $dosen)
    {
        return response()->json($dosen);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $data = $request->validate([
            'kode' => 'required|unique:dosens,kode,' . $dosen->id,
            'nama' => 'required'
        ]);

        $dosen->update($data);

        return response()->json();
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return response()->json();
    }

    public function show()
    {
        return response()->json(Dosen::latest()->get());
    }
}
