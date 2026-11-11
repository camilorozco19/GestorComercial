@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Editar cliente</h1>
        <p>Modifica la información de {{ $cliente->nombre }}.</p>
    </div>
</div>

<div class="form-card">

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label>Nombre completo *</label>
                <input type="text" name="nombre"
                       value="{{ old('nombre', $cliente->nombre) }}" required>
            </div>

            <div class="form-group">
                <label>Tipo de documento *</label>
                <select name="tipo_documento" required>
                    <option value="">Seleccionar</option>

                    @foreach(['CC', 'CE', 'NIT', 'TI', 'Pasaporte'] as $tipo)
                        <option value="{{ $tipo }}"
                            {{ old('tipo_documento', $cliente->tipo_documento) == $tipo ? 'selected' : '' }}>
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Número de documento *</label>
                <input type="text" name="numero_documento"
                       value="{{ old('numero_documento', $cliente->numero_documento) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="correo"
                       value="{{ old('correo', $cliente->correo) }}">
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono"
                       value="{{ old('telefono', $cliente->telefono) }}">
            </div>

            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" name="ciudad"
                       value="{{ old('ciudad', $cliente->ciudad) }}">
            </div>

            <div class="form-group full-width">
                <label>Dirección</label>
                <input type="text" name="direccion"
                       value="{{ old('direccion', $cliente->direccion) }}">
            </div>

            <div class="form-group full-width">
                <label class="checkbox-label">
                    <input type="checkbox" name="activo" value="1"
                        {{ old('activo', $cliente->activo) ? 'checked' : '' }}>
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
                Actualizar cliente
            </button>
        </div>

    </form>

</div>

@endsection