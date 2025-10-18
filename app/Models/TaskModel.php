<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'status', 'due_date'];
    protected $useTimestamps = true;
    
    // SIN VALIDACIÓN
    protected $validationRules = [];
    protected $skipValidation = true;

    public function searchTasks($searchTerm)
    {
        return $this->like('title', $searchTerm)
                    ->orLike('description', $searchTerm)
                    ->findAll();
    }
}
