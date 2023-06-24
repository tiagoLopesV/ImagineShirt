@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputNif"
        {{ $disabledStr }} value="{{ old('nif', $customer->nif) }}">
    <label for="inputNif" class="form-label">NIF</label>
    @error('nif')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress"
        {{ $disabledStr }} value="{{ old('address', $customer->address) }}">
    <label for="inputAddress" class="form-label">Morada</label>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <select class="form-select @error('tipo') is-invalid @enderror" name="payType" id="inputPayType" {{ $disabledStr }}>
        <option value="MC"  {{ $customer->default_payment_type == 'MC' ? 'selected' : '' }}>MasterCard</option>
        <option {{ $customer->default_payment_type == 'VISA' ? 'selected' : '' }}>Visa</option>
        <option {{ $customer->default_payment_type == 'PAYPAL' ? 'selected' : '' }}>Paypal</option>
        </select>
    <label for="inputType" class="form-label">Tipo de Pagamento</label>
    @error('type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('address') is-invalid @enderror" name="payRef" id="inputPayRef"
        {{ $disabledStr }} value="{{ old('address', $customer->default_payment_ref) }}">
    <label for="inputRef" class="form-label">Referencia de Pagamaneto</label>
    @error('reference')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>