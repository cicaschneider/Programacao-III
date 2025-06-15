<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Página inicial redireciona para a lista de tarefas
$routes->get('/', 'Task::index');

// CRUD de tarefas
$routes->get('/task', 'Task::index');                     // Lista de tarefas
$routes->get('/task/create', 'Task::create');             // Formulário de nova tarefa
$routes->post('/task/store', 'Task::store');              // Salvar nova tarefa

$routes->get('/task/edit/(:num)', 'Task::edit/$1');       // Formulário de edição
$routes->post('/task/update/(:num)', 'Task::update/$1');  // Atualizar tarefa
$routes->post('/task/delete/(:num)', 'Task::delete/$1');  // Excluir tarefa

// ✅ Marcar como concluída (1 clique)
//$routes->get('/task/mark_done/(:num)', 'Task::markDone/$1'); // Marcar tarefa como concluída
$routes->post('/task/markdone/(:num)', 'Task::markDone/$1');

// Rotas padrão do CodeIgniter (opcional)
$routes->get('/home', 'Home::index');
