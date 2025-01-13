<x-app title="Inicio">
    <section class="my-4 text-center">
        <h1 class="display-4">Listado de Libros</h1>
        <a href="{{ route('books.create') }}" class="btn btn-success my-3">Agregar Nuevo Libro</a>
    </section>

    <section class="my-4 text-center">
        <form action="{{ route('books.filter') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="input-group mb-3">
                <input type="text" name="genre" class="form-control" placeholder="Género" value="{{ request('genre') }}">
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
            </div>
        </form>
    </section>

    <section class="container">
        @if ($books->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay libros disponibles en este momento.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Año de publicación</th>
                            <th>Género</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->titulo }}</td>
                                <td>{{ $book->autor }}</td>
                                <td>{{ $book->anio_publicacion }}</td>
                                <td>{{ $book->genero }}</td>
                                <td class="text-center">
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary btn-sm mb-2 mb-sm-0">Editar</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este libro?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</x-app>
