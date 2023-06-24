@extends('template.layout')

@section('titulo', 'Novo Utlizador')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection

@section('main')
    <form id="form_user" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $user, 'readonlyData' => false])
                @include('users.shared.fields_admin', ['user' => $user, 'readonlyData' => false])
                @include('users.shared.fields_password_inicial', ['user' => $user, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_user">Guardar novo
                        utilizador</button>
                    <a href="{{ route('users.create', ['user' => $user]) }}"
                        class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_photo', [
                    'user' => $user,
                    'allowUpload' => true,
                ])
            </div>
        </div>
    </form>
@endsection
