# 🚀 WP REST API

Estrutura base para construção de APIs escaláveis utilizando o :contentReference[oaicite:0]{index=0} como backend.

---

# 🧱 Arquitetura

Este projeto segue uma arquitetura em camadas, separando responsabilidades para facilitar manutenção e escalabilidade:

- WordPress como **backend (CMS + Data Layer)**
- REST API nativa como **camada de exposição**
- :contentReference[oaicite:1]{index=1} como base de autenticação
- Endpoints customizados (`register_rest_route`)
- Separação em camadas:
  - **Routes**       → definição de endpoints
  - **Controllers**  → entrada das requisições
  - **Services**     → regras de negócio
  - **Repositories** → acesso a dados (WordPress)
  - **Validators**   → validação de entrada
  - **Helpers**      → padronização de respostas

---

# 📁 Estrutura do Projeto

```bash
/wp-content/plugins/wp-rest-api/
│
├── wp-rest-api.php
│
├── config/
│   └── app.php
│
├── routes/
│   └── posts-route.php
│
├── controllers/
│   └── PostController.php
│
├── services/
│   └── PostService.php
│
├── repositories/
│   └── PostRepository.php
│
├── validators/
│   └── PostValidator.php
│
├── helpers/
│   └── Response.php
```

---

# 🔐 Autenticação

A autenticação é feita utilizando o recurso nativo do WordPress:

👉 :contentReference[oaicite:2]{index=2}

Esse método utiliza **HTTP Basic Authentication**, enviando credenciais no header da requisição.

---

# 📡 Exemplos de Requisições

## 1. Usando cURL

```bash
curl -u admin:app_password
https://site.com/wp-json/my-api/v1/posts
```

## 2. Usando wp_remote_get

```PHP
<?php

$response = wp_remote_get("https://site.com/wp-json/my-api/v1/posts", [
    'headers' => [
        'Authorization' => 'Basic ' . base64_encode('admin:app_password')
    ]
]);

$body = wp_remote_retrieve_body($response);

$data = json_decode($body, true);

print_r($data);
```

## 3. Usando wp_remote_post

```PHP
<?php

$response = wp_remote_post("https://site.com/wp-json/my-api/v1/posts", [
    'headers' => [
        'Authorization' => 'Basic ' . base64_encode('admin:app_password'),
        'Content-Type'  => 'application/json'
    ],
    'body' => json_encode([
        'title' => 'Post via WP'
    ])
]);

$body = wp_remote_retrieve_body($response);

print_r(json_decode($body, true));
```

## Como funciona

- O parâmetro `-u` envia `usuario:senha` no header `Authorization`
- O WordPress decodifica as credenciais (Base64)
- Valida o usuário + Application Password
- Define o usuário autenticado (current_user)
- Executa o `permission_callback` da rota
- Retorna a resposta da API

## Geração da senha

- A senha utilizada **não é a senha do usuário**, mas sim uma senha gerada em:
  `Usuários → Perfil → Application Passwords`
- Cada senha é única
- Pode ser revogada a qualquer momento
- Pode ser nomeada por contexto (ex: "API", "ERP", "Mobile")

## Segurança

- Utilizar HTTPS obrigatório
- Não expor credenciais no frontend
- Ideal apenas para:
  - integrações backend
  - automações (cron jobs)
  - comunicação server-to-server

# 📌 Boas práticas aplicadas

- Separação de responsabilidades (SRP)
- Estrutura modular e reutilizável
- Padronização de respostas (JSON)
- Validação isolada
- Uso de permissões nativas do WordPress (current_user_can)

# 🚀 Possíveis evoluções

- 🔐 Autenticação com JWT para frontend (SPA / mobile)
- 📄 Paginação e filtros (?page=1&limit=10)
- ⚡ Cache com transients ou Redis
- 🔄 Versionamento de API (/v2)
- 🧩 Injeção de dependência (DI Container)
- 📦 DTOs e interfaces

# 💡 Objetivo

Transformar o WordPress em um backend estruturado e escalável, seguindo padrões modernos de desenvolvimento.