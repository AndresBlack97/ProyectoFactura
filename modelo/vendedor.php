<?php
    class Vendedor extends Persona {
    private int $carne;
    private string $direccion;

    public function __construct(string $codigo, string $email, string $nombre, string $telefono, int $carne, string $direccion) {
        parent::__construct($codigo, $email, $nombre, $telefono);
        $this->carne = $carne;
        $this->direccion = $direccion;
    }

    public function getCarne(): int { return $this->carne; }
    public function setCarne(int $carne): void { $this->carne = $carne; }

    public function getDireccion(): string { return $this->direccion; }
    public function setDireccion(string $direccion): void { $this->direccion = $direccion; }
}
?>
