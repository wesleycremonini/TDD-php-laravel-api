<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\BooksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class BooksController extends Controller
{
    public function __construct(protected BooksService $service)
    {
    }

    public function index(): JsonResponse
    {
        $serviceResponse = $this->service->index();
        return response()->json($serviceResponse);
    }

    public function show(int $id): JsonResponse
    {
        $serviceResponse = $this->service->show($id);
        return response()->json($serviceResponse);

    }

    public function store(Request $req): JsonResponse
    {
        $serviceResponse = $this->service->store($req->all());
        return response()->json($serviceResponse, 201);
    }

    public function update(int $id, Request $req): JsonResponse
    {
        $serviceResponse = $this->service->update($id, $req->all());
        return response()->json($serviceResponse);
    }

    public function destroy(int $id): JsonResponse
    {
        $serviceResponse = $this->service->destroy($id);
        return response()->json($serviceResponse, 204);
    }
}
