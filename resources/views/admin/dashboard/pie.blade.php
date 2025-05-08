<div class="card shadow">
    <div class="card-body">
        <center class="font-bold">Peserta Gelombang {{ $gelombang_selected->nomor }} -
            {{ $gelombang_selected->tahun_akademik }}</center>

        @if ($data->isEmpty())
            <button class="btn btn-block btn-outline-warning p-3">Data tidak ditemukan!</button>
        @else
            {{-- Hidden input buat JavaScript ambil data --}}
            <input type="hidden" id="labelsData" value='@json($labels)'>
            <input type="hidden" id="jumlahData" value='@json($jumlah)'>
            <canvas id="chartjk" width="100%" height="100%"></canvas>
        @endif
    </div>
</div>
