# 🧸 ToyMania | Loja Virtual

> Projeto final da disciplina de Desenvolvimento de Aplicações para Internet.

---

## 👨‍🏫 Sobre o Projeto
**Instituição:** Centro Universitário Maurício de Nassau  
**Disciplina:** Desenvolvimento de Aplicações para Internet  
**Professor:** Tiago Emilio  

O **ToyMania** é uma aplicação de e-commerce web desenvolvida para simular a experiência real de compra de brinquedos. O sistema conta com autenticação de usuários, catálogo dinâmico de produtos e área administrativa para gestão de estoque.

---

## 👥 Equipe de Desenvolvimento 
* **Deyvid André** (Fullstack & Líder Técnico)
* **Antonio** (UI/UX Design & Frontend)
* **Lucas** (Autenticação & Validações)
* **Janderson** (Cadastro & Relatórios)

---

## 🚀 Stack Tecnológica

O projeto foi construído utilizando a arquitetura **MVC (simplificada)** sem o uso de frameworks pesados, garantindo performance e controle total do código.

* **Front-end:**
    * HTML5 & CSS3 (Responsivo)
    * **Bootstrap 5** (Grid System e Componentes)
    * JavaScript (ES6+) para interatividade e validações (DOM)
* **Back-end:**
    * **PHP 8.x** (Nativo)
    * Sessões PHP para controle de acesso (Login/Logout)
* **Banco de Dados:**
    * MySQL (Relacional)
    * Integração via `mysqli` driver
* **Ferramentas:**
    * VS Code, XAMPP, Git/GitHub, Figma.

---

## ⚙️ Funcionalidades Implementadas

### 1. 🔐 Autenticação e Segurança
* Sistema de **Login e Logout** com persistência de sessão.
* Proteção de rotas (tentar acessar `/cadastrarProduto.php` sem logar redireciona para o login).
* Feedback visual de erros (senha incorreta, usuário não encontrado).

### 2. 🛍️ Catálogo Dinâmico
* Listagem de produtos vindos diretamente do banco de dados MySQL.
* **Imagens Processurais:** Implementação de API de placeholders (Picsum) para garantir que cada produto tenha uma imagem única visualmente, sem sobrecarregar o servidor com uploads pesados no MVP.
* **Formatação Monetária:** Preços exibidos no padrão BRL (R$ 0,00).

### 3. 🔍 Busca Inteligente (Client-Side)
* **Filtro em Tempo Real:** Barra de pesquisa no header que filtra os produtos na tela instantaneamente enquanto o usuário digita (JavaScript), economizando requisições ao banco de dados.

### 4. 📦 Gestão de Produtos (Admin)
* Formulário para cadastro de novos brinquedos com validação de campos (nome, preço, quantidade).
* Inserção segura no banco de dados com tratamento contra SQL Injection básico.

---

## 💾 Estrutura do Banco de Dados

O sistema utiliza o banco `toymania` com as seguintes tabelas principais:

| Tabela | Descrição |
| :--- | :--- |
| `usuarios` | Armazena clientes e administradores. Campos: `idUsuario`, `emailUsuario`, `senhaUsuario` (Hash), `cpfUsuario`. |
| `produtos` | Inventário da loja. Campos: `idProduto`, `nomeProduto`, `precoProduto`, `qtdProduto`. |

---

## 🛠️ Como Rodar o Projeto (Instalação)

Siga os passos abaixo para testar a aplicação em ambiente local:

1.  **Pré-requisitos:** Tenha o **XAMPP** instalado.
2.  **Configuração do Banco:**
    * Abra o `http://localhost/phpmyadmin`.
    * Crie um banco de dados chamado `toymania`.
    * Importe o arquivo `banco_de_dados/estrutura_DB_mysql.sql`.
3.  **Configuração dos Arquivos:**
    * Clone ou baixe este repositório.
    * Mova a pasta do projeto para `C:\xampp\htdocs\toymania`.
4.  **Execução:**
    * Inicie o **Apache** e **MySQL** no painel do XAMPP.
    * Acesse no navegador: `http://localhost/toymania/index.php`.

---

## 📅 Histórico e Cronograma

| Etapa | Status | Descrição |
| :--- | :--- | :--- |
| **Fase 1** | ✅ Concluído | Prototipação (Figma) e Estrutura HTML |
| **Fase 2** | ✅ Concluído | Banco de Dados e Cadastro de Usuários |
| **Fase 3** | ✅ Concluído | Login e Sessões PHP |
| **Fase 4** | ✅ Concluído | Catálogo, Busca e Integração Final |

---

> © 2025 ToyMania - Desenvolvido para fins acadêmicos.
