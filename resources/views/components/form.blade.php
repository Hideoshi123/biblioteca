<section class="row">
    <div class="mb-3 col-12">
        <label for="titulo">Título</label>
        <input id="titulo" type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror"
               value="{{ old('titulo') ? old('titulo') : (isset($book) ? $book->titulo : '') }}"/>
        @error('titulo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="autor">Autor</label>
        <input id="autor" type="text" name="autor" class="form-control @error('autor') is-invalid @enderror"
               value="{{ old('autor') ? old('autor') : (isset($book) ? $book->autor : '') }}"/>
        @error('autor')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="anio_publicacion">Año de Publicación</label>
        <input id="anio_publicacion" type="date" name="anio_publicacion" class="form-control @error('anio_publicacion') is-invalid @enderror"
               value="{{ old('anio_publicacion') ? old('anio_publicacion') : (isset($book) ? $book->anio_publicacion : '') }}"/>
        @error('anio_publicacion')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3 col-12">
        <label for="genero">Género</label>
        <input id="genero" type="text" name="genero" class="form-control @error('genero') is-invalid @enderror"
               value="{{ old('genero') ? old('genero') : (isset($book) ? $book->genero : '') }}"/>
        @error('genero')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-12">
        <a href="{{ route('home') }}" class="btn btn-secondary me-2">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</section>
