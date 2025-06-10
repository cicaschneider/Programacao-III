# Projeto CRUD com Codelgniter

Este é um projeto simples de lista de tarefas (To-Do List) desenvolvido com PHP e MySQL, utilizando HTML, CSS e Font Awesome para a interface.

## ✨ Funcionalidades

- ✅ Adicionar novas tarefas
- 📝 Visualizar tarefas em ordem de criação
- ✔️ Marcar tarefas como concluídas
- 🗑 Excluir tarefas
- 🌙 Tema escuro e visual moderno
- 📱 Layout responsivo para celular

## 🚀 Tecnologias Utilizadas

- PHP (Procedural + PDO)
- MySQL
- HTML5
- CSS3 (tema escuro + responsivo)
- Font Awesome (ícones)

##📦 Estrutura de arquivos
```
todo-list/
│
├── index.php         → Página principal da lista
├── add.php           → Script para adicionar tarefa
├── delete.php        → Script para deletar tarefa
├── done.php          → Script para marcar como feita
├── db.php            → Conexão com o banco de dados
├── style.css         → Estilo da interface
└── README.md         → Este arquivo
```

##🛠 Como rodar o projeto

1. Instale o XAMPP ou similar
2. Copie a pasta do projeto para C:\xampp\htdocs\todo-list
3. Inicie o Apache e MySQL pelo painel do XAMPP
4. Acesse o phpMyAdmin
5. Crie o banco de dados:
   ```
   CREATE DATABASE todo_list CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```
7. Crie a tabela:
   ```
   CREATE TABLE tasks (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255) NOT NULL,
     is_done TINYINT(1) DEFAULT 0,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```
9. Abra no navegador:
    ```
    http://localhost/todo-list/
    ```

## 👨‍💻 Integrantes do Grupo

- Kauan A. Cipriani	      
- Maria Cecilia	         
- Vitor H. Konzen	        
- Guilher Depiné           
