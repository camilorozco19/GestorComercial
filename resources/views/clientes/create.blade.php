@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Nuevo cliente</h1>
        <p>Registra la información de un nuevo cliente.</p>
    </div>
</div>

<div class="form-card">

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Nombre completo *</label>
                <input type="text" name="nombre"
                       value="{{ old('nombre') }}"
                       placeholder="Nombre del cliente" required>
            </div>

            <div class="form-group">
                <label>Tipo de documento *</label>
                <select name="tipo_documento" required>
                    <option value="">Seleccionar</option>
                    @foreach(['CC', 'CE', 'NIT', 'TI', 'Pasaporte'] as $tipo)
                        <option value="{{ $tipo }}"
                            {{ old('tipo_documento') == $tipo ? 'selected' : '' }}>
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Número de documento *</label>
                <input type="text" name="numero_documento"
                       value="{{ old('numero_documento') }}"
                       placeholder="Número de identificación" required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="correo"
                       value="{{ old('correo') }}"
                       placeholder="correo@ejemplo.com">
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono"
                       value="{{ old('telefono') }}"
                       placeholder="Número de contacto">
            </div>

            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" name="ciudad"
                       value="{{ old('ciudad') }}"
                       placeholder="Ciudad">
            </div>

            <div class="form-group full-width">
                <label>Dirección</label>
                <input type="text" name="direccion"
                       value="{{ old('direccion') }}"
                       placeholder="Dirección de residencia">
            </div>

            <div class="form-group full-width">
                <label class="checkbox-label">
                    <input type="checkbox" name="activo" value="1"
                        {{ old('activo', '1') == '1' ? 'checked' : '' }}>
                    Cliente activo
                </label>
            </div>

        </div>

        @if($errors->any())
            <div class="form-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-actions">
            <a href="{{ route('clientes.index') }}" class="btn-cancel">
                Cancelar
            </a>

            <button type="submit" class="btn-primary">
                Guardar cliente
            </button>
        </div>

    </form>

</div>

@endsection