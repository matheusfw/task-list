<?php 
require_once __DIR__ . '/../models/Task.php';

class TaskService {
    private $tasks = [];

    public function adicionar(Task $task) {
        $this->tasks[] = $task;
    }

    public function listar() {
        $lista = [];

        foreach($this->tasks as $task) {
            $lista[] = $task->exibir(); 
        }
        return $lista;
    }

    public function contarConcluidas() {
        $total = 0;

        foreach($this->tasks as $task) {
            if ($task->getStatus()) {
                $total++;
            }
        }

        return $total;
    }
}
?>