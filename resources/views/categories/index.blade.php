@extends('template.layout')

@section('titulo', 'Categorias')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Categorias</li>
    </ol>
@endsection

@section('main')
<p><a class="btn btn-success" href="{{ route('categories.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova
            categoria</a></p>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                    href="{{ route('catalog', ['id' => $category->id]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                    href="{{ route('categories.edit', ['category' => $category]) }}">
                            <i class="fas fa-edit"></i></a></td>
            @endforeach
        </tbody>
    </table>
    
    <div>
        {{ $categories->withQueryString()->links() }}
    </div>
    
@endsection

