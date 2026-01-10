<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Jurusans as Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        return view('admin.jurusan.index', [
            'title' => 'Data Jurusan'
        ]);
    }

    public function show()
    {
        return response()->json(['data' => Jurusan::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:jurusans,kode',
            'nama' => 'required'
        ]);

        Jurusan::create($request->all());
    }

    public function edit($id)
    {
        return Jurusan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:jurusans,kode,' . $id,
            'nama' => 'required'
        ]);

        Jurusan::find($id)->update($request->all());
    }

    public function destroy($id)
    {
        Jurusan::destroy($id);
    }
}
