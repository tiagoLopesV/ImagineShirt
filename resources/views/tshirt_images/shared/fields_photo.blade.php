<img src="{{ $tshirt_image->tshirtPhotoUrl }}" alt="Avatar" class="rounded img-thumbnail">
@if ($allowUpload)
    <div class="mb-3 pt-3">
        <input type="file" class="form-control @error('photo_file') is-invalid @enderror" name="photo_file"
            id="inputFilePhoto">
        @error('photo_file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif
@if (($allowDelete ?? false) && $tshirt_image->image_url)
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">
        Apagar Foto
    </button>
@endif