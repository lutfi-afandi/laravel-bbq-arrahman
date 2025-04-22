<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Data User/Admin';
        $users = User::where('role', 'admin')->get();
        return view('admin.user.index', compact(
            'users',
            'title',
        ));
    }

    public function create()
    {
        $title = 'Tambah User/Admin';
        return view('admin.user.create', compact(
            'title',
        ));
    }

    public function store(Request $request)
    {
        // dd($request->no_wa);
        $rules = [
            'username' => 'required|unique:users',
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

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'role' => 'admin',
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_wa' => $request->no_wa,
                'password' => Hash::make($request->username),
                'email' => strtolower(str_replace(' ', '', $request->name)) . '@dummy.com',
                'email_verified_at' => now(),
                'remember_token' => null,
            ]);

            // dd($user);

            DB::commit();
            swal_notif('success', 'Berhasil!', 'Data berhasil disimpan.');

            return redirect()->route('admin.user.index')->with('success', 'Data user berhasil disimpan.');
        } catch (\Throwable $th) {
            // throw $th;
            swal_notif('error', 'Gagal!', 'Data gagal disimpan.' . $th);
            return back()->withInput();
        }
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $title = 'Edit User';

        return view('admin.user.edit', compact(
            'title',
            'user',
        ));
    }

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

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->no_wa = $request->no_wa;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->save();
            // dd($user);

            DB::commit();
            swal_notif('success', 'Berhasil!', 'Data berhasil diubah.');

            return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diubah.');
        } catch (\Throwable $th) {
            throw $th;
            swal_notif('error', 'Gagal!', 'Data gagal diubah.' . $th);
            return back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();

        if ($user->id == Auth::user()->id) {
            swal_notif('error', 'Gagal!', 'Tidak dapat menghapus user yang aktif');
            return back();
        } else {
            DB::beginTransaction();
            try {
                $user->delete();
                DB::commit();
                swal_notif('success', 'Berhasil!', 'Data dihapus');
                return back();
            } catch (\Throwable $th) {
                swal_notif('error', 'Gagal!', 'Terjadi kesalahan');
                return back();
            }
        }
    }

    public function reset(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // dd($user);
        DB::beginTransaction();
        try {
            $password = Hash::make($request->password);

            $user->update(['password' => $password]);

            DB::commit();

            swal_notif('success', 'Gagal', 'Password telah di-Reset!');
            return redirect()->back();
        } catch (\Throwable $th) {
            swal_notif('error', 'Gagal', 'terjadi kesalahan! ' . $th);
            // dd($th);
            return redirect()->back();
            //throw $th;
        }
    }
}
