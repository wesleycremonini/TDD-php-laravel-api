<?php

namespace App\Repositories;

use App\Models\Book;

class BooksRepository
{
  public function __construct(protected Book $model)
  {
  }

  public function getAll()
  {
    $modelResponse = $this->model->all();
    return $modelResponse;
  }
}
