@extends('template.layout')

@section('titulo', 'Perfil de cliente')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><strong>{{ $customer->user->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $customer->user, 'readonlyData' => true])
                @include('customers.shared.fields', ['aluno' => $customer, 'readonlyData' => true])
                <div class="my-1 d-flex justify-content-end">
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal">
                        Apagar Cliente
                    </button>
                    <a href="{{ route('customer.edit', ['customer' => $customer]) }}" class="btn btn-secondary ms-3">
                        Alterar Cliente
                    </a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $customer->user,
                    'allowUpload' => false,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </div>
    
@endsection