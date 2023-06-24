@extends('template.layout')

@section('titulo', 'Imagens')

@section('subtitulo')
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('catalog') }}">Catalogo</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirt_image->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>

@endsection

@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('tshirt_images.shared.fields', ['tshirt_image' => $tshirt_image, 'readonlyData' => false])
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('tshirt_images/shared/fields_foto', [
                    'tshirt_image' => $tshirt_image,
                    'allowUpload' => false,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </div>
    
@endsection