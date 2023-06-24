@extends('template.layout')

@section('titulo', 'Imagem')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('catalog') }}">Catalogo</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirt_image->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    @if ($errors->any())

    @endif
    <form id="form_image" novalidate class="needs-validation" method="POST"
        action="{{ route('tshirt_images.update', ['tshirt_image' => $tshirt_image]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $tshirt_image->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('tshirt_images.shared.fields', ['tshirt_image' => $tshirt_image, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_image">Guardar
                        Alterações</button>
                    <a href="{{ route('tshirt_images.show', ['tshirt_image' => $tshirt_image]) }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('tshirt_images/shared/fields_foto', [
                    'tshirt_image' => $tshirt_image,
                    'allowUpload' => true,
                    'allowDelete' => true,
                ])
            </div>
        </div>
    </form>
@endsection
