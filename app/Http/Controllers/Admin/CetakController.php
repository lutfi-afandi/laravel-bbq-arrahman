<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Informasi;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class CetakController extends Controller
{
    public function style_col()
    {
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        return $style_col;
    }

    public function style_row()
    {
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        return $style_row;
    }

    public function cell_bg()
    {
        return [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9EDF7'] // Biru muda
            ],
        ];
    }

    public function index()
    {
        $title = 'Cetak Report';

        $tahuns = Gelombang::select('tahun_akademik')->distinct()->get();
        $informasi = Informasi::first();
        $gelombang_selected = Gelombang::where('id', $informasi->gelombang_id)->first();

        return view('admin.cetak.index', compact(
            'title',
            'informasi',
            'tahuns',
            'gelombang_selected',
        ));
    }

    public function exportMahasiswa(Request $request)
    {
        $gelombang = Gelombang::where('nomor', $request->nomor)
            ->where('tahun_akademik', $request->ta)->first();
        $mahasiswas = Mahasiswa::with('gelombang', 'jurusan', 'kelas', 'dosen')
            ->where('gelombang_id', $gelombang->id)
            ->orderBy('dosen_id', 'asc')
            ->orderBy('jurusan_id', 'asc')
            ->orderBy('kelas_id', 'asc')
            ->orderBy('npm', 'asc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('C1', 'Data Mahasiswa');
        $sheet->setCellValue('C2', 'Gelombang: ' . ($gelombang->nomor ?? '-'));
        $sheet->setCellValue('C3', 'Tahun Akademik: ' . ($gelombang->tahun_akademik ?? '-'));
        $sheet->getStyle('C1:C3')->getFont()->setBold(true)->setItalic(false)->setSize(11);

        // header
        $sheet->fromArray([
            [
                'NO',
                'NPM',
                'NAMA LENGKAP',
                'JURUSAN',
                'KELAS',
                'JENIS KELAMIN',
                'NILAI AKHIR',
                'DOSEN',
                'KELANCARAN'
            ]
        ], NULL, 'A5');

        // dd($mahasiswas[0]->kelompok);
        $row = 6;
        $no = 1;
        foreach ($mahasiswas as $mhs) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $mhs->npm);
            $sheet->setCellValue('C' . $row, $mhs->nama);
            $sheet->setCellValue('D' . $row, $mhs->jurusan->nama);
            $sheet->setCellValue('E' . $row, $mhs->jurusan->kode . ' - ' . $mhs->kelas->nama);
            $sheet->setCellValue('F' . $row, ucwords($mhs->jk));
            $sheet->setCellValue('G' . $row, $mhs->kelompok->huruf_mutu ?? '-');
            $sheet->setCellValue('H' . $row, $mhs->dosen->nama);
            $sheet->setCellValue('I' . $row, $mhs->kelancaran_mengaji);

            foreach (range('A', 'I') as $col) {
                $sheet->getStyle($col . $row)->applyFromArray($this->style_row());
                $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal('center');
                $sheet->getStyle('G' . $row)->getFont()->setBold(true)->setItalic(false)->setSize(11);
            }
            $row++;
        }

        $sheet->getStyle('A5:A' . $row)->getAlignment()->setHorizontal('center');

        foreach (range('A', 'I') as $col) {
            $sheet->getStyle($col . '5')->applyFromArray($this->style_col());
            $sheet->getStyle($col . '5')->applyFromArray($this->cell_bg());
            $sheet->getStyle($col . '5')->getFont()->setBold(true)->setItalic(false)->setSize(11);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }


        $tahunAjar = str_replace('/', '-', $gelombang->tahun_akademik);
        // Simpan ke temporary file
        $writer = new WriterXlsx($spreadsheet);
        $fileName = 'Nilai_mahasiswa_Gel-' . $gelombang->nomor . '_' . $tahunAjar . 'time_' . now()->format('Ymd_His') . '.xlsx';
        $tempFile = storage_path('app/public/' . $fileName);
        $writer->save($tempFile);

        // Kirim sebagai response download
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }

    public function exportTutor(Request $request)
    {
        $gelombang = Gelombang::where('nomor', $request->nomor)
            ->where('tahun_akademik', $request->ta)->first();
        $jadwals = Jadwal::with('tutor')
            ->where('gelombang_id', $gelombang->id)
            ->get()
            ->unique('tutor_id')
            ->values();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('C1', 'Data Tutor');
        $sheet->setCellValue('C2', 'Gelombang: ' . ($gelombang->nomor ?? '-'));
        $sheet->setCellValue('C3', 'Tahun Akademik: ' . ($gelombang->tahun_akademik ?? '-'));
        $sheet->getStyle('C1:C3')->getFont()->setBold(true)->setItalic(false)->setSize(11);

        // header
        $sheet->fromArray([
            [
                'NO',
                'USERNAME',
                'NAMA LENGKAP',
                'PASSWORD',
                'JENIS KELAMIN',
                'NOMOR HP',
            ]
        ], NULL, 'A5');

        // dd($tutor[0]->kelompok);
        $row = 6;
        $no = 1;
        foreach ($jadwals as $jadwal) {
            $tutor = $jadwal->tutor;
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $tutor->username);
            $sheet->setCellValue('C' . $row, $tutor->name);
            $sheet->setCellValue('D' . $row, $tutor->username);
            $sheet->setCellValue('E' . $row, $tutor->jenis_kelamin);
            $sheet->setCellValue('F' . $row, $tutor->no_wa);

            foreach (range('A', 'F') as $col) {
                $sheet->getStyle($col . $row)->applyFromArray($this->style_row());
            }
            $row++;
        }

        $sheet->getStyle('A5:A' . $row)->getAlignment()->setHorizontal('center');

        foreach (range('A', 'F') as $col) {
            $sheet->getStyle($col . '5')->applyFromArray($this->style_col());
            $sheet->getStyle($col . '5')->applyFromArray($this->cell_bg());
            $sheet->getStyle($col . '5')->getFont()->setBold(true)->setItalic(false)->setSize(11);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }


        $tahunAjar = str_replace('/', '-', $gelombang->tahun_akademik);
        // Simpan ke temporary file
        $writer = new WriterXlsx($spreadsheet);
        $fileName = 'Data_tutor_Gel-' . $gelombang->nomor . '_' . $tahunAjar . 'time_' . now()->format('Ymd_His') . '.xlsx';
        $tempFile = storage_path('app/public/' . $fileName);
        $writer->save($tempFile);

        // Kirim sebagai response download
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }


    public function exportKelompok(Request $request)
    {
        $gelombang = Gelombang::where('nomor', $request->nomor)
            ->where('tahun_akademik', $request->ta)->first();
        $kelompoks = DB::table('mahasiswas')
            ->leftJoin('kelompoks', 'kelompoks.mahasiswa_id', '=', 'mahasiswas.id')
            ->leftJoin('jadwals', 'kelompoks.jadwal_id', '=', 'jadwals.id')
            ->leftJoin('waktus', 'jadwals.waktu_id', '=', 'waktus.id')
            ->leftJoin('tutors', 'jadwals.tutor_id', '=', 'tutors.id')
            ->leftJoin('jurusans', 'mahasiswas.jurusan_id', '=', 'jurusans.id')
            ->leftJoin('kelas', 'mahasiswas.kelas_id', '=', 'kelas.id')
            ->where('mahasiswas.gelombang_id', $gelombang->id)
            ->orderBy('tutors.name', 'asc')
            ->orderBy('waktus.id', 'asc')
            ->orderBy('mahasiswas.jurusan_id', 'asc')
            ->orderBy('mahasiswas.kelas_id', 'asc')
            ->select([
                'tutors.name as nama_tutor',
                'mahasiswas.npm',
                'mahasiswas.nama',
                'mahasiswas.nomor_wa',
                'mahasiswas.jurusan_id',
                'mahasiswas.kelas_id',
                'jurusans.nama as nama_jurusan',
                'jurusans.kode as kode_jurusan',
                'kelas.nama as nama_kelas',
                'mahasiswas.kelancaran_mengaji',
                'waktus.hari',
                'waktus.jam',
                'jadwals.id as id_jadwal',
            ])
            ->get();

        // dd($kelompoks[0]->nama_kelas);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('C1', 'Data Kelompok BBQ');
        $sheet->setCellValue('C2', 'Gelombang: ' . ($gelombang->nomor ?? '-'));
        $sheet->setCellValue('C3', 'Tahun Akademik: ' . ($gelombang->tahun_akademik ?? '-'));
        $sheet->getStyle('C1:C3')->getFont()->setBold(true)->setItalic(false)->setSize(11);

        // header
        $sheet->fromArray([
            [
                'TUTOR',
                'JADWAL',
                'MAHASISWA',
                'NPM',
                'NOMOR TELEPON',
                'JURUSAN',
                'KELAS',
                'KELANCARAN',
            ]
        ], NULL, 'A5');

        // dd($kelompoks[0]->jadwal?->waktu?->jam);
        $row = 6;
        $no = 1;
        $lastJadwalId = null;
        foreach ($kelompoks as $mahasiswa) {

            if ($lastJadwalId !== null && $mahasiswa->id_jadwal !== $lastJadwalId) {
                $row++; // baris kosong sebagai pemisah
            }

            $lastJadwalId = $mahasiswa->id_jadwal;

            $sheet->setCellValue('A' . $row, $mahasiswa->nama_tutor ?? '-');
            $sheet->setCellValue('B' . $row, $mahasiswa->hari . ' - ' . $mahasiswa->jam ?? '');
            $sheet->setCellValue('C' . $row, $mahasiswa->nama ?? '');
            $sheet->setCellValue('D' . $row, $mahasiswa->npm ?? '');
            $sheet->setCellValue('E' . $row, $mahasiswa->nomor_wa ?? '');
            $sheet->setCellValue('F' . $row, $mahasiswa->nama_jurusan ?? '');
            $sheet->setCellValue('G' . $row, $mahasiswa->kode_jurusan  . ' - ' . $mahasiswa->nama_kelas ?? '');
            $sheet->setCellValue('H' . $row, $mahasiswa->kelancaran_mengaji ?? '');

            foreach (range('A', 'H') as $col) {
                $sheet->getStyle($col . $row)->applyFromArray($this->style_row());
                // $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal('center');
                // $sheet->getStyle('G' . $row)->getFont()->setBold(true)->setItalic(false)->setSize(11);
            }
            $row++;
        }

        $sheet->getStyle('A5:A' . $row)->getAlignment()->setHorizontal('center');

        foreach (range('A', 'H') as $col) {
            $sheet->getStyle($col . '5')->applyFromArray($this->style_col());
            $sheet->getStyle($col . '5')->applyFromArray($this->cell_bg());
            $sheet->getStyle($col . '5')->getFont()->setBold(true)->setItalic(false)->setSize(11);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }


        $tahunAjar = str_replace('/', '-', $gelombang->tahun_akademik);
        // Simpan ke temporary file
        $writer = new WriterXlsx($spreadsheet);
        $fileName = 'Data_Kelompok_Gel-' . $gelombang->nomor . '_' . $tahunAjar . 'time_' . now()->format('Ymd_His') . '.xlsx';
        $tempFile = storage_path('app/public/' . $fileName);
        $writer->save($tempFile);

        // Kirim sebagai response download
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
