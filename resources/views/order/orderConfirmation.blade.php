@extends('template.layout')

@section('titulo', 'Order Confirmation')

@section('subtitulo')
    
@endsection

@section('main')
    <div class="container">
        <h1>Order Confirmation</h1>
        <!-- Add your order confirmation content here -->

        <!-- Check if the PDF path is available and display the download link -->
        @if (session('pdfPath'))
            <p>Order confirmation PDF: <a href="{{ asset(session('pdfPath')) }}" download>Download PDF</a></p>
        @endif

        <a href="{{ route('home') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
@endsection
