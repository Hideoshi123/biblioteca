<x-app title="Inicio">
    <section class="my-3 text-center">
        <h1>Listado de Libros</h1>
        <a href="{{ route('books.create') }}" class="btn btn-success my-3">Agregar Nuevo Libro</a>
    </section>

    <section class="d-flex flex-wrap justify-content-center">
        @if ($books->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay libros disponibles en este momento.
            </div>
        @else
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Año de publicación</th>
                        <th>Género</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->titulo }}</td>
                            <td>{{ $book->autor }}</td>
                            <td>{{ $book->anio_publicacion }}</td>
                            <td>{{ $book->genero }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-primary btn-sm">Editar</a>
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
        @endif
    </section>
</x-app>
