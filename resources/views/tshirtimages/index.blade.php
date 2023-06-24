@extends('template.layout')

@section('titulo', 'TshirtImage')

@section('subtitulo')
@foreach ($tshirtImages as $tshirtImage)

<td>{{ $tshirtImage->name }}</td>

        @endforeach
@endsection