<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookUpdateTest extends TestCase
{

    use RefreshDatabase;

    public function test_show_edit_form_with_valid_book_id()
    {
        $faker = Faker::create();

        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);

        $response = $this->get(route('books.edit', $book->id));


        $response->assertStatus(200);
        $response->assertSee('Editar Libro');
    }

    public function test_show_edit_form_with_nonexistent_book_id()
    {
        $nonExistentBookId = 999;

        $response = $this->get(route('books.edit', $nonExistentBookId));

        $response->assertStatus(404);
    }

    public function test_update_book_with_empty_title()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => '',
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('titulo');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_numbers_in_title()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => 1234,
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('titulo');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_title_exceeding_255_characters()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => str_repeat('A', 256),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('titulo');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_empty_author()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => '',
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('autor');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_numbers_in_author()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => 123,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('autor');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_author_exceeding_255_characters()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $longAuthor = str_repeat('A', 256);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $longAuthor,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('autor');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_empty_publication_date()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => '',
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('anio_publicacion');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_invalid_publication_date()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => 'invalid-date',
            'genero' => $faker->word,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('anio_publicacion');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_empty_genre()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => '',
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('genero');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_numeric_genre()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => 12345,
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('genero');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_update_book_with_genre_exceeding_max_length()
    {
        $faker = Faker::create();
        $book = Book::create([
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ]);
        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => str_repeat('a', 101),
        ];
        $response = $this->put(route('books.update', $book->id), $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('genero');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }
}
