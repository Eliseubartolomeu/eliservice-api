# 🚀 Eliservice API

![version](https://img.shields.io/badge/version-1.0.0-blue)
![Laravel](https://img.shields.io/badge/laravel-12.23.1-red)
![status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow)

API desenvolvida em Laravel para agendamento de serviços. Permite autenticação de usuários, gerenciamento de perfis, serviços e agendamentos com suporte completo a operações CRUD.

---

## 📚 Sumário

- [Funcionalidades](#-funcionalidades)
- [Requisitos](#-requisitos)
- [Instalação](#️-instalação)
- [Autenticação](#-autenticação)
- [Uso da API](#-uso-da-api)
- [Endpoints](#-endpoints)
- [Exemplos de Requisição](#-exemplos-de-requisição)
- [Testes](#-testes)
- [Contribuição](#-contribuição)
- [Licença](#-licença)
- [Considerações Finais](#-considerações-finais)

---

## ✨ Funcionalidades

- Autenticação JWT (login, registro, logout)
- Cadastro e gerenciamento de usuários
- Consulta e gerenciamento de serviços
- Agendamento de serviços com horário e data
- Consulta e edição de agendamentos
- Exclusão de usuários e agendamentos

---

## ✅ Requisitos

- PHP >= 8.0
- Composer
- MySQL
- Laravel >= 10.x

---

## ⚙️ Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/Eliseubartolomeu/eliservice-api.git

2. Acesse o diretório:

   ```bash
   cd eliservice-api
   ```

3. Instale as dependências:

   ```bash
   composer install
   ```

4. Copie o arquivo `.env` e configure:

   ```bash
   cp .env.example .env
   ```

5. Gere a chave da aplicação:

   ```bash
   php artisan key:generate
   ```

6. Configure o banco de dados no arquivo `.env`:

   ```
   DB_DATABASE=eliservice
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Execute as migrações e seeds:

   ```bash
   php artisan migrate --seed
   ```

8. Inicie o servidor:

   ```bash
   php artisan serve
   ```

A API estará disponível em `http://127.0.0.1:8000/api`.

---

## 🔐 Autenticação

A API utiliza **JWT** para autenticação. Após o login, você receberá um token que deve ser incluído no header das requisições protegidas:

**Exemplo de Header:**

```
Authorization: Bearer SEU_TOKEN_JWT
```

---

## 📦 Uso da API

Recomenda-se o uso de ferramentas como `insomnia`, `Thunder Client`, [-Postman](https://www.postman.com/) ou `curl` para testar os endpoints da API.

---

## 📌 Endpoints

### 1. **Autenticação**

| Método | Endpoint        | Descrição                    |
| ------ | --------------- | ---------------------------- |
| POST   | `/api/register` | Registrar um novo usuário    |
| POST   | `/api/login`    | Realizar login e obter token |
| POST   | `/api/logout`   | Efetuar logout               |

---

### 2. **Usuário / Perfil**

| Método | Endpoint                   | Descrição                   |
| ------ | -------------------------- | --------------------------- |
| GET    | `/api/profile/{id}`        | Obter dados do usuário      |
| PUT    | `/api/profile/{id}`        | Atualizar perfil do usuário |
| DELETE | `/api/delete-profile/{id}` | Excluir perfil do usuário   |

---

### 3. **Serviços**

| Método | Endpoint             | Descrição                |
| ------ | -------------------- | ------------------------ |
| GET    | `/api/services`      | Listar todos os serviços |
| GET    | `/api/services/{id}` | Detalhes de um serviço   |

---

### 4. **Agendamentos**

| Método | Endpoint                 | Descrição                      |
| ------ | ------------------------ | ------------------------------ |
| GET    | `/api/appointments`      | Listar agendamentos do usuário |
| POST   | `/api/appointments`      | Criar novo agendamento         |
| GET    | `/api/appointments/{id}` | Detalhes de um agendamento     |
| PUT    | `/api/appointments/{id}` | Atualizar um agendamento       |
| DELETE | `/api/appointments/{id}` | Excluir agendamento            |

---

## 📤 Exemplos de Requisição

### 🔸 Criar Agendamento

**POST /api/appointments**

**Request:**

```json
{
  "service": "8ff200db-2fa2-4823-a4d2-2d6ee7a72ace",
  "date": "2025-11-10",
  "start_time": "17:11"
}
```

**Response:**

```json
{
  "status": true,
  "message": "Serviço agendado com sucesso!"
}
```

---

### 🔹 Obter Perfil

**GET /api/profile/3ced6879-488c-4443-9e9b-46458a947ee7**

**Response:**

```json
{
  "status": true,
  "user": {
    "name": "Eliseu Fullstack",
    "photo": null,
    "username": "admin",
    "email": "eliseu@mail.com",
    "registed_at": "21-08-2025"
  }
}
```

---

## 🧪 Testes

> ⚠️ Em breve será incluída cobertura completa de testes automatizados.

---

## 🛠 Contribuição

Contribuições são bem-vindas! 💪

1. Fork este repositório
2. Crie sua branch: `git checkout -b minha-feature`
3. Commit: `git commit -m 'Minha nova feature'`
4. Push: `git push origin minha-feature`
5. Abra um Pull Request

---

## 📄 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

## ⭐ Considerações Finais

Se este projeto for útil para você, deixe uma ⭐ no repositório!
Isso ajuda a dar visibilidade e incentiva a evolução contínua do projeto.

Estamos juntos! 🚀

##