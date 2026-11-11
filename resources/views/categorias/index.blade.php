@extends('layouts.app')

@section('title', 'Categorías - GestorComercial')
@section('header', 'Gestión de categorías')

@section('content')

    <div class="welcome">
        <div>
            <h1>Gestión de categorías</h1>
            <p>Organiza y administra las categorías de tus productos.</p>
        </div>
        <div class="welcome-icon">📁</div>
    </div>

    <div class="section-heading">
        <div>
            <h2>Listado de categorías</h2>
            <p>Categorías registradas en la base de datos</p>
        </div>

        <div style="display: flex; align-items: center; gap: 15px;">
            <span class="period">
                {{ $categorias->count() }} categorías registradas
            </span>

            <a href="{{ route('categorias.create') }}" class="btn-primary">
                + Nueva categoría
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="form-errors">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-card">
        <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>

                            <td class="product-name">
                                {{ $categoria->nombre }}
                            </td>

                            <td>
                                {{ $categoria->descripcion ?? 'Sin descripción' }}
                            </td>

                            <td>
                                @if($categoria->activo)
                                    <span class="status-active">Activa</span>
                                @else
                                    <span class="status-inactive">Inactiva</span>
                                @endif
                            </td>

                            <td>
                                <div style="display: flex; gap: 8px;">

                                    <a href="{{ route('categorias.edit', $categoria->id) }}"
                                       class="btn-edit">
                                        Editar
                                    </a>

                                    <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
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
                            <td colspan="5">
                                No hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection