<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'desc')->get();

        return view('categorias.index', compact('categorias'));
    }

    // Mostrar formulario para crear una categoría
    public function create()
    {
        return view('categorias.create');
    }

    // Guardar una categoría nueva
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'descripcion' => 'nullable|string',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        Categoria::create($datos);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente.');
    }

    // Mostrar formulario para editar una categoría
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', compact('categoria'));
    }

    // Actualizar una categoría
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $id,
            'descripcion' => 'nullable|string',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        $categoria->update($datos);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

// Eliminar una categoría
public function destroy($id)
{
    $categoria = Categoria::findOrFail($id);

    // Verificar si existen productos asociados
    $tieneProductos = Producto::where('categoria_id', $id)->exists();

    if ($tieneProductos) {
        return redirect()->route('categorias.index')
            ->with('error', 'No se puede eliminar esta categoría porque tiene productos asociados.');
    }

    $categoria->delete();

    return redirect()->route('categorias.index')
        ->with('success', 'Categoría eliminada correctamente.');
}
}