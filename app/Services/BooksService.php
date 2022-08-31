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

  public function show(int $id)
  {
    $repositoryResponse = $this->repository->getOneById($id);
    return $repositoryResponse;
  }


  public function store(array $req)
  {
    $book = [
      'title' => $req['title'],
      'isbn' => $req['isbn']
    ];

    $repositoryResponse = $this->repository->create($book);
    return $repositoryResponse;
  }

  public function update(int $id, array $req)
  {
    $updatedBook = [
      'title' => $req['title'],
      'isbn' => $req['isbn']
    ];

    $repositoryResponse = $this->repository->update($id, $updatedBook);
    return $repositoryResponse;
  }
}
