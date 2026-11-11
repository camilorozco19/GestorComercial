@extends('layouts.app')

@section('title', 'Nuevo producto - GestorComercial')
@section('header', 'Registrar producto')

@section('content')

    <div class="welcome">
        <div>
            <h1>Nuevo producto</h1>
            <p>Completa la información para registrar un producto en el inventario.</p>
        </div>
        <div class="welcome-icon">📦</div>
    </div>

    <div class="section-heading">
        <div>
            <h2>Información del producto</h2>
            <p>Los campos marcados son obligatorios.</p>
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

        <form action="{{ route('productos.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label for="codigo">Código del producto *</label>
                    <input type="text" id="codigo" name="codigo"
                        value="{{ old('codigo') }}"
                        placeholder="Ej. PROD-051" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre del producto *</label>
                    <input type="text" id="nombre" name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Nombre del producto" required>
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría *</label>
                    <select id="categoria_id" name="categoria_id" required>
                        <option value="">Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="proveedor_id">Proveedor</label>
                    <select id="proveedor_id" name="proveedor_id">
                        <option value="">Sin proveedor asignado</option>
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="precio_compra">Precio de compra *</label>
                    <input type="number" id="precio_compra" name="precio_compra"
                        value="{{ old('precio_compra') }}"
                        min="0" step="0.01" placeholder="0.00" required>
                </div>

                <div class="form-group">
                    <label for="precio_venta">Precio de venta *</label>
                    <input type="number" id="precio_venta" name="precio_venta"
                        value="{{ old('precio_venta') }}"
                        min="0" step="0.01" placeholder="0.00" required>
                </div>

                <div class="form-group">
                    <label for="stock">Cantidad disponible *</label>
                    <input type="number" id="stock" name="stock"
                        value="{{ old('stock', 0) }}"
                        min="0" placeholder="0" required>
                </div>

                <div class="form-group">
                    <label for="stock_minimo">Stock mínimo *</label>
                    <input type="number" id="stock_minimo" name="stock_minimo"
                        value="{{ old('stock_minimo', 5) }}"
                        min="0" placeholder="5" required>
                </div>

                <div class="form-group full-width">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                        rows="4" placeholder="Descripción del producto...">{{ old('descripcion') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label class="checkbox-label">
                        <input type="checkbox" name="activo" value="1"
                            {{ old('activo', '1') == '1' ? 'checked' : '' }}>
                        Producto activo
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('productos.index') }}" class="btn-cancel">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    Guardar producto
                </button>
            </div>

        </form>

    </div>

@endsection