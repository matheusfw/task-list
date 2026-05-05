<?php
class Task {
    private $titulo;
    private $concluida;

    public function __construct($titulo) {
        $this->titulo = $titulo;
        $this->concluida = false;
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
        return $status . " " . $this->titulo;
    }
}

?>