@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputNome"
        {{ $disabledStr }} value="{{ old('name', $user->name) }}">
    <label for="inputNome" class="form-label">Nome</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail"
        {{ $disabledStr }} value="{{ old('email', $user->email) }}">
    <label for="inputEmail" class="form-label">Email</label>
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <select class="form-select @error('genero') is-invalid @enderror" name="genero" id="inputGenero"
        {{ $disabledStr }}>
        <option {{ old('genero', $user->genero) == 'M' ? 'selected' : '' }} value="M">Masculino
        </option>
        <option {{ old('genero', $user->genero) == 'F' ? 'selected' : '' }} value="F">Feminino
        </option>
    </select>
    <label for="inputGenero" class="form-label">Gênero</label>
    @error('genero')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

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
