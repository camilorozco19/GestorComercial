<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Producto::orderBy('id', 'desc')->get();

        return view('productos.index', compact('productos'));
    }

// Mostrar formulario para registrar un producto
public function create()
{
    $categorias = DB::table('categorias')
        ->where('activo', true)
        ->orderBy('nombre')
        ->get();

    $proveedores = DB::table('proveedores')
        ->where('activo', true)
        ->orderBy('nombre')
        ->get();

    return view('productos.create', compact('categorias', 'proveedores'));
}

    // Guardar un producto nuevo
    public function store(Request $request)
    {
        $datos = $request->validate([
            'categoria_id' => 'required|integer|exists:categorias,id',
            'proveedor_id' => 'nullable|integer|exists:proveedores,id',
            'codigo' => 'required|string|max:50|unique:productos,codigo',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        Producto::create($datos);

        return redirect()->route('productos.index')
            ->with('success', 'Producto registrado correctamente.');
    }

// Mostrar formulario para editar un producto
public function edit($id)
{
    $producto = Producto::findOrFail($id);

    $categorias = DB::table('categorias')
        ->where('activo', true)
        ->orderBy('nombre')
        ->get();

    $proveedores = DB::table('proveedores')
        ->where('activo', true)
        ->orderBy('nombre')
        ->get();

    return view('productos.edit', compact(
        'producto',
        'categorias',
        'proveedores'
    ));
}

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $datos = $request->validate([
            'categoria_id' => 'required|integer|exists:categorias,id',
            'proveedor_id' => 'nullable|integer|exists:proveedores,id',
            'codigo' => 'required|string|max:50|unique:productos,codigo,' . $id,
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        $producto->update($datos);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
