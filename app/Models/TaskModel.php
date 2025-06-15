<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'description', 'status', 'deadline'];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Busca as categorias relacionadas a uma tarefa
     *
     * @param int $taskId
     * @return array
     */
    public function getCategories(int $taskId): array
    {
        $builder = $this->db->table('categories');
        $builder->select('categories.*');
        $builder->join('task_categories', 'task_categories.category_id = categories.id');
        $builder->where('task_categories.task_id', $taskId);

        return $builder->get()->getResultArray();
    }

    /**
     * Salva as categorias vinculadas a uma tarefa (substitui as antigas)
     *
     * @param int $taskId
     * @param array $categoryIds
     * @return void
     */
    public function saveCategories(int $taskId, array $categoryIds): void
    {
        // Apaga os vínculos antigos
        $this->db->table('task_categories')->where('task_id', $taskId)->delete();

        // Prepara dados para inserir
        $data = [];
        foreach ($categoryIds as $categoryId) {
            $data[] = [
                'task_id' => $taskId,
                'category_id' => $categoryId,
            ];
        }

        if (!empty($data)) {
            // Insere todas de uma vez
            $this->db->table('task_categories')->insertBatch($data);
        }
    }

    /**
     * Sobrescreve o insert para tratar deadline vazio como null
     */
    public function insert($data = null, bool $returnID = true)
    {
        if (is_array($data) && isset($data['deadline']) && empty($data['deadline'])) {
            $data['deadline'] = null;
        }
        return parent::insert($data, $returnID);
    }

    /**
     * Sobrescreve o update para tratar deadline vazio como null
     */
    public function update($id = null, $data = null): bool
    {
        if (is_array($data) && isset($data['deadline']) && empty($data['deadline'])) {
            $data['deadline'] = null;
        }
        return parent::update($id, $data);
    }
}
