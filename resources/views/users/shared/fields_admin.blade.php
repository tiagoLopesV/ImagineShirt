@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

@if ($user->user_type != 'C')
<div class="mb-3 form-floating">
    <select class="form-select @error('tipo') is-invalid @enderror" name="payType" id="inputPayType" {{ $disabledStr }}>
        <option {{ $user->user_type == 'A' ? 'selected' : '' }}>Administrador</option>
        <option {{ $user->user_type == 'F' ? 'selected' : '' }}>Funcionário</option>
         </select>
    <label for="inputType" class="form-label">Cargo</label>
    @error('type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
@endif

<div class="mb-3">
    <div class="form-check form-switch" {{ $disabledStr }}>
        <input type="hidden" name="blocked" value="0">
        <input type="checkbox" class="form-check-input @error('blocked') is-invalid @enderror" name="blocked"
            id="inputOpcional" {{ $disabledStr }} {{ old('blocked', $user->blocked) ? 'checked' : '' }} value="1">
        <label for="inputOpcional" class="form-check-label">Bloqueado</label>
        @error('blocked')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>