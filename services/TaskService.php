<?php 
require_once __DIR__ . '/../models/Task.php';

class TaskService {
    private $tasks = [];

    public function __construct() {
        $this->carregarEmArquivo();
    }

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

    public function deletar($id) {
        foreach ($this->tasks as $index => $task) {
            if ($task->getId() == $id) {
                unset($this->tasks[$index]);
                $this->tasks = array_values($this->tasks);
                return true;
            }
        }
        return false;
    }

    public function atualizarTitulo($id, $novoTitulo) {
        foreach ($this->tasks as $task) {
            if ($task->getId() == $id) {
                $task->setTitulo($novoTitulo);
                return true;
            }
        }

        return false;
    }

    public function tarefaConcluida($id) {
        foreach ($this->tasks as $task) {
            if ($task->getId() == $id) {
                $task->concluirTarefa();
                return true;
            }
        }
        return false;
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

    public function salvarEmArquivo() {
        $arquivo = __DIR__ . '/../data/tasks.json';

        $dados = [];

        foreach ($this->tasks as $task) {
            $dados[] = [
                'titulo' => $task->getTitulo(),
                'concluida' => $task->getStatus()
            ];
        }

        file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    public function carregarEmArquivo() {
        $arquivo = __DIR__ . '/../data/tasks.json';

        if (!file_exists($arquivo)) {
            return;
        }

        $json = file_get_contents($arquivo);
        $dados = json_decode($json, true);

        foreach ($dados as $item) {
            $task = new Task($item['titulo'], $item['id']);
            $task->setStatus(($item['concluida']));
            $this->tasks[] = $task;
        }
    }
}
?>