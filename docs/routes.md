# API de Contatos

## Rotas de Contatos

### [GET] /api/contacts

**Descrição:** Lista todos os contatos

**Query Params:**
| Parâmetro | Tipo   | Descrição                  | Obrigatório |
|-----------|--------|----------------------------|-------------|
| search    | string | Nome ou e-mail do contato  | Não         |

**Resposta:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "João",
      "email": "joao@example.com",
      "phone": 2199999999,
      "cep": "10000001",
    }
  ]
}
```

### [GET] /api/contacts/:id

**Descrição:** Traz contato especifico

**Resposta:**
```json
{
  "success": true,
  "data":
    {
      "id": 1,
      "name": "João",
      "email": "joao@example.com",
      "phone": 2199999999,
      "cep": "10000001",
    }
}
```

### [POST] /api/contacts

**Descrição:** Criar um novo contato

**Body:**
| Campo     | Tipo   | Descrição                  | Obrigatório |
|-----------|--------|----------------------------|-------------|
| name      | string | Nome do contato            | Sim         |
| email     | string | E-mail do contato          | Sim         |
| phone     | string | Telefone do contato        | Sim         |
| cep       | string | CEP do contato             | Sim         |

**Exemplo:**
```json
{
  "name": "João",
  "email": "joao@example.com",
  "phone": 2199999999,
  "cep": "10000001",
}
```

**Resposta:**
```json
{
  "success": true,
  "data":
    {
      "id": 1,
      "name": "João",
      "email": "joao@example.com",
      "phone": 2199999999,
      "cep": "10000001",
    }
}
```

### [PUT] /api/contacts/:id

**Descrição:** Edita um contato

**Body:**
| Campo     | Tipo   | Descrição                  | Obrigatório |
|-----------|--------|----------------------------|-------------|
| name      | string | Nome do contato            | Sim         |
| email     | string | E-mail do contato          | Sim         |
| phone     | string | Telefone do contato        | Sim         |
| cep       | string | CEP do contato             | Sim         |

**Exemplo:**
```json
{
  "name": "Updated",
  "email": "updated@example.com",
  "phone": 2199999999,
  "cep": "10000001",
}
```

**Resposta:**
```json
{
  "success": true,
  "data":
    {
      "id": 1,
      "name": "Updated",
      "email": "updated@example.com",
      "phone": 2199999999,
      "cep": "10000001",
    }
}
```

### [DELETE] /api/contacts/:id

**Descrição:** Remove um contato

**Resposta:**
**204 - No Content**

## Rotas de Endereços

### [GET] /api/addresses

**Descrição:** Lista todos os endereços

**Resposta:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "cep": "11001-000",
      "logradouro": "Rua Teste",
      "complemento": "até 100 - lado ímpar",
      "unidade": "",
      "bairro": "Bairro Teste",
      "localidade": "Cidade Teste",
      "uf": "RJ",
      "estado": "Rio de Janeiro",
      "created_at": "2025-01-01T00:00:00.000000Z",
      "updated_at": "2025-01-01T00:00:00.000000Z"
    }
  ]
}
```