@extends('layouts.app')

@section('title', 'Editar producto - GestorComercial')
@section('header', 'Editar producto')

@section('content')

    <div class="welcome">
        <div>
            <h1>Editar producto</h1>
            <p>Modifica la información del producto seleccionado.</p>
        </div>
        <div class="welcome-icon">📦</div>
    </div>

    <div class="section-heading">
        <div>
            <h2>Información del producto</h2>
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
        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label for="codigo">Código del producto *</label>
                    <input type="text" id="codigo" name="codigo"
                        value="{{ old('codigo', $producto->codigo) }}" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre del producto *</label>
                    <input type="text" id="nombre" name="nombre"
                        value="{{ old('nombre', $producto->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría *</label>
                    <select id="categoria_id" name="categoria_id" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
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
                                {{ old('proveedor_id', $producto->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="precio_compra">Precio de compra *</label>
                    <input type="number" id="precio_compra" name="precio_compra"
                        value="{{ old('precio_compra', $producto->precio_compra) }}"
                        min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="precio_venta">Precio de venta *</label>
                    <input type="number" id="precio_venta" name="precio_venta"
                        value="{{ old('precio_venta', $producto->precio_venta) }}"
                        min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="stock">Cantidad disponible *</label>
                    <input type="number" id="stock" name="stock"
                        value="{{ old('stock', $producto->stock) }}"
                        min="0" required>
                </div>

                <div class="form-group">
                    <label for="stock_minimo">Stock mínimo *</label>
                    <input type="number" id="stock_minimo" name="stock_minimo"
                        value="{{ old('stock_minimo', $producto->stock_minimo) }}"
                        min="0" required>
                </div>

                <div class="form-group full-width">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label class="checkbox-label">
                        <input type="checkbox" name="activo" value="1"
                            {{ old('activo', $producto->activo ? '1' : '0') == '1' ? 'checked' : '' }}>
                        Producto activo
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('productos.index') }}" class="btn-cancel">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    Actualizar producto
                </button>
            </div>
        </form>
    </div>

@endsection