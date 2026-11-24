<div class="form-grid">

    <div class="form-group full">

        <label for="nama">Nama Studio</label>

        <input
            type="text"
            name="nama"
            id="nama"
            class="form-control"
            value="{{ old('nama', $studio->nama ?? '') }}"
            placeholder="Contoh: Studio 1"
            required
        >

        @error('nama')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-group">

        <label for="tipe">Tipe Studio</label>

        <input
            type="text"
            name="tipe"
            id="tipe"
            class="form-control"
            value="{{ old('tipe', $studio->tipe ?? 'Reguler') }}"
            placeholder="Reguler / VIP / Premiere"
            required
        >

        @error('tipe')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-group">

        <label for="status">Status Studio</label>

        <select name="status" id="status" class="form-control" required>

            <option
                value="aktif"
                @selected(old('status', $studio->status ?? 'aktif') === 'aktif')
            >
                Aktif
            </option>

            <option
                value="nonaktif"
                @selected(old('status', $studio->status ?? '') === 'nonaktif')
            >
                Nonaktif
            </option>

        </select>

        @error('status')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-group">

        <label for="jumlah_baris">Jumlah Baris Kursi</label>

        <input
            type="number"
            name="jumlah_baris"
            id="jumlah_baris"
            class="form-control"
            min="1"
            max="255"
            value="{{ old('jumlah_baris', $studio->jumlah_baris ?? 5) }}"
            required
        >

        @error('jumlah_baris')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-group">

        <label for="kursi_per_baris">Kursi Per Baris</label>

        <input
            type="number"
            name="kursi_per_baris"
            id="kursi_per_baris"
            class="form-control"
            min="1"
            max="255"
            value="{{ old('kursi_per_baris', $studio->kursi_per_baris ?? 8) }}"
            required
        >

        @error('kursi_per_baris')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-group full">

        <label>Kapasitas Studio</label>

        <input
            type="text"
            id="kapasitas_preview"
            class="form-control"
            value="{{ old('jumlah_baris', $studio->jumlah_baris ?? 5) * old('kursi_per_baris', $studio->kursi_per_baris ?? 8) }} kursi"
            readonly
        >

        <p class="form-hint">
            Kapasitas dihitung otomatis berdasarkan jumlah baris
            dikalikan kursi per baris.
        </p>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const baris = document.getElementById('jumlah_baris');
    const kursi = document.getElementById('kursi_per_baris');
    const kapasitas = document.getElementById('kapasitas_preview');

    function hitungKapasitas() {

        const jumlahBaris = parseInt(baris.value) || 0;
        const kursiPerBaris = parseInt(kursi.value) || 0;

        kapasitas.value =
            (jumlahBaris * kursiPerBaris) + ' kursi';
    }

    baris.addEventListener('input', hitungKapasitas);
    kursi.addEventListener('input', hitungKapasitas);

    hitungKapasitas();

});
</script>