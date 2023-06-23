@extends('template.layout')

@section('titulo', 'Carrinho de Compras')

@section('subtitulo')
    <h2>Encomendar</h2>
@endsection

@section('main')
    <div>
        <form method="POST" action="{{ route('cart.placeOrder') }}">
            @csrf

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

            <!-- Rest of the form -->
            <!-- NIF input -->
            <div class="form-group">
                <label for="nif">NIF</label>
                <input type="text" name="nif" id="nif" class="form-control" value="{{ old('nif') }}" required>
                @error('nif')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Payment method input -->
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="">Select Payment Method</option>
                    <!-- Add your payment method options here -->
                </select>
                @error('payment_method')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Address input -->
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" required>{{ old('address') }}</textarea>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Place order button -->
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
@endsection
