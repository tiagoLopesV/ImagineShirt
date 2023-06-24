@extends('template.layout')

@section('titulo', 'Confirmação')

@section('subtitulo')
    
@endsection

@section('main')
    <div class="container">
        <h1>Confirmação Encomenda</h1>
        
        <a href="{{ asset('storage/orders/' . $orderId . '.pdf') }}" class="btn btn-primary" target="_blank" onclick="downloadPDF()">Download Fatura</a>

        <script>
            function downloadPDF() {
                setTimeout(function() {
                    window.open('{{ asset('storage/orders/' . $orderId . '.pdf') }}', '_blank');
                }, 100);
                setTimeout(function() {
                    window.close();
                }, 2000);
            }
        </script>

        <a href="{{ route('home') }}" class="btn btn-primary">Pagina Inicial</a>


    </div>
@endsection
