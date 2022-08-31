##### API REST simples com Laravel desenvolvida à partir do uso de testes e a filosofia TDD.

Testes que guiaram o desenvolvimento:

```bash
  // testa método index que retorna todos os livros, 200.
  test_get_books_endpoint()

  // testa método show que retorna um único livro pelo ID, 200.
  test_get_single_book_endpoint()

  // testa método create que cria e retorna um único livro pelo titulo e isbn, 201.
  test_post_books_endpoint()

  // testa método update que atualiza e retorna um único livro pelo titulo e/ou isbn, 200.
  test_put_books_endpoint()
  test_patch_books_endpoint()

  // testa método delete que remove um único livro pelo ID e retorna 204.
  test_delete_books_endpoint()
```

Como rodar:
###### Você vai precisar do docker-compose para utilizar o Sail e subir os containers.

1. Clone este repositório.
2. cd /your/app/folder && ./vendor/bin/sail up -d (para subir os containers)
3. ./vendor/bin/sail artisan test (para rodar os testes)

Obs: Você pode adicionar um alias temporário para o Sail.
```bash
alias sail="vendor/bin/sail"
```