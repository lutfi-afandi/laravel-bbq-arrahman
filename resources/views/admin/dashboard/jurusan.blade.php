<div class="card shadow">
    <div class="card-body">
        <center class="font-bold">Peserta Gelombang {{ $gelombang_selected->nomor }} -
            {{ $gelombang_selected->tahun_akademik }} Per Prodi</center>

        @if (array_sum($jumlah) == 0)
            <button class="btn btn-block btn-outline-warning p-3">Data tidak ditemukan!</button>
        @else
            {{-- Hidden input buat JavaScript ambil data --}}
            <input type="hidden" id="labelsJurusanData" value='@json($labels)'>
            <input type="hidden" id="jumlahJurusanData" value='@json($jumlah)'>
            <canvas id="chartJurusan" width="1400px" height="400px"></canvas>
        @endif
    </div>
</div>
