Teste Técnico Órigo
===================

API de cadastro de clientes elaborada seguindo as orientações do teste proposto.

Version: 0.0.1

All rights reserved

http://apache.org/licenses/LICENSE-2.0.html

## Para rodar este projeto
```bash
$ git clone https://github.com/alissongla/TesteTecnicoOrigoV2_backend_AlissonCampos
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate #antes de rodar este comando verifique sua configuracao com banco em .env
$ php artisan serve
$ php artisan db:seed #para gerar os seeders, dados de teste
$ php artisan test #Rodar os testes
```
Acesssar pela url: http://localhost/api

Methods
-------

[ Jump to [Models](#__Models) ]

### Table of Contents

#### [Authlogin](#Authlogin)

-   [`post /auth/login`](#app\Http\Controllers\AuthControllerLogin)

#### [Authlogout](#Authlogout)

-   [`delete /auth/logout/user`](#app\Http\Controllers\AuthControllerLogout)

#### [Authregister](#Authregister)

-   [`post /auth/register`](#app\Http\Controllers\AuthControllerRegister)

#### [Cliente](#Cliente)

-   [`delete /cliente/{cliente}`](#app\Http\Controllers\ClienteControllerDestroy)
-   [`get /cliente`](#app\Http\Controllers\ClienteControllerIndex)
-   [`get /cliente/{cliente}`](#app\Http\Controllers\ClienteControllerShow)
-   [`post /cliente`](#app\Http\Controllers\ClienteControllerStore)
-   [`put /cliente/{cliente}`](#app\Http\Controllers\ClienteControllerUpdate)

#### [Plano](#Plano)

-   [`get /plano`](#app\Http\Controllers\PlanoControllerIndex)

Authlogin
=========

[Up](#__Methods)

``` {.post}
post /auth/login
```

Realiza o login (app\\Http\\Controllers\\AuthControllerLogin)

Realiza a verificação de login

### Consumes

This API call consumes the following media types via the Content-Type request header:

-   `application/json`

### Request body

body [body](#body) (required)

Body Parameter —

### Responses

#### 201

Login feito com sucesso [](#)

* * * * *

Authlogout
==========

[Up](#__Methods)

``` {.delete}
delete /auth/logout/user
```

Exclui um cliente (app\\Http\\Controllers\\AuthControllerLogout)

Exclui as informações de um cliente

### Path parameters

user (required)

Path Parameter — user\_id format: int64

### Responses

#### 204

Logout realizado com sucesso [](#)

* * * * *

Authregister
============

[Up](#__Methods)

``` {.post}
post /auth/register
```

Adiciona um usuário (app\\Http\\Controllers\\AuthControllerRegister)

Adiciona um usuário

### Consumes

This API call consumes the following media types via the Content-Type request header:

-   `application/json`

### Request body

body [body\_1](#body_1) (required)

Body Parameter —

### Responses

#### 201

Novo usuário adicionado [](#)

* * * * *

Cliente
=======

[Up](#__Methods)

``` {.delete}
delete /cliente/{cliente}
```

Exclui um cliente (app\\Http\\Controllers\\ClienteControllerDestroy)

Exclui as informações de um cliente

### Path parameters

cliente (required)

Path Parameter — cliente\_id format: int64

### Responses

#### 204

Excluir cliente [](#)

* * * * *

[Up](#__Methods)

``` {.get}
get /cliente
```

Mostra uma listagem de clientes (app\\Http\\Controllers\\ClienteControllerIndex)

Mostra uma listagem páginada de clientes cadastrados

### Responses

#### 200

Listagem de clientes [](#)

* * * * *

[Up](#__Methods)

``` {.get}
get /cliente/{cliente}
```

Mostra um cliente (app\\Http\\Controllers\\ClienteControllerShow)

Mostra o cliente cliente informado

### Path parameters

cliente (required)

Path Parameter — cliente\_id format: int64

### Responses

#### 200

Exibir cliente [](#)

* * * * *

[Up](#__Methods)

``` {.post}
post /cliente
```

Adiciona um cliente (app\\Http\\Controllers\\ClienteControllerStore)

Adiciona um cliente

### Consumes

This API call consumes the following media types via the Content-Type request header:

-   `application/json`

### Request body

body [body\_2](#body_2) (required)

Body Parameter —

### Responses

#### 201

Novo cliente adicionado [](#)

* * * * *

[Up](#__Methods)

``` {.put}
put /cliente/{cliente}
```

Atualiza um cliente (app\\Http\\Controllers\\ClienteControllerUpdate)

Atualiza as informações de um cliente

### Path parameters

cliente (required)

Path Parameter — cliente\_id format: int64

### Consumes

This API call consumes the following media types via the Content-Type request header:

-   `application/json`

### Request body

body [body\_3](#body_3) (required)

Body Parameter —

### Responses

#### 200

Exibir cliente [](#)

* * * * *

Plano
=====

[Up](#__Methods)

``` {.get}
get /plano
```

Mostra uma listagem de planos (app\\Http\\Controllers\\PlanoControllerIndex)

Mostra uma listagem páginada de planos cadastrados

### Responses

#### 200

Listagem de planos [](#)

* * * * *

Models
------

[ Jump to [Methods](#__Methods) ]

### Table of Contents

1.  [`body`](#body)
2.  [`body_1`](#body_1)
3.  [`body_2`](#body_2)
4.  [`body_3`](#body_3)

### `body` [Up](#__Models)

email (optional)

[String](#string)

password (optional)

[String](#string)

### `body_1` [Up](#__Models)

nome (optional)

[String](#string)

email (optional)

[String](#string)

password (optional)

[String](#string)

### `body_2` [Up](#__Models)

nome (optional)

[String](#string)

email (optional)

[String](#string)

telefone (optional)

[String](#string)

data\_nascimento (optional)

[date](#date)

cidade (optional)

[String](#string)

estado (optional)

[String](#string)

planos (optional)

[array[Integer]](#integer)

### `body_3` [Up](#__Models)

nome (optional)

[String](#string)

email (optional)

[String](#string)

telefone (optional)

[String](#string)

data\_nascimento (optional)

[date](#date)

cidade (optional)

[String](#string)

estado (optional)

[String](#string)

planos (optional)

[array[Integer]](#integer)
