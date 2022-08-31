<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\BooksService;
use Illuminate\Http\Request;
class BooksController extends Controller
{
    public function __construct(protected BooksService $service)
    {
    }

    public function index()
    {
        $serviceResponse = $this->service->index();
        return response()->json($serviceResponse);
    }

    public function show(int $id)
    {
        $serviceResponse = $this->service->show($id);
        return response()->json($serviceResponse);

    }

    public function store(Request $req)
    {
        $serviceResponse = $this->service->store($req->all());
        return response()->json($serviceResponse, 201);
    }
}
