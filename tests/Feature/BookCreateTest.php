<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_create_form()
    {
        $response = $this->get(route('books.create'));
        $response->assertStatus(200)->assertSee('Crear Libro');
    }

    public function test_create_book_success()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302)->assertRedirect(route('home'));
        $this->assertDatabaseHas('books', $bookData);
    }

    public function test_create_book_with_number_in_title()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => 12345,
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('titulo');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_title_exceeding_max_length()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => str_repeat('a', 256),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('titulo');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_empty_title()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => '',
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('titulo');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_number_in_author()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => 12345,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('autor');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

        public function test_create_book_with_author_exceeding_max_length()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => str_repeat('a', 256),
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('autor');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_empty_author()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => '',
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('autor');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_empty_publication_year()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => '',
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('anio_publicacion');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_invalid_publication_year()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => 'not-a-date',
            'genero' => $faker->word,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('anio_publicacion');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_number_in_genre()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => 12345,
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('genero');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }

    public function test_create_book_with_genre_exceeding_max_length()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => str_repeat('a', 101),
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('genero');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }
    public function test_create_book_with_empty_genre()
    {
        $faker = Faker::create();

        $bookData = [
            'titulo' => $faker->sentence(3),
            'autor' => $faker->name,
            'anio_publicacion' => $faker->date('Y-m-d'),
            'genero' => '',
        ];

        $response = $this->post(route('books.store'), $bookData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('genero');
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('books', $bookData);
    }
}
