@extends('layouts.app')

@section('title', 'Productos - GestorComercial')
@section('header', 'Gestión de productos')

@section('content')

    <div class="welcome">
        <div>
            <h1>Gestión de productos</h1>
            <p>Consulta y administra el inventario de tu negocio.</p>
        </div>
        <div class="welcome-icon">📦</div>
    </div>

    <div class="section-heading">
    <div>
        <h2>Inventario de productos</h2>
        <p>Productos registrados en la base de datos</p>
    </div>

    <div style="display: flex; align-items: center; gap: 15px;">
        <span class="period">
            {{ $productos->count() }} productos registrados
        </span>

        <a href="{{ route('productos.create') }}" class="btn-primary">
            + Nuevo producto
        </a>
    </div>
</div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Precio compra</th>
                        <th>Precio venta</th>
                        <th>Stock</th>
                        <th>Stock mínimo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($productos as $producto)
                        <tr>
                            <td>{{ $producto->codigo }}</td>
                            <td class="product-name">{{ $producto->nombre }}</td>
                            <td>${{ number_format($producto->precio_compra, 0, ',', '.') }}</td>
                            <td>${{ number_format($producto->precio_venta, 0, ',', '.') }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>{{ $producto->stock_minimo }}</td>
                            <td>
                                @if($producto->activo)
                                    <span class="status-active">Activo</span>
                                @else
                                    <span class="status-inactive">Inactivo</span>
                                @endif
                            </td>

      <td>
    <div style="display: flex; gap: 8px;">

        <a href="{{ route('productos.edit', $producto->id) }}"
           class="btn-edit">
            Editar
        </a>

        <form action="{{ route('productos.destroy', $producto->id) }}"
              method="POST"
              onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn-delete">
                Eliminar
            </button>
        </form>

    </div>
</td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection