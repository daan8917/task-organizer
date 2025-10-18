<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Organizador de Tareas',
            'tasks' => $this->taskModel->findAll()
        ];

        return view('tasks/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'POST') {
            $postData = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'status' => $this->request->getPost('status'),
                'due_date' => $this->request->getPost('due_date')
            ];

            if ($this->taskModel->save($postData)) {
                return redirect()->to(base_url('index.php/tasks'))->with('success', 'Tarea creada exitosamente');
            } else {
                return redirect()->back()->with('errors', $this->taskModel->errors());
            }
        }

        return view('tasks/create', ['title' => 'Crear Nueva Tarea']);
    }

    public function edit($id)
{
    $task = $this->taskModel->find($id);

    if (!$task) {
        return redirect()->to(base_url('index.php/tasks'))->with('error', 'Tarea no encontrada');
    }

    if ($this->request->getMethod() === 'POST') {
        $postData = [
            'id' => $id,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'due_date' => $this->request->getPost('due_date')
        ];

        if ($this->taskModel->save($postData)) {
            return redirect()->to(base_url('index.php/tasks'))->with('success', 'Tarea actualizada exitosamente');
        } else {
            return redirect()->back()->with('errors', $this->taskModel->errors());
        }
    }

    $data = [
        'title' => 'Editar Tarea',
        'task' => $task
    ];

    return view('tasks/edit', $data);
}

    public function delete($id)
    {
        $task = $this->taskModel->find($id);

        if (!$task) {
            return redirect()->to(base_url('index.php/tasks'))->with('error', 'Tarea no encontrada');
        }

        if ($this->taskModel->delete($id)) {
            return redirect()->to(base_url('index.php/tasks'))->with('success', 'Tarea eliminada exitosamente');
        } else {
            return redirect()->to(base_url('index.php/tasks'))->with('error', 'Error al eliminar la tarea');
        }
    }

    public function view($id)
    {
        $task = $this->taskModel->find($id);

        if (!$task) {
            return redirect()->to(base_url('index.php/tasks'))->with('error', 'Tarea no encontrada');
        }

        $data = [
            'title' => 'Ver Tarea',
            'task' => $task
        ];

        return view('tasks/view', $data);
    }

    public function search()
    {
        $searchTerm = $this->request->getGet('q');

        if (empty($searchTerm)) {
            return redirect()->to(base_url('index.php/tasks'));
        }

        $data = [
            'title' => 'Resultados de Búsqueda: ' . $searchTerm,
            'tasks' => $this->taskModel->searchTasks($searchTerm),
            'searchTerm' => $searchTerm
        ];

        return view('tasks/index', $data);
    }
}
