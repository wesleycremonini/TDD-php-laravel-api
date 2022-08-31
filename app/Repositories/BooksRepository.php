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

  public function getOneById(int $id)
  {
    $modelResponse = $this->model->find($id);
    return $modelResponse;
  }
}
