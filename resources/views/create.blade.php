<x-app title="Crear Libro">
    <section class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="h4">Crear Libro</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <x-form/>
                </form>
            </div>
        </div>
    </section>
</x-app>
