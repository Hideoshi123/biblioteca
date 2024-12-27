<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_book_successfully()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);

        $this->assertDatabaseHas('books', ['id' => $book->id]);

        $response = $this->delete(route('books.destroy', $book->id));

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Libro eliminado exitosamente.');

        $bookAfterDelete = Book::find($book->id);
        $this->assertNull($bookAfterDelete);

        $response->assertRedirect(route('home'));
    }

    public function test_delete_book_with_nonexistent_id()
    {
        $response = $this->delete(route('books.destroy', 999));

        $response->assertStatus(404);
    }
}
