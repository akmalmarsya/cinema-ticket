<div class="form-grid">

    <div class="form-group full">
        <label for="judul">Judul Film</label>

        <input
            type="text"
            name="judul"
            id="judul"
            class="form-control"
            value="{{ old('judul', $film->judul ?? '') }}"
            placeholder="Masukkan judul film"
            required
        >

        @error('judul')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="genre">Genre</label>

        <input
            type="text"
            name="genre"
            id="genre"
            class="form-control"
            value="{{ old('genre', $film->genre ?? '') }}"
            placeholder="Contoh: Action, Horror, Romance"
            required
        >

        @error('genre')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="durasi_menit">Durasi (Menit)</label>

        <input
            type="number"
            name="durasi_menit"
            id="durasi_menit"
            class="form-control"
            min="1"
            max="65535"
            value="{{ old('durasi_menit', $film->durasi_menit ?? '') }}"
            required
        >

        @error('durasi_menit')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="rating_usia">Rating Usia</label>

        <select name="rating_usia" id="rating_usia" class="form-control" required>
            @foreach(['SU', '13+', '17+', '21+'] as $rating)
                <option
                    value="{{ $rating }}"
                    @selected(old('rating_usia', $film->rating_usia ?? 'SU') === $rating)
                >
                    {{ $rating }}
                </option>
            @endforeach
        </select>

        @error('rating_usia')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status Film</label>

        <select name="status" id="status" class="form-control" required>
            <option
                value="tayang"
                @selected(old('status', $film->status ?? 'tayang') === 'tayang')
            >
                Tayang
            </option>

            <option
                value="tidak_tayang"
                @selected(old('status', $film->status ?? '') === 'tidak_tayang')
            >
                Tidak Tayang
            </option>
        </select>

        @error('status')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group full">
        <label for="sinopsis">Sinopsis</label>

        <textarea
            name="sinopsis"
            id="sinopsis"
            class="form-control"
            rows="5"
            placeholder="Tuliskan sinopsis film..."
        >{{ old('sinopsis', $film->sinopsis ?? '') }}</textarea>

        @error('sinopsis')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group full">

        <label for="poster">Poster Film</label>

        @if(isset($film) && $film->poster)
            <div>
                <img
                    src="{{ asset('storage/'.$film->poster) }}"
                    class="poster-preview"
                    alt="Poster {{ $film->judul }}"
                >
            </div>
        @endif

        <input
            type="file"
            name="poster"
            id="poster"
            class="form-control"
            accept=".jpg,.jpeg,.png,.webp"
        >

        <p class="form-hint">
            Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
            Kosongkan jika tidak ingin mengganti poster.
        </p>

        @error('poster')
            <div class="field-error">{{ $message }}</div>
        @enderror

    </div>

</div>
