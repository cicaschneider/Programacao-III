# Projeto CRUD com Codelgniter

Este é um projeto simples de lista de tarefas (To-Do List) desenvolvido com PHP e MySQL, utilizando HTML, CSS e Font Awesome para a interface.

## ✨ Funcionalidades

- ✅ Adicionar novas tarefas com título, descrição e prazo (deadline)
- 📝 Listar tarefas com filtro por status (pendente ou feita) e busca por texto
- ✔️ Marcar tarefas como concluídas com um clique
- 🗑  Excluir tarefas
- 📅 Exibir datas de criação e prazo formatadas
- 📱 Layout responsivo e moderno com Bootstrap
- 🔒 Segurança básica com proteção CSRF nos formulários
 

## 🚀 Tecnologias Utilizadas

- PHP (Procedural + PDO)
- MySQL
- HTML5
- CSS3 (tema escuro + responsivo)
- Bootstrap 5 (CSS e JS)
- Codelgniter
s
## 📦 Estrutura de arquivos
```
to_dolist/
app/
 ├─ Config/
 │   └─ Boot/
 │   └─...
 ├─ Controllers/
 │   └─ Task.php        # Controller das tarefas
 │   ├─BaseController.php
 │   └─ Home.php
 ├─ Models/
 │   └─ TaskModel.php     # Model para interagir com a tabela tasks
 │   ├─CatrgoryModel.php
 │   └─.gitkeep
 ├─ Views/
 │   └─ task/
 │       ├─ index.php     # Lista de tarefas (view principal)
 │       ├─ create.php    # Form para criação de tarefas
 │       └─ edit.php      # Form para edição de tarefas
 │   ├─errors/
public/
 └─ index.php 
```

## 🛠 Como rodar o projeto

1. Instale o PHP, Composer, e MySQL no seu ambiente.
2. Clone este repositório:
   ```
   git clone <url-do-repo>
   ```
3. Instale as dependências do CodeIgniter via Composer:
   ```
   composer install
   ```
4. Configure o banco de dados em app/Config/Database.php com suas credenciais MySQL.
5. Crie o banco e a tabela executando o SQL: 
   ```
   CREATE DATABASE todo_list CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

   USE todo_list;

   CREATE TABLE tasks (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255) NOT NULL,
     description TEXT,
     status ENUM('pending', 'done') DEFAULT 'pending',
     deadline DATE NULL,
     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```
6. Inicie o servidor embutido do PHP para desenvolvimento:
   ```
   php spark serve
   ```
7. Abra no navegador:
    ```
    http://localhost:8080/task
    ```

## 👨‍💻 Integrantes do Grupo

- Kauan Amélio Cipriani	      
- Maria Cecilia	Schneider de Oliveira        
- Vitor Hugo Konzen	        
- Guilher Depiné Neto           
