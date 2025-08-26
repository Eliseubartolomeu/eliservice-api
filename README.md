# Eliservice API

## Introdução
O **Eliservice API** é um sistema desenvolvido em Laravel que permite aos usuários agendarem serviços em datas e horários específicos. Ele oferece uma interface para gerenciar usuários, serviços e agendamentos, com suporte a operações CRUD e autenticação.

## ✨ Funcionalidades

- Login e Autenticação do usuário
- Cadastrar usuário
- Consultar usuário
- Editar dados de usuário
- Eliminar usuário
- Consultar serviço (s)
- Agendar serviço
- Editar agendamento
- Consultar agendamento (s)
- Eliminar agendamento

## ✅ Requisitos
- PHP >= 8.0
- Composer
- MySQL

## ⚙️ Instalação
1. Clone o repositório:
   ```bash
   git clone https://github.com/Eliseubartolomeu/eliservice-api.git
   ```
2. Navegue até o diretório do projeto:
   ```bash
   cd eliservice-api
   ```
3. Instale as dependências do PHP:
   ```bash
   composer install
   ```
4. Configure o arquivo `.env`:
   - Copie o arquivo de exemplo:
     ```bash
     cp .env.example .env
     ```
5. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```
6. Execute as migrações e seeds para configurar o banco de dados:
   ```bash
   php artisan migrate --seed
   ```
7. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

## Uso
A API estará disponível em [http://127.0.0.1:8000/api](http://127.0.0.1:8000/api) (ou na porta configurada). Utilize ferramentas como Postman ou cURL para testar os endpoints.

## Documentação da API

### Endpoints

#### 1. **Autenticação**
- **POST /api/login**: Realiza login e retorna um token JWT.
- **POST /api/register**: Registra um novo usuário.
- **POST /api/logout**: Encerra a sessão do usuário.

#### 2 **Home**
- **GET /api/home**: Retorna os serviços disponiveis e os usuários com o número de agendamentos feitos.

#### 3. **Perfil**
- **GET /api/profile/:id**: Retorna os detalhes de um usuário.
- **PUT /api/profile/:id**: Atualiza os dados do usuário autenticado..
- **DELETE /api/delete-profile/:id**: Remove os dados do usuário autenticado..

#### 4. **Serviços**
- **GET /api/services**: Retorna a lista de serviços disponíveis.
- **GET /api/services/:id**: Retorna os detalhes de um serviço.

#### 5. **Agendamentos**
- **GET /api/appointments**: Retorna a lista de agendamentos do usuário autenticado.
- **POST /api/appointments**: Cria um novo agendamento.
- **GET /api/appointments/:id**: Retorna os detalhes de um agendamento.
- **PUT /api/appointments/:id**: Atualiza os dados de um agendamento.
- **DELETE /api/appointments/:id**: Elimina um agendamento.


### Exemplo de Requisição
**POST /api/appointments**
```json
{ 
  "service": "8ff200db-2fa2-4823-a4d2-2d6ee7a72ace",
  "date": "2025-11-10",
  "start_time": "17:11"
}


```

**Resposta**
```json
{
  "success": true,
  "message": "Serviço agendado com sucesso!"
}
```

**GET api/profile/3ced6879-488c-4443-9e9b-46458a947ee7**

**Resposta**
```json
   {
  "user": {
    "Nome": "Eliseu Developer",
    "Foto": null,
    "Nome de usuário": "develiseu",
    "E-mail": "eliseu@teste.com",
    "Aderiu em": "21-08-2025"
  }
}
```


## Contribuição

Contribuições são bem-vindas! Siga os passos abaixo para contribuir:

1. Faça um fork do projeto. 
  
2. Crie uma branch para sua feature ou correção:
   ```bash
   git checkout -b minha-feature
   ```
3. Faça commit das suas alterações:
   ```bash
   git commit -m "Descrição da minha feature"
   ```
4. Envie para o repositório remoto:
   ```bash
   git push origin minha-feature
   ```
5. Abra um Pull Request.

## Considerações

Se o projecto for significar alguma coisa deixa um star ⭐ no repositório

Estamos juntos...