## Agenda App - Vertex

Projeto consiste em uma API desenvolvida para o teste do processo seletivo Backend Developer da Vertex.

- Repository pattern, para separar a camada de acesso a banco das demais áreas da aplicação.
- Testes unitários e de integração.
- Validações de formulário.
- Trait para padronização de retornos.


## 📚 Documentação da API

- [📖 Ver rotas da API](docs/routes.md)


## Instruções de uso

- Clone o projeto.
- Abra o caminho dele no terminal.
- Execute o comando **docker compose up --build -d** para montar e executar a aplicação.
- Com o container ativo, execute o comando **docker exec vertex-app php artisan migrate**, para criar as tabelas no banco SQLite presente no projeto e já está pronto para teste.
- Os testes podem ser executados via  **docker exec vertex-app php artisan test**.


