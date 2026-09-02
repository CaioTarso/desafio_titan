# Desafio Titan

Sistema de ordem de serviços desenvolvido como teste técnico para uma vaga de Desenvolvedor PHP Júnior.

A aplicação simula o controle de ordens de serviço de uma empresa fictícia de informática, a **JM Informática**, permitindo que usuários cadastrem, acompanhem e finalizem serviços prestados.

## Funcionalidades

- Cadastro de usuários
- Login e logout com sessão
- Cadastro de ordens de serviço
- Listagem de serviços em dashboard
- Filtros por descrição, período, status e usuário
- Edição de serviços
- Exclusão de serviços
- Finalização de serviços
- Cálculo de comissão ao finalizar uma ordem de serviço
- Envio de e-mail ao usuário após a finalização do serviço

## Tecnologias utilizadas

- PHP 8.3
- MySQL
- HTML
- CSS
- PDO para conexão com o banco de dados

## Estrutura do projeto

```text
app/
├── config/          # Configuração de conexão com o banco de dados
├── controllers/     # Controladores da aplicação
├── models/          # Modelos de dados
├── public/          # Arquivo de entrada, assets, CSS, JS e imagens
├── repositories/    # Camada de acesso ao banco de dados
├── scripts/         # Scripts SQL para criação das tabelas
├── services/        # Serviços auxiliares, como envio de e-mail
└── views/           # Telas da aplicação
```

## Requisitos

- PHP 8.3 ou superior
- MySQL
- Servidor local, como o servidor embutido do PHP, XAMPP, Laragon ou similar

## Configuração do banco de dados

Crie um banco de dados MySQL com o nome:

```sql
CREATE DATABASE jm_informatica;
```

Depois, execute os scripts SQL disponíveis em:

```text
app/scripts/createuser.sql
app/scripts/createservice.sql
```

A aplicação espera as seguintes credenciais de banco, configuradas em `app/config/database.php`:

```php
private $host = "localhost";
private $dbname = "jm_informatica";
private $user = "root";
private $pass = "root";
```

Caso seu ambiente use outro usuário ou senha, altere esses valores no arquivo de configuração.

## Como iniciar o projeto

Na raiz do projeto, execute:

```bash
php -S localhost:8000 -t app/public
```

Em seguida, acesse no navegador:

```text
http://localhost:8000
```

## Observações

Por ser um teste técnico simples, o projeto foi desenvolvido em PHP puro, sem uso de frameworks ou Composer. A separação em controllers, models, repositories, services e views foi utilizada para organizar melhor as responsabilidades da aplicação.

As configurações de banco foram mantidas diretamente no arquivo `app/config/database.php`. Em um ambiente de produção, o ideal seria utilizar variáveis de ambiente.
