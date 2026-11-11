@extends('layouts.app')

@section('title', 'Nueva categoría - GestorComercial')
@section('header', 'Registrar categoría')

@section('content')

    <div class="welcome">
        <div>
            <h1>Nueva categoría</h1>
            <p>Registra una nueva categoría para organizar tus productos.</p>
        </div>
        <div class="welcome-icon">📁</div>
    </div>

    <div class="section-heading">
        <div>
            <h2>Información de la categoría</h2>
            <p>Completa los siguientes campos.</p>
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

        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                <div class="form-group full-width">
                    <label for="nombre">Nombre de la categoría *</label>
                    <input type="text" id="nombre" name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ej. Tecnología" required>
                </div>

                <div class="form-group full-width">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                        rows="4"
                        placeholder="Describe brevemente esta categoría...">{{ old('descripcion') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label class="checkbox-label">
                        <input type="checkbox" name="activo" value="1"
                            {{ old('activo', '1') == '1' ? 'checked' : '' }}>
                        Categoría activa
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('categorias.index') }}" class="btn-cancel">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    Guardar categoría
                </button>
            </div>

        </form>

    </div>

@endsection