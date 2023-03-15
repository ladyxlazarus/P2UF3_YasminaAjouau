@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mr-auto">Listado de libros</h5>
                    <form action="{{ route('books.index') }}" method="GET" class="form-inline" style="margin-bottom: unset;">
                        <div class="form-group mb-2">
                            <label for="title" class="sr-only">Buscar por título</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Buscar por título" value="{{ $searchTitle }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="mb-3">
                    <form action="{{ route('books.index') }}" method="GET">
                        <div class="form-group" style="padding-inline:10px;">
                            <label for="category">Categoría:</label>
                            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                                <option value="">Todas las categorías</option>
                                <option value="sin-categorizar" {{ ($selectedCategory == 'sin-categorizar') ? 'selected' : '' }}>Sin categorizar</option>
                                @if($categories->isNotEmpty())
                                @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ ($category->name == $selectedCategory) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($books->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No hay libros registrados</td>
                        </tr>
                        @else
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                @if ($book->categories)
                                @if ($book->categories->count())
                                @foreach ($book->categories as $category)
                                {{ $category->name }}
                                @if (!$loop->last), @endif
                                @endforeach
                                @else
                                <em>Sin categorizar</em>
                                @endif
                                @else
                                <em>Sin categorizar</em>
                                @endif
                            </td>
                            <td class="d-flex" style="gap: 5px;">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary" style="max-height: 30px">Ver</a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-secondary" style="max-height: 30px">Editar</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="max-height: 30px" onclick="return confirm('¿Está seguro de que desea eliminar el libro \'{{$book->title}}\'?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $books->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection