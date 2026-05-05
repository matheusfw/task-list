<?php

require_once 'services/TaskService.php';

echo "Lista de tarefas";

$service = new TaskService();

$t1 = new Task("Estudar PHP");
$t2 = new Task("Treinar lógica");

$t2->concluirTarefa();

$service->adicionar($t1);
$service->adicionar($t2);

foreach ($service->listar() as $task) {
    echo $task;
}

echo "Concluídas: " . $service->contarConcluidas();

?>