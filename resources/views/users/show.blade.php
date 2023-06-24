@extends('template.layout')

@section('titulo', 'Utilizador')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utilizadores</a></li>
        <li class="breadcrumb-item"><strong>{{ $user->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $user, 'readonlyData' => false])
                @include('users.shared.fields_admin', ['user' => $user, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                @if (Auth::user()->user_type === 'A')    
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal">
                        Apagar Cliente
                    </button>
                @endif
                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-secondary ms-3">
                        Editar Perfil
                    </a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_photo', [
                    'user' => $user,
                    'allowUpload' => false,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </div>
    
@endsection