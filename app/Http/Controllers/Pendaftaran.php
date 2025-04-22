<?php

namespace App\Http\Controllers;

use App\Models\Dosens;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Jurusans;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Pendaftaran extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = Informasi::with('gelombang')->first();
        $dosens = Dosens::all();
        $jurusans = Jurusans::all();
        $kelass = Kelas::all();


        // dd($informasi->gelombang->nomor, $informasi->gelombang->tahun_akademik);

        return view('pendaftaran.index', compact(
            'informasi',
            'dosens',
            'kelass',
            'jurusans',

        ));
    }

    public function lihat()
    {
        $informasi =  Informasi::first();
        $gelombang_id = $informasi->gelombang->id;

        $mahasiswas = Mahasiswa::with('gelombang', 'kelas', 'jurusan', 'kelompok.jadwal.waktu', 'kelompok.jadwal.tutor')->where('gelombang_id', $gelombang_id)->get();
        // dd($mahasiswas[5]->id, $mahasiswas[5]->jurusan->nama, $mahasiswas[5]->kelompok->jadwal->tutor->name);
        $title = 'Mahasiswa Mendaftar BBQ';
        return view('pendaftaran.terdaftar', compact(
            'title',
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
        $gelombang = Gelombang::where('id', $request->gelombang_id)->first();
        $rules = [
            'npm'               => 'required|string|unique:mahasiswas,npm',
            'nama'              => 'required|string',
            'nomor_wa'          => 'required|string',
            'jk'                => 'required|in:laki-laki,perempuan',

            'jurusan_id'        => 'required|exists:jurusans,id',
            'kelas_id'          => 'required|exists:kelas,id',
            'dosen_id'          => 'required|exists:dosens,id',
            'gelombang_id'      => 'required|exists:gelombangs,id',

            'kelancaran_mengaji' => 'required',
            'jadwal_kuliah'     => 'required|file|mimes:jpg,jpeg,png,gif|max:1024', // Maks 1MB
            'keterangan'        => 'nullable',

            'pilgan'            => 'nullable',
            'makhroj'           => 'nullable',
            'tajwid'            => 'nullable',
        ];

        $messages = [
            'npm.required'          => 'NPM wajib diisi.',
            'npm.unique'            => 'NPM sudah terdaftar.',
            'nama.required'         => 'Nama wajib diisi.',
            'jurusan_id.required'   => 'Jurusan wajib dipilih.',
            'kelas_id.required'     => 'Kelas wajib dipilih.',
            'dosen_id.required'     => 'Dosen wajib dipilih.',
            'gelombang_id.required' => 'Gelombang wajib diisi.',
            'jadwal_kuliah.mimes'   => 'Format gambar tidak valid (jpg, jpeg, png, gif).',
            'jadwal_kuliah.max'     => 'Ukuran gambar maksimal 1MB.',
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
            $mahasiswa = new Mahasiswa();
            $mahasiswa->npm = $validatedData['npm'];
            $mahasiswa->nama = $validatedData['nama'];
            $mahasiswa->nomor_wa = $validatedData['nomor_wa'];
            $mahasiswa->jk = $validatedData['jk'];
            $mahasiswa->jurusan_id = $validatedData['jurusan_id'];
            $mahasiswa->kelas_id = $validatedData['kelas_id'];
            $mahasiswa->dosen_id = $validatedData['dosen_id'];
            $mahasiswa->gelombang_id = $validatedData['gelombang_id'];
            $mahasiswa->kelancaran_mengaji = $validatedData['kelancaran_mengaji'];
            $mahasiswa->password = Hash::make($mahasiswa->npm);
            $mahasiswa->keterangan = 'belum';

            // Upload file jika ada
            if ($request->hasFile('jadwal_kuliah')) {
                $file = $request->file('jadwal_kuliah');

                $tahunAjar = str_replace('/', '_', $gelombang->tahun_akademik);
                $filename = "gel" . $gelombang->nomor . "_ta_" . $tahunAjar . "-" . date('His') . "." . $file->getClientOriginalExtension();
                $path = $file->storeAs('jadwal_kuliah', $filename, 'public');
                $mahasiswa->jadwal_kuliah = $path;
            }

            $mahasiswa->save();
            // Simpan data User jika Mahasiswa berhasil disimpan
            User::create([
                'name' => $mahasiswa->nama,
                'username' => $mahasiswa->npm,
                'role' => 'mahasiswa',
                'jenis_kelamin' => $mahasiswa->jk,
                'no_wa' => $mahasiswa->nomor_wa,
                'password' => Hash::make($mahasiswa->npm),
                'email' => strtolower(str_replace(' ', '', $mahasiswa->nama)) . '@dummy.com',
                'email_verified_at' => now(),
                'remember_token' => null,
            ]);

            DB::commit();
            swal_notif('success', 'Berhasil!', 'Data berhasil disimpan.');
            return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            swal_notif('error', 'Gagal!', 'Data Gagal disimpan.');
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.' . $th])->withInput();
        }
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
