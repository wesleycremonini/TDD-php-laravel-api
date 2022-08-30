<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\BooksService;
use Illuminate\Http\Request;
class BooksController extends Controller
{
    public function __construct(protected BooksService $service)
    {
    }


    public function index()
    {
        return response()->json([
            ['id' => '1'], ['id' => '2'], ['id' => '3']
        ]);
    }
}
