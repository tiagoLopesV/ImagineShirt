<img src="{{ $tshirtImage->tshirtPhotoUrl }}" alt="Avatar" class="rounded img-thumbnail">
@if ($allowUpload)
    <div class="mb-3 pt-3">
        <input type="file" class="form-control @error('photo_file') is-invalid @enderror" name="photo_file"
            id="inputFileFoto">
        @error('file_foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif
@if (($allowDelete ?? false) && $tshirtImage->image_url)
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">
        Apagar Foto
    </button>
@endif