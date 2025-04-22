<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Tutor';
        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();

        $tutors = Tutor::all();

        return view('admin.tutor.index', compact(
            'title',
            'tahuns',
            'tutors',
        ));
    }

    public function reset(Request $request, string $id)
    {
        $tutor = Tutor::findOrFail($id);
        $user = User::where('username', $tutor->username)->first();

        // dd($user);
        DB::beginTransaction();
        try {
            $password = Hash::make($request->password);

            $tutor->update(['password' => $password]);
            $user->update(['password' => $password]);

            DB::commit();

            toast_notif('success', 'Password telah di-Reset!');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast_notif('error', 'terjadi kesalahan! ' . $th);
            // dd($th);
            return redirect()->back();
            //throw $th;
        }
    }

    public function create()
    {
        return view('admin.tutor.create');
    }


    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|unique:tutors',
            'name'  => 'required',
            'no_wa'  => 'required',
            'jenis_kelamin'  => 'required',
        ];

        $messages = [
            'username.unique'   => 'username sudah terdaftar',
            'username.required' => 'username harus diisi',
            'name.required' => 'nama harus diisi',
            'no_wa.required' => 'nomor wa harus diisi',
            'jenis_kelamin.required' => 'jenis kelamin harus dipilih',
        ];

        DB::beginTransaction();
        try {
            // $validatedData = $request->validate($rules, $messages);
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput(); // Agar input sebelumnya tidak hilang
            }

            // Ambil hasil validasi sebagai array
            $validatedData = $validator->validated();

            // Simpan data Mahasiswa
            $tutor = new Tutor();
            $tutor->username = $request->username;
            $tutor->name = $request->name;
            $tutor->no_wa = $request->no_wa;
            $tutor->jenis_kelamin = $request->jenis_kelamin;
            $tutor->password = Hash::make($request->username);
            $tutor->save();

            User::create([
                'name' => $tutor->name,
                'username' => $tutor->username,
                'role' => 'tutor',
                'jenis_kelamin' => $tutor->jenis_kelamin,
                'no_wa' => $tutor->no_wa,
                'password' => Hash::make($tutor->username),
                'email' => strtolower(str_replace(' ', '', $tutor->name)) . '@dummy.com',
                'email_verified_at' => now(),
                'remember_token' => null,
            ]);

            DB::commit();
            swal_notif('success', 'Berhasil!', 'Data berhasil disimpan.');

            return redirect()->route('admin.tutor.index')->with('success', 'Data pendaftaran berhasil disimpan.');
        } catch (\Throwable $th) {
            // throw $th;
            swal_notif('error', 'Gagal!', 'Data gagal disimpan.' . $th);
            return back()->withInput();
        }
    }


    public function show(string $id) {}


    public function edit(string $id)
    {
        $title = 'Edit data tutor';
        $tutor = Tutor::findOrFail($id);

        return view('admin.tutor.edit', compact(
            'tutor',
            'title'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name'  => 'required',
            'no_wa'  => 'required',
            'jenis_kelamin'  => 'required',
        ];

        $messages = [
            'name.required' => 'nama harus diisi',
            'no_wa.required' => 'nomor wa harus diisi',
            'jenis_kelamin.required' => 'jenis kelamin harus dipilih',
        ];

        DB::beginTransaction();
        try {
            // $validatedData = $request->validate($rules, $messages);
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput(); // Agar input sebelumnya tidak hilang
            }

            // Ambil hasil validasi sebagai array
            $validatedData = $validator->validated();

            // Simpan data Mahasiswa
            $tutor = Tutor::findOrFail($id);
            $tutor->name = $request->name;
            $tutor->no_wa = $request->no_wa;
            $tutor->jenis_kelamin = $request->jenis_kelamin;
            $tutor->save();


            $user = User::where('username', $tutor->username)->first();
            $user->update([
                'name' => $tutor->name,
                'jenis_kelamin' => $tutor->jenis_kelamin,
                'no_wa' => $tutor->no_wa,
            ]);

            DB::commit();
            swal_notif('success', 'Berhasil!', 'Data berhasil diubah.');

            return redirect()->route('admin.tutor.index')->with('success', 'Data pendaftaran berhasil diubah.');
        } catch (\Throwable $th) {
            // throw $th;
            swal_notif('error', 'Gagal!', 'Data gagal diubah.' . $th);
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        $user = User::where('username', $tutor->username)->first();

        if ($user->id == Auth::user()->id) {
            swal_notif('error', 'Gagal!', 'Tidak dapat menghapus user yang aktif');
            return back();
        } else {
            DB::beginTransaction();
            try {
                $tutor->delete();
                $user->delete();

                DB::commit();
                toast_notif('success', 'User dihapus!');
                return back();
            } catch (\Throwable $th) {
                swal_notif('error', 'Gagal!', 'Terjadi kesalahan');
                return back();
            }
        }
    }
}
