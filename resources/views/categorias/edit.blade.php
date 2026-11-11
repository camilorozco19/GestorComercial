@extends('layouts.app')

@section('title', 'Editar categoría - GestorComercial')
@section('header', 'Editar categoría')

@section('content')

    <div class="welcome">
        <div>
            <h1>Editar categoría</h1>
            <p>Modifica la información de la categoría seleccionada.</p>
        </div>
        <div class="welcome-icon">📁</div>
    </div>

    <div class="section-heading">
        <div>
            <h2>Información de la categoría</h2>
            <p>Actualiza los campos que necesites.</p>
        </div>
    </div>

    @if($errors->any())
        <div class="form-errors">
            <strong>Hay algunos errores en el formulario:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">

        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group full-width">
                    <label for="nombre">Nombre de la categoría *</label>
                    <input type="text" id="nombre" name="nombre"
                        value="{{ old('nombre', $categoria->nombre) }}"
                        required>
                </div>

                <div class="form-group full-width">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                        rows="4">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label class="checkbox-label">
                        <input type="checkbox" name="activo" value="1"
                            {{ old('activo', $categoria->activo ? '1' : '0') == '1' ? 'checked' : '' }}>
                        Categoría activa
                    </label>
                </div>

            </div>

            <div class="form-actions">

                <a href="{{ route('categorias.index') }}" class="btn-cancel">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    Actualizar categoría
                </button>

            </div>

        </form>

    </div>

@endsection