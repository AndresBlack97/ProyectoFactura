<?php
class Empresa {
    private string $codigo;
    private string $nombre;

    public function __construct(string $codigo, string $nombre) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
    }

    // Getters y Setters
    public function getCodigo(): string { return $this->codigo; }
    public function setCodigo(string $codigo): void { $this->codigo = $codigo; }

    public function getNombre(): string { return $this->nombre; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
}
?>
