<?php

namespace App\Services;

use App\Repositories\BooksRepository;

class BooksService
{
  public function __construct(protected BooksRepository $repository)
  {
  }

  public function index()
  {
      $repositoryResponse = $this->repository->getAll();
      return $repositoryResponse;
  }
}
