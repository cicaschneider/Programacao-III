<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\CategoryModel;

class Task extends BaseController
{
    protected $taskModel;
    protected $categoryModel;

    public function __construct()
    {
        // Instanciar os modelos uma vez no construtor para reutilização
        $this->taskModel = new TaskModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        $builder = $this->taskModel->builder();

        if ($search) {
            $builder->groupStart()
                ->like('title', $search)
                ->orLike('description', $search)
                ->groupEnd();
        }

        if ($status && in_array($status, ['pending', 'done'])) {
            $builder->where('status', $status);
        }

        $tasks = $builder->get()->getResultArray();

        // Carregar categorias para cada tarefa
        foreach ($tasks as &$task) {
            $task['categories'] = $this->taskModel->getCategories($task['id']);
        }

        $data = [
            'tasks'   => $tasks,
            'search'  => $search,
            'status'  => $status,
            'success' => session()->getFlashdata('success'),
            'errors'  => session()->getFlashdata('errors'),
        ];

        return view('task/index', $data);
    }

    public function create()
    {
        $categories = $this->categoryModel->findAll();

        return view('task/create', [
            'categories' => $categories,
            'errors'     => session()->getFlashdata('errors'),
            'old'        => session()->getFlashdata('_ci_old_input'),
        ]);
    }

    public function store()
    {
        $rules = [
            'title'       => 'required|min_length[3]',
            'description' => 'permit_empty',
            'status'      => 'in_list[pending,done]',
            'deadline'    => 'permit_empty|valid_date[Y-m-d]',
            'categories'  => 'permit_empty|is_array',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->save([
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'deadline'    => $this->request->getPost('deadline'),
        ]);

        $taskId = $this->taskModel->getInsertID();

        $categories = $this->request->getPost('categories') ?? [];
        if (!empty($categories)) {
            $this->taskModel->saveCategories($taskId, $categories);
        }

        return redirect()->to('/task')->with('success', 'Tarefa criada com sucesso!');
    }

    public function edit($id)
    {
        $task = $this->taskModel->find($id);

        if (!$task) {
            return redirect()->to('/task')->with('errors', ['Tarefa não encontrada.']);
        }

        $categories = $this->categoryModel->findAll();
        $taskCategories = $this->taskModel->getCategories($id);
        $taskCategoryIds = array_column($taskCategories, 'id');

        return view('task/edit', [
            'task'            => $task,
            'categories'      => $categories,
            'taskCategoryIds' => $taskCategoryIds,
            'errors'          => session()->getFlashdata('errors'),
            'old'             => session()->getFlashdata('_ci_old_input'),
        ]);
    }

    public function update($id)
    {
        $rules = [
            'title'       => 'required|min_length[3]',
            'description' => 'permit_empty',
            'status'      => 'in_list[pending,done]',
            'deadline'    => 'permit_empty|valid_date[Y-m-d]',
            'categories'  => 'permit_empty|is_array',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'deadline'    => $this->request->getPost('deadline'),
        ]);

        $categories = $this->request->getPost('categories') ?? [];
        $this->taskModel->saveCategories($id, $categories);

        return redirect()->to('/task')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function delete($id)
    {
        if ($this->taskModel->find($id)) {
            $this->taskModel->delete($id);
            return redirect()->to('/task')->with('success', 'Tarefa excluída com sucesso!');
        }

        return redirect()->to('/task')->with('errors', ['Tarefa não encontrada.']);
    }

    public function markDone($id)
    {
        $task = $this->taskModel->find($id);

        if (!$task) {
            return redirect()->to('/task')->with('errors', ['Tarefa não encontrada.']);
        }

        $this->taskModel->update($id, ['status' => 'done']);

        return redirect()->to('/task')->with('success', 'Tarefa marcada como feita!');
    }
}
