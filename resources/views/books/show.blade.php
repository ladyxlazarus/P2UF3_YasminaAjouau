@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="color:darkblue">Título</h4>
                    <h3 class="card-title">{{ $book->title }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                            <p><strong>Autor:</strong> {{ $book->author }}</p>
                            <p><strong>Categoría:</strong>
                                    @if ($book->categories->isEmpty())
                                        <em>Sin categorizar</em>
                                    @else
                                        @foreach ($book->categories as $category)
                                        {{ $category->name }}
                                        @if (!$loop->last), @endif
                                        @endforeach
                                    @endif
                                </td>
                            </p>
                            <p><strong>Descripción:</strong> {{ $book->description }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Precio:</strong> {{ $book->price }} €</p>
                            <p><strong>Fecha de publicación:</strong> {{ $book->published_date }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4" style="gap: 5px;">
                        <a href="{{ route('books.index') }}" class="btn btn-success" style="max-height: 35px">Volver</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-primary" style="max-height: 35px">Editar</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"style="max-height: 35px" onclick="return confirm('¿Está seguro de que desea eliminar este libro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection