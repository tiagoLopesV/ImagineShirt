@extends('template.layout')

@section('titulo', 'Order Confirmation')

@section('subtitulo')
    
@endsection

@section('main')
    <div class="container">
        <h1>Order Confirmation</h1>
        <!-- Add your order confirmation content here -->

        <!-- Check if the PDF path is available and display the download link -->
        <a href="{{ asset('storage/orders/' . $orderId . '.pdf') }}" class="btn btn-primary" target="_blank" onclick="downloadPDF()">Download PDF</a>

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




        <a href="{{ route('home') }}" class="btn btn-primary">Go to Homepage</a>


    </div>
@endsection
