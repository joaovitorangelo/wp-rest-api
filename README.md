# 🚀 WP REST API

Estrutura base para construção de APIs escaláveis utilizando o :contentReference[oaicite:0]{index=0} como backend.

---

# 📁 Estrutura do Projeto

```bash
wp-rest-api
├── composer.json
├── config
│   └── app.php
├── README.md
├── routes
│   └── api.php
├── src
│   ├── Controllers
│   │   └── PostController.php
│   ├── Core
│   │   ├── Application.php
│   │   └── Container.php
│   ├── Helpers
│   │   └── Response.php
│   ├── Integrations
│   │   └── Firebase
│   │       └── FirebaseClient.php
│   ├── Providers
│   │   └── RouteServiceProvider.php
│   ├── Repositories
│   │   └── PostRepository.php
│   ├── Services
│   │   └── PostService.php
│   └── Validators
│       └── PostValidator.php
├── storage
│   └── firebase
│       └── firebase.json
└── wp-rest-api.php
```

---

# 🧩 Arquitetura

A estrutura foi organizada em camadas para manter o projeto desacoplado, modular e escalável.

---

## 📄 wp-rest-api.php

Arquivo principal do plugin.

Responsável por:

- Inicializar o plugin
- Carregar o autoload do Composer (PSR-4)
- Inicializar a aplicação
- Executar o bootstrap da arquitetura

É o ponto de entrada do sistema dentro do WordPress.

---

## 📦 composer.json

Responsável pelo gerenciamento de dependências e autoload.

Define:

- Namespace PSR-4
- Bibliotecas externas
- Configuração do Composer
- Autoload automático das classes

Exemplo:

```json
"autoload": {
  "psr-4": {
    "TokDigital\\WpRestApi\\": "src/"
  }
}
```

---

## ⚙️ config/

Responsável pelas configurações globais da aplicação.

Exemplos:

- namespace da API
- caminhos do Firebase
- constantes globais
- configurações de ambiente

### app.php

Centraliza configurações utilizadas em todo o projeto.

---

## 🛣️ routes/

Responsável pela definição dos endpoints da API.

Aqui ficam:

- `register_rest_route`
- métodos HTTP
- callbacks
- permissões da API

As rotas apenas direcionam requisições para os Controllers.

---

## 🎮 Controllers/

Responsáveis por receber as requisições HTTP.

O Controller deve:

- receber requests
- chamar Services
- retornar Responses
- tratar exceções

O Controller NÃO deve:

- acessar banco diretamente
- conter regras de negócio complexas
- realizar queries

### Fluxo

```txt
Request → Controller → Service
```

---

## 🧠 Services/

Responsáveis pelas regras de negócio da aplicação.

A camada Service é o centro da aplicação.

Responsabilidades:

- processar dados
- coordenar operações
- validar fluxo
- integrar múltiplos repositories
- integrar APIs externas
- aplicar regras de negócio

O Service NÃO deve:

- retornar resposta HTTP
- registrar rotas

### Fluxo

```txt
Controller → Service → Repository
```

---

## 🗄️ Repositories/

Responsáveis pela persistência e acesso aos dados.

Responsabilidades:

- consultas WordPress
- WP_Query
- wp_insert_post
- integração com banco
- integração futura com Firebase

O Repository NÃO deve:

- validar regras de negócio
- retornar respostas HTTP

Essa camada desacopla o sistema da origem dos dados.

---

## ✅ Validators/

Responsáveis pela validação dos dados de entrada.

Responsabilidades:

- validar payloads
- verificar campos obrigatórios
- validar formatos
- lançar exceções

Os Validators ajudam a manter:

- Services limpos
- regras reutilizáveis
- validações centralizadas

---

## 🧰 Helpers/

Responsáveis por utilidades reutilizáveis.

Exemplo:

- padronização de respostas JSON
- formatadores
- helpers genéricos

### Response.php

Padroniza todas as respostas da API:

```json
{
  "success": true,
  "data": []
}
```

---

## 🧱 Core/

Responsável pelo núcleo da aplicação.

Contém:

- bootstrap
- inicialização
- gerenciamento da aplicação
- container de dependências

---

### Application.php

Responsável por inicializar a aplicação.

Funções:

- carregar configurações
- registrar providers
- iniciar arquitetura

É o bootstrap principal do plugin.

---

### Container.php

Responsável pela injeção de dependências (Dependency Injection).

Objetivos futuros:

- resolver classes automaticamente
- desacoplar implementações
- gerenciar instâncias
- facilitar testes

Inspirado em containers modernos como:

- Laravel Service Container
- Symfony Container

---

## 🔌 Providers/

Responsáveis pelo registro de componentes da aplicação.

Funcionam como "registradores" da arquitetura.

Exemplo:

- carregamento de rotas
- registro de middlewares
- eventos
- bindings do container

---

### RouteServiceProvider.php

Responsável por carregar e registrar os arquivos de rota da API.

Centraliza a inicialização das rotas.

---

## ☁️ Integrations/

Responsável pela comunicação com serviços externos.

Exemplos:

- Firebase
- Stripe
- APIs externas
- gateways

Essa camada desacopla integrações do restante do sistema.

---

### Firebase/

Camada dedicada à integração com Firebase.

Pode conter:

- autenticação
- storage
- firestore
- realtime database

---

### FirebaseClient.php

Responsável por centralizar a conexão com o Firebase.

Funções:

- criar instâncias do SDK
- autenticação
- storage
- firestore

Evita repetição de configuração em múltiplas classes.

---

## 💾 storage/

Responsável por arquivos internos da aplicação.

Pode armazenar:

- credenciais Firebase
- logs
- cache
- arquivos temporários

---

### storage/firebase/firebase.json

Arquivo de credenciais do Firebase Admin SDK.

⚠️ Arquivo sensível.

Recomendações:

- nunca expor publicamente
- proteger via `.htaccess`
- idealmente armazenar fora do `public_html`

---

# 🔄 Fluxo da Aplicação

```txt
Request HTTP
   ↓
Routes
   ↓
Controller
   ↓
Service
   ↓
Validator
   ↓
Repository
   ↓
WordPress / Firebase
   ↓
Response
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

---

## Como funciona

- O parâmetro `-u` envia `usuario:senha` no header `Authorization`
- O WordPress decodifica as credenciais (Base64)
- Valida o usuário + Application Password
- Define o usuário autenticado (current_user)
- Executa o `permission_callback` da rota
- Retorna a resposta da API

---

## Geração da senha

- A senha utilizada **não é a senha do usuário**, mas sim uma senha gerada em:
  `Usuários → Perfil → Application Passwords`
- Cada senha é única
- Pode ser revogada a qualquer momento
- Pode ser nomeada por contexto (ex: "API", "ERP", "Mobile")

---

## Segurança

- Utilizar HTTPS obrigatório
- Não expor credenciais no frontend
- Ideal apenas para:
  - integrações backend
  - automações (cron jobs)
  - comunicação server-to-server

---

# 📌 Boas práticas aplicadas

- Separação de responsabilidades (SRP)
- Estrutura modular e reutilizável
- Padronização de respostas (JSON)
- Validação isolada
- Uso de permissões nativas do WordPress (current_user_can)

---

# 🚀 Possíveis evoluções

- 🔐 Autenticação com JWT para frontend (SPA / mobile)
- 📄 Paginação e filtros (?page=1&limit=10)
- ⚡ Cache com transients ou Redis
- 🔄 Versionamento de API (/v2)
- 🧩 Injeção de dependência (DI Container)
- 📦 DTOs e interfaces

---

# 💡 Objetivo

Transformar o WordPress em um backend estruturado e escalável, seguindo padrões modernos de desenvolvimento.