<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function home()
    {
        $books = Book::all();
        return view('index', compact('books'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(BookRequest $request)
    {
        Book::create($request->all());
        return redirect()->route('home')->with('success', 'Libro creado exitosamente.');
    }


    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('edit', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->all());
        return redirect()->route('home')->with('success', 'Libro actualizado exitosamente.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('home')->with('success', 'Libro eliminado exitosamente.');
    }

    public function filter(Request $request)
    {
        $query = Book::query();

        if ($request->has('start_date') && $request->has('end_date') && $request->start_date != '' && $request->end_date != '') {
            $query->whereBetween('anio_publicacion', [$request->start_date, $request->end_date]);
        }

        if ($request->has('genre') && $request->genre != '') {
            $query->where('genero', 'like', '%' . $request->genre . '%');
        }

        $books = $query->get();

        return view('index', compact('books'));
    }
}
