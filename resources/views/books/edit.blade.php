@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="color:darkblue">Editar libro</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ $book->isbn }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="author">Autor</label>
                                    <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Categoría</label>
                            <br>
                            @foreach($categories as $category)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="category[]" value="{{ $category->id }}" {{ $book->categories->contains($category) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required>{{ $book->description }}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="price">Precio</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $book->price }}" step="0.01" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="published_date">Fecha de publicación</label>
                                <input type="date" name="published_date" id="published_date" class="form-control" value="{{ $book->published_date }}" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4" style="gap: 5px;">
                            <button type="submit" class="btn btn-primary" style="max-height: 35px">Guardar cambios</button>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-secondary" style="max-height: 35px">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection