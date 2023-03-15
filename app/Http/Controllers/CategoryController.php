<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //en este controlador usamos queryBuilder, mostramos todas las categorias
    public function index()
    {
        //Valido que se hayan pasado todas las migraciones, sino muestro vista con error
        if (!Schema::hasTable('books')) {
            return view('books.tables-missing');
        }else if(!Schema::hasTable('categories')){
            return view('books.index');
        }

        $categories = DB::table('categories')->paginate(3);

        return view('categories.main', compact('categories'));
    }

    //validamos nombre del libro antes de guardar uno
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['name' => 'La categoría ya existe. Por favor ingrese otro nombre.']);
        }

        DB::table('categories')->insert([
            'name' => $request->input('name')
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'La categoría ha sido creada exitosamente.');
    }

    //para editar, similar al de books pero con queryBuilder
    public function edit($id)
    {
        $category = DB::table('categories')->find($id);
        return view('categories.edit', compact('category'));
    }

    //actualizacion en bbdd, validacion de nombre
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id
        ]);

        DB::table('categories')->where('id', $id)->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('categories.index')->with('success', 'La categoría ha sido actualizada exitosamente.');
    }

    //borrado de categoria, si pertenece a un libro, el libro pierde la relacion con esa categoria
    //puede haber libros sin categorias
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();

        return redirect()->route('categories.index')->with('success', 'La categoría ha sido eliminada exitosamente.');
    }
}
