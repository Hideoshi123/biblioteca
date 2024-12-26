<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'autor' => $this->faker->name(),
            'anio_publicacion' => $this->faker->date(),
            'genero' => $this->faker->randomElement(['Ciencia ficción', 'Fantasía', 'Romance', 'Terror']),
        ];
    }
}
