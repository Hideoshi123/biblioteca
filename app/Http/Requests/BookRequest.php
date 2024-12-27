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
        $rules = [
            'titulo' => ['required', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:255'],
            'anio_publicacion' => ['required', 'date'],
            'genero' => ['required', 'string', 'max:100'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser un texto válido.',
            'autor.required' => 'El autor es obligatorio.',
            'anio_publicacion.required' => 'El año de publicación es obligatorio.',
            'anio_publicacion.date' => 'El año de publicación debe ser una fecha válida.',
            'genero.required' => 'El género es obligatorio.',
        ];
    }
}
