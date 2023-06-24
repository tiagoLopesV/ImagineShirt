@extends('template.layout')

@section('titulo', 'TshirtImage')

@section('subtitulo')
@foreach ($tshirt_images as $tshirt_image)

<td>{{ $tshirt_image->name }}</td>

        @endforeach
@endsection