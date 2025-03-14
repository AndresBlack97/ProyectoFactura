<?php
    class Producto{
        private string $codigo;
        private string $nombre;
        private int $stock;
        private float $valor_unitario;

        public function __construct(string $codigo,string $nombre,int $stock,float $valor_unitario){
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->stock = $stock;
            $this->valor_unitario = $valor_unitario;
        }
        public function getCodigo(): string { return $this->codigo; }
        public function getNombre(): string { return $this->nombre; }
        public function getStock(): int { return $this->stock; }
        public function getValorUnitario(): float { return $this->valor_unitario; }
    
        public function setCodigo(string $codigo): void { $this->codigo = $codigo; }
        public function setNombre(string $nombre): void { $this->nombre = $nombre; }
        public function setStock(int $stock): void { $this->stock = $stock; }
        public function setValorUnitario(float $valor_unitario): void { $this->valor_unitario = $valor_unitario; }
    }

?>