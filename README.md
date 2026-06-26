# Loja de Cursos Online

Aplicação web de **e-commerce de cursos online** desenvolvida em **Laravel**. O sistema permite que clientes naveguem por um catálogo de cursos, adicionem itens a um carrinho, cadastrem endereços e finalizem pedidos com pagamento processado por uma API externa. Conta também com uma área administrativa para gestão de produtos, categorias, pedidos e configurações de integração.

## 📚 Descrição

O projeto simula uma loja virtual completa de cursos, dividida em duas áreas:

- **Área do Cliente:** cadastro, login, catálogo de cursos, carrinho de compras, gerenciamento de endereços, finalização de pedidos e histórico de compras.
- **Área Administrativa:** painel com indicadores, gestão de pedidos, e CRUD de produtos, categorias, fotos e configurações de APIs externas.

O pagamento é processado através da integração com a API externa **Caçapay**, que verifica o saldo do cliente (por CPF) antes de aprovar a compra.

## ✨ Funcionalidades

### Cliente
- Cadastro e autenticação de clientes (login/logout com senha criptografada)
- Listagem de cursos com categorias e fotos
- Carrinho de compras (adicionar, remover e esvaziar itens) gerenciado por sessão
- Cadastro e seleção de endereços de entrega (vinculados a cidades)
- Finalização de pedido com pagamento via integração com a API Caçapay
- Histórico de pedidos realizados

### Administrador
- Painel administrativo com **gráfico de pedidos por mês** (Chart.js)
- Listagem de pedidos e alteração de status (pendente, finalizado, cancelado)
- CRUD de produtos (cursos)
- CRUD de categorias
- Upload e gerenciamento de fotos dos produtos
- Configuração de APIs externas (URL base e token)

### Integrações
- **Caçapay** — API externa de pagamento (verificação de saldo e aprovação)
- **Google Analytics** — acompanhamento de acessos

## 🛠️ Tecnologias

- **PHP** 8.2+
- **Laravel** 12
- **Blade** (templates)
- **Bootstrap** 5.3 (interface, com tema escuro)
- **Chart.js** (gráficos do painel)
- **SQLite** (banco de dados padrão; compatível com MySQL)
- **Composer** (dependências PHP)
- **Node.js / NPM + Vite** (build de assets)

## 🚀 Instalação e execução local

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- Node.js e NPM

### Passos

```bash
# 1. Clone o repositório
git clone https://github.com/MarcioMoreno-N/lojacursosonline.git
cd lojacursosonline

# 2. Instale as dependências PHP
composer install

# 3. Instale as dependências JavaScript
npm install

# 4. Crie o arquivo de ambiente
cp .env.example .env

# 5. Gere a chave da aplicação
php artisan key:generate

# 6. Crie o banco de dados SQLite (Linux/macOS)
touch database/database.sqlite
# No Windows (PowerShell): New-Item database/database.sqlite -ItemType File

# 7. Rode as migrations
php artisan migrate

# 8. Compile os assets
npm run dev
```

### Rodando o servidor

```bash
php artisan serve
```

Acesse a aplicação em **http://localhost:8000**.

> **Observação:** o gráfico de pedidos por mês utiliza a função `DATE_FORMAT`, específica do MySQL. Para usar esse recurso, configure o `.env` para uma conexão MySQL em vez de SQLite.

## ⚙️ Configuração das integrações

A integração de pagamento (Caçapay) é configurada pela própria área administrativa, em **Configuração de APIs**, onde se informa a URL base e o token de acesso. O ID do Google Analytics está definido no layout principal (`resources/views/layout.blade.php`).

## 📝 Nota acadêmica

Este projeto foi desenvolvido para fins **acadêmicos**, como trabalho de faculdade, com o objetivo de praticar o desenvolvimento de aplicações web com o framework Laravel. Não se destina a uso em produção.
