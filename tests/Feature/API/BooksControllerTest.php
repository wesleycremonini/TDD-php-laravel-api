<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Testing\Fluent\AssertableJson;

class BooksControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_books_endpoint()
    {
        $books = Book::factory(3)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json) use ($books) {
            foreach ($books as $key => $value) {
                $json->hasAll(["${key}.id", "${key}.title", "${key}.isbn"]);

                $json->whereAllType([
                    "${key}.id" => 'integer',
                    "${key}.title" => 'string',
                    "${key}.isbn" => 'string'
                ]);

                $json->whereAll([
                    "${key}.id" => $value->id,
                    "${key}.title" => $value->title,
                    "${key}.isbn" => $value->isbn,
                ]);
            }
        });
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_single_book_endpoint()
    {
        $book = Book::factory(1)->createOne();

        $response = $this->getJson('/api/books/' . $book->id);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($book) {

            $json->hasAll(["id", "title", "isbn", 'created_at', 'updated_at']); //->etc();

            $json->whereAllType([
                "id" => 'integer',
                "title" => 'string',
                "isbn" => 'string'
            ]);

            $json->whereAll([
                "id" => $book->id,
                "title" => $book->title,
                "isbn" => $book->isbn,
            ]);
        });
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_books_endpoint()
    {
        $book = Book::factory(1)->makeOne(); // cria o model mas nao joga pra db

        $response = $this->postJson('/api/books', $book->toArray());

        $response->assertStatus(201); // created

        $response->assertJson(function (AssertableJson $json) use ($book) {

            $json->hasAll(["id", "title", "isbn", 'created_at', 'updated_at']); //->etc();

            $json->whereAllType([
                "id" => 'integer',
                "title" => 'string',
                "isbn" => 'string'
            ]);

            $json->whereAll([
                "title" => $book->title,
                "isbn" => $book->isbn,
            ]);
        });
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_put_books_endpoint()
    {
        $book = Book::factory(1)->createOne();

        $updatedBook = [
            'title' => 'Random Title',
            'isbn' => '1234567890'
        ];

        $response = $this->putJson('/api/books/' . $book->id, $updatedBook);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($updatedBook) {

            $json->hasAll(["id", "title", "isbn", 'created_at', 'updated_at']); //->etc();

            $json->whereAllType([
                "id" => 'integer',
                "title" => 'string',
                "isbn" => 'string'
            ]);

            $json->whereAll([
                "title" => $updatedBook['title'],
                "isbn" => $updatedBook['isbn'],
            ]);
        });
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patch_books_endpoint()
    {
        $book = Book::factory(1)->createOne();

        $updatedBook = [
            'title' => 'Random Title'
        ];

        $response = $this->patchJson('/api/books/' . $book->id, $updatedBook);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($updatedBook) {

            $json->hasAll(["id", "title", "isbn", 'created_at', 'updated_at']); //->etc();

            $json->whereAllType([
                "id" => 'integer',
                "title" => 'string',
                "isbn" => 'string'
            ]);

            $json->where("title", $updatedBook['title']);
        });
    }

        /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_books_endpoint()
    {
        $book = Book::factory(1)->createOne();

        $response = $this->deleteJson('/api/books/' . $book->id);

        $response->assertStatus(204); // no content
    }
}
