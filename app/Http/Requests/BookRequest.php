<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titulo' => 'required|string|max:255|unique:books,titulo,' . ($this->book->id ?? 'null') . ',id',
            'autor' => 'required|string|max:255',
            'anio_publicacion' => 'required|date', // Solo aseguramos que sea una fecha válida
            'genero' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser un texto válido.',
            'titulo.unique' => 'Este título ya está registrado.',
            'autor.required' => 'El autor es obligatorio.',
            'anio_publicacion.required' => 'El año de publicación es obligatorio.',
            'anio_publicacion.date' => 'El año de publicación debe ser una fecha válida.',
            'genero.required' => 'El género es obligatorio.',
        ];
    }
}
