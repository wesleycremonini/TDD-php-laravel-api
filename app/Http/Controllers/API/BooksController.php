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
        $serviceResponse = $this->service->index();
        return $serviceResponse;
    }

    public function show(int $id)
    {
        $serviceResponse = $this->service->show($id);
        return $serviceResponse;
    }
}
