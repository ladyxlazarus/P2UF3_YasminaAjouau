<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;

class BookController extends Controller
{

    //index: si hay searchTitle se filtra por titulo de libro,
    // si no, verifico por select, selected igual a '' muestro Todas las categorias
    public function index(Request $request)
    {
        //Valido que se haya pasado la migracion, sino muestro error
        if (!Schema::hasTable('books') || !Schema::hasTable('categories')) {
            return view('books.tables-missing');
        }

        $selectedCategory = $request->query('category', '');
        $searchTitle = $request->query('title', '');

        $booksQuery = Book::query();

        if ($selectedCategory === 'sin-categorizar') {
            $booksQuery->doesntHave('categories');
        } elseif ($selectedCategory !== '') {
            $booksQuery->whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('name', $selectedCategory);
            });
        }

        if ($searchTitle !== '') {
            $booksQuery->where('title', 'like', '%' . $searchTitle . '%');
        }

        $books = $booksQuery->paginate(4);
        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories', 'selectedCategory', 'searchTitle'));
    }

    //vista de libro por id, muestro datos que no aparecen en la vista principal
    public function show($id)
    {
        $book = Book::find($id);

        return view('books.show', compact('book'));
    }

    //el isbn no se setea, por cada creacion de libro se genera un numero aleatorio y unico
    private function generateIsbn()
    {
        $faker = Faker::create();
        $isbn = $faker->unique()->isbn10();

        $book = Book::where('isbn', $isbn)->first(); //valido que no esté repetido
        if ($book) {
            return $this->generateIsbn();
        }
        return $isbn;
    }

    //creamos libro, ofreciendo todas las categorias disponibles en un checkbox y se genera automatico el isbn
    public function create()
    {
        $categories = Category::all();
        $isbn = $this->generateIsbn();
        return view('books.create', compact('categories', 'isbn'));
    }

    public function store(Request $request)
    {
        // crear el libro
        $book = Book::create($request->only(['isbn', 'title', 'author', 'published_date', 'description', 'price']));

        // agregar las categorías seleccionadas a la relación del libro
        $book->categories()->attach($request->input('categories'));

        // redirigir a la vista show del libro creado
        return redirect()->route('books.show', $book);
    }

    //para editar mostramos todas las categorias disponibles, pueden llamarse igual por si hay otras ediciones
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->only(['isbn', 'title', 'author', 'published_date', 'description', 'price']));
        $book->categories()->detach(); //borro categorias anteriores para setear
        $book->categories()->sync($request->input('category')); //sync recibe array para la tabla pivote

        return redirect()->route('books.show', $book);
    }

    //como tenemos onDeleteCascade/onUpdateCascade se actualiza la tabla pivote sola
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('books.index');
    }
}
