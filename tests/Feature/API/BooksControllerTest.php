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
}
