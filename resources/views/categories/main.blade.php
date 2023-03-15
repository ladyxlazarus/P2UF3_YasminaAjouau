@extends('layouts.app')

@section('content')

<hr>
<div class="container">
    <div class="row">
        <div class="col-md-6 card-header">
            <h5 class="card-title mr-auto">Listado de categorías</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($categories->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No hay categorías registradas</td>
                    </tr>
                    @else
                    @foreach ($categories as $category)
                    <tr>
                        <td style="min-width:200px;">{{ $category->name }}</td>
                        <td style="max-width:10px;">
                            <div class="btn-group" role="group" aria-label="Acciones" style="gap: 5px;">
                                <button type="button" class="btn btn-sm btn-secondary edit-category" data-category-id="{{ $category->id }}">Editar</button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar la categoría \'{{$category->name}}\'?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div style="margin-top: 3em;" class="d-flex justify-content-center">
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <div class="col-md-6 card-header">
            <h5 class="card-title mr-auto">Agregar categoría</h5>
            <form id="category-form" action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="category-name" name="name" placeholder="Nombre de la categoría" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </div>
            </form>
            @if ($errors->has('name'))
            <script>
                alert("La categoría ya existe. Por favor ingrese otro nombre.");
            </script>
            @endif
            <div id="edit-category-form-container" class="card-header" style="display: none;">
                <h5 class="card-title mr-auto">Editar categoría</h5>
                <form id="edit-category-form" action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit-category-name">Nombre</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="edit-category-name" name="name" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                <button type="button" class="btn btn-secondary" id="cancel-edit">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- estilos para distribucion de formularios -->
<style>
    #category-form,
    #edit-category-form-container {
        margin-top: 20px;
    }

    #category-form button[type="submit"],
    #edit-category-form-container button[type="submit"],
    #edit-category-form-container button[type="button"] {
        margin-left: 10px;
    }

    #edit-category-form-container {
        margin-top: 50px;
    }

    @media (max-width: 767px) {
        #edit-category-form-container {
            margin-top: 20px;
        }
    }
</style>
@endsection

<!-- no queria mas vistas para categorias, asi que el formulario de editar se muestra y se oculta  
    cuando se click a editar una categoria con javascript (importado en layouts.app.blade.php) -->
@section('scripts')
<script>
    var editCategoryFormContainer = $('#edit-category-form-container');
    var editCategoryForm = $('#edit-category-form');
    var cancelEditBtn = $('#cancel-edit');
    var editButtons = document.querySelectorAll('.edit-category');
    var deleteButtons = document.querySelectorAll('.btn-danger');

    $('.edit-category').click(function() {
        // obtener el ID de la categoría
        var categoryId = $(this).data('category-id');
        // obtener el nombre de la categoría
        var categoryName = $(this).closest('tr').find('td:nth-child(1)').text().trim();

        // actualizar el formulario de edición con los datos de la categoría
        editCategoryForm.attr('action', '/categories/' + categoryId);
        editCategoryForm.find('#edit-category-name').val(categoryName);

        // deshabilitar botones de editar y borrar
        editButtons.forEach(function(button) {
            button.disabled = true;
        });
        deleteButtons.forEach(function(button) {
            button.disabled = true;
        });

        // mostrar el contenedor del formulario de edición
        editCategoryFormContainer.show();
    });

    // controlador de eventos para el botón "Cancelar"
    cancelEditBtn.click(function() {
        // ocultar el formulario de edición
        editCategoryFormContainer.hide();

        // habilitar botones de editar y borrar
        editButtons.forEach(function(button) {
            button.disabled = false;
        });
        deleteButtons.forEach(function(button) {
            button.disabled = false;
        });
    });
</script>
@endsection