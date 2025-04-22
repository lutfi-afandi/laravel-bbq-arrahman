<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        if (Auth::user()->role == 'admin') {
            return $this->isAdmin();
        } else if (Auth::user()->role == 'tutor') {
            return redirect()->route('tutor.dashboard.index');
        } else {

            return redirect()->route('peserta.dashboard.index');
        }
    }

    public function isPeserta()
    {
        $title = 'Dashboard peserta';
        $mahasiswa = Mahasiswa::where('npm', Auth::user()->username)->first();


        return view('template.main', compact(
            // return view('peserta.index', compact(
            'title',
            'mahasiswa'
        ));
    }

    public function isAdmin()
    {
        $title = 'Dashboard Admin';
        $user = User::where('id', Auth::user()->id)->first();


        return view('admin.dashboard', compact(
            // return view('peserta.index', compact(
            'title',
            'user'
        ));
    }

    public function welcome()
    {
        $title = 'Beranda BBQ Teknokrat - ' . date('y');
        $informasi = Informasi::with('gelombang')->first();
        $kegiatans = Kegiatan::all();

        return view('welcome', compact(
            'informasi',
            'title',
            'kegiatans',
        ));
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


    public function perbarui_password()
    {
        $title = "Perbarui Password";
        return view('auth.perbarui-password', compact('title'));
    }

    public function updatepw(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Password Lama Salah.");
        }

        if (strcmp($request->get('current-password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "Masukan Password Baru.");
        }
        if (!(strcmp($request->get('new_password'), $request->get('new_password_confirm'))) == 0) {
            //New password and confirm password are not same
            return redirect()->back()->with("error", "Ulangi Password Baru.");
        }

        $user = User::findorfail(Auth::user()->id);
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
