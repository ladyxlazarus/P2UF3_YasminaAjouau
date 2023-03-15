@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear nuevo libro</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-6">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ $isbn }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="author">Autor:</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categorías:</label>
                            <br>
                            @foreach ($categories as $category)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                                <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="price">Precio €:</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0.01" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="published_date">Fecha de publicación:</label>
                                <input type="date" class="form-control" id="published_date" name="published_date" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4" style="gap: 5px;">
                            <a href="{{ route('books.index') }}" class="btn btn-success" style="max-height: 35px">Volver</a>
                            <button type="submit" class="btn btn-primary" style="max-height: 35px">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection