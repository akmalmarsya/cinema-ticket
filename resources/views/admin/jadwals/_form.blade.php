<div class="form-grid">

    <div class="form-group full">

        <label for="film_id">Pilih Film</label>

        <select name="film_id" id="film_id" class="form-control" required>

            <option value="">-- Pilih Film --</option>

            @foreach($films as $film)

                <option
                    value="{{ $film->id }}"
                    data-duration="{{ $film->durasi_menit }}"
                    @selected((string) old('film_id', $jadwal->film_id ?? '') === (string) $film->id)
                >
                    {{ $film->judul }}
                    ({{ $film->durasi_menit }} menit)
                </option>

            @endforeach

        </select>

        @error('film_id')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>


    <div class="form-group">

        <label for="studio_id">Pilih Studio</label>

        <select name="studio_id" id="studio_id" class="form-control" required>

            <option value="">-- Pilih Studio --</option>

            @foreach($studios as $studio)

                <option
                    value="{{ $studio->id }}"
                    @selected((string) old('studio_id', $jadwal->studio_id ?? '') === (string) $studio->id)
                >
                    {{ $studio->nama }}
                    ({{ $studio->tipe }} - {{ $studio->kapasitas }} kursi)
                </option>

            @endforeach

        </select>

        @error('studio_id')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>


    <div class="form-group">

        <label for="tanggal_tayang">Tanggal Tayang</label>

        <input
            type="date"
            name="tanggal_tayang"
            id="tanggal_tayang"
            class="form-control"
            value="{{ old('tanggal_tayang', isset($jadwal) ? $jadwal->tanggal_tayang : now()->toDateString()) }}"
            required
        >

        @error('tanggal_tayang')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>


    <div class="form-group">

        <label for="jam_mulai">Jam Mulai</label>

        <input
            type="time"
            name="jam_mulai"
            id="jam_mulai"
            class="form-control"
            value="{{ old('jam_mulai', isset($jadwal) ? substr($jadwal->jam_mulai, 0, 5) : '') }}"
            required
        >

        @error('jam_mulai')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>


    <div class="form-group">

        <label for="jam_selesai_preview">Jam Selesai (Otomatis)</label>

        <input
            type="text"
            id="jam_selesai_preview"
            class="form-control"
            value="{{ isset($jadwal) ? date('H:i', strtotime($jadwal->jam_selesai)) : '' }}"
            readonly
        >

        <p class="form-hint" id="durasi_info">
            Pilih film dan jam mulai untuk menghitung jam selesai.
        </p>

    </div>


    <div class="form-group">

        <label for="harga">Harga Tiket (Rp)</label>

        <input
            type="number"
            name="harga"
            id="harga"
            class="form-control"
            min="0"
            max="99999999.99"
            step="1000"
            value="{{ old('harga', $jadwal->harga ?? '') }}"
            placeholder="Contoh: 45000"
            required
        >

        @error('harga')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>


    <div class="form-group full">

        <label for="status">Status Jadwal</label>

        <select name="status" id="status" class="form-control" required>

            <option
                value="aktif"
                @selected(old('status', $jadwal->status ?? 'aktif') === 'aktif')
            >
                Aktif
            </option>

            <option
                value="dibatalkan"
                @selected(old('status', $jadwal->status ?? '') === 'dibatalkan')
            >
                Dibatalkan
            </option>

        </select>

        @error('status')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>

</div>


<div class="summary-note" style="margin-top:15px">

    <strong>Informasi:</strong>

    <p style="margin-top:5px">
        Sistem menghitung jam selesai berdasarkan durasi film.
        Jadwal yang bertabrakan pada studio dan waktu yang sama
        akan ditolak secara otomatis.
    </p>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const film = document.getElementById('film_id');
    const mulai = document.getElementById('jam_mulai');
    const selesai = document.getElementById('jam_selesai_preview');
    const info = document.getElementById('durasi_info');

    function hitungJamSelesai() {

        const selected = film.options[film.selectedIndex];

        const durasi = parseInt(
            selected?.dataset.duration || 0
        );

        if (!durasi || !mulai.value) {
            selesai.value = '';
            info.textContent =
                'Pilih film dan jam mulai untuk menghitung jam selesai.';
            return;
        }

        const [jam, menit] = mulai.value.split(':').map(Number);

        const totalMenit = (jam * 60) + menit + durasi;

        const hariBerikutnya = Math.floor(totalMenit / 1440);

        const waktuSelesai = totalMenit % 1440;

        const jamSelesai = String(
            Math.floor(waktuSelesai / 60)
        ).padStart(2, '0');

        const menitSelesai = String(
            waktuSelesai % 60
        ).padStart(2, '0');

        selesai.value = jamSelesai + ':' + menitSelesai;

        if (hariBerikutnya > 0) {
            selesai.value += ' (+1 hari)';
        }

        info.textContent =
            'Durasi film: ' + durasi + ' menit.';
    }

    film.addEventListener('change', hitungJamSelesai);
    mulai.addEventListener('input', hitungJamSelesai);

    hitungJamSelesai();

});
</script>