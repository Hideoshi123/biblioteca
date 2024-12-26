<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;

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
        Book::create($request->validated());
        return redirect()->route('home')->with('success', 'Libro creado exitosamente.');
    }

    public function show(Book $book)
    {
        return view('show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return redirect()->route('home')->with('success', 'Libro actualizado exitosamente.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('home')->with('success', 'Libro eliminado exitosamente.');
    }
}
