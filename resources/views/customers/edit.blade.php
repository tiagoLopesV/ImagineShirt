@extends('template.layout')

@section('titulo', 'Alterar Cliente')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><strong>{{ $customer->user->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    @if ($errors->any())
    
    @endif
    <form id="form_customer" novalidate class="needs-validation" method="POST"
        action="{{ route('customers.update', ['customer' => $customer]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $customer->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $customer->user, 'readonlyData' => false])
                @if (Auth::user()->user_type === 'C') 
                @include('customers.shared.fields', ['customer' => $customer, 'readonlyData' => true])
                @else
                @include('users.shared.fields_admin', ['user' => $customer->user, 'readonlyData' => true])
                @endif
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_customer">Guardar
                        Alterações</button>
                    <a href="{{ route('customers.show', ['customer' => $customer]) }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_photo', [
                    'user' => $customer->user,
                    'allowUpload' => true,
                    'allowDelete' => true,
                ])
            </div>
        </div>
    </form>
    @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar a foto?',
        'msgLine1' => 'As alterações efetuadas ao dados do perfil vão ser perdidas!',
        'msgLine2' => 'Clique no botão "Apagar" para confirmar a operação.',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'users.photo.destroy',
        'formActionRouteParameters' => ['user' => $customer->user],
        'formMethod' => 'DELETE',
    ])
@endsection
