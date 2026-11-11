@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Clientes</h1>
        <p>Administra la información de los clientes registrados.</p>
    </div>

    <a href="{{ route('clientes.create') }}" class="btn-primary">
        + Nuevo cliente
    </a>
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

    <div class="table-header">
        <h2>Listado de clientes</h2>
        <span>{{ $clientes->count() }} clientes registrados</span>
    </div>

    <div class="table-container">
        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Número</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->tipo_documento }}</td>
                        <td>{{ $cliente->numero_documento }}</td>
                        <td>{{ $cliente->correo ?? '—' }}</td>
                        <td>{{ $cliente->telefono ?? '—' }}</td>
                        <td>{{ $cliente->ciudad ?? '—' }}</td>

                        <td>
                            @if($cliente->activo)
                                <span class="status-active">Activo</span>
                            @else
                                <span class="status-inactive">Inactivo</span>
                            @endif
                        </td>

                        <td>
                            <div class="table-actions">
                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                   class="btn-edit">
                                    Editar
                                </a>

                                <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
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
                        <td colspan="9" style="text-align: center; padding: 30px;">
                            No hay clientes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection