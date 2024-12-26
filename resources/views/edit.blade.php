<x-app title="Editar Libro">
    <section class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="h4">Editar Libro</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('books.update', $book) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-form :book="$book"/>
                </form>
            </div>
        </div>
    </section>
</x-app>
