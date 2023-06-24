@extends('template.layout')

@section('titulo', 'Encomendar')

@section('subtitulo')
    
@endsection

@section('main')
    <div>
        <form method="POST" action="{{ route('order.place') }}">

            @csrf
            @method('POST')

            <!-- Display the validation errors -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

                @include('customers.shared.fields', ['customer' => $customer, 'readonlyData' => false])

            <!-- Place order button -->
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
@endsection
