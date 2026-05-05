<?php
class Task {
    private $id;    
    private $titulo;
    private $concluida;

    public function __construct($id, $titulo) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->concluida = false;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getStatus() {
        return $this->concluida;
    }

    public function setStatus($concluida) {
        $this->concluida = $concluida;
    }

    public function concluirTarefa() {
        $this->concluida = true;
    }

    public function exibir() {
        $status = $this->concluida ? "[X]" : "[ ]";
        return "#{$this->id} {$status} {$this->titulo}";
    }
}

?>