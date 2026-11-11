<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->get();

        return view('clientes.index', compact('clientes'));
    }

    // Mostrar formulario para crear un cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar un cliente nuevo
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|max:30|unique:clientes,numero_documento',
            'correo' => 'nullable|email|max:150',
            'telefono' => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:200',
            'ciudad' => 'nullable|string|max:100',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        Cliente::create($datos);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    // Mostrar formulario para editar un cliente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $datos = $request->validate([
            'nombre' => 'required|string|max:150',
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|max:30|unique:clientes,numero_documento,' . $id,
            'correo' => 'nullable|email|max:150',
            'telefono' => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:200',
            'ciudad' => 'nullable|string|max:100',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        $cliente->update($datos);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar un cliente
// Eliminar un cliente
public function destroy($id)
{
    $cliente = Cliente::findOrFail($id);

    // Verificar si el cliente tiene ventas asociadas
    $tieneVentas = DB::table('ventas')
        ->where('cliente_id', $id)
        ->exists();

    if ($tieneVentas) {
        return redirect()->route('clientes.index')
            ->with('error', 'No se puede eliminar este cliente porque tiene ventas asociadas.');
    }

    $cliente->delete();

    return redirect()->route('clientes.index')
        ->with('success', 'Cliente eliminado correctamente.');
}
}