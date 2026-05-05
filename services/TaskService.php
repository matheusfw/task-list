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
            $task = new Task($item['titulo']);
            $task->setStatus(($item['concluida']));
            $this->tasks[] = $task;
        }
    }
}
?>