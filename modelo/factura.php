<?php
    class Factura{
        private string $fecha;
        private int $numero;
        private float $total;

        public function __construct(string $fecha,int $numero,float $total){
            $this->fecha = $fecha;
            $this->numero = $numero;
            $this->total = $total;
        }

        public function getFecha(): string { return $this->fecha; }
        public function getNumero(): int { return $this->numero; }
        public function getTotal(): float { return $this->total; }
    
        public function setFecha(string $fecha): void { $this->fecha = $fecha; }
        public function setNumero(int $numero): void { $this->numero = $numero; }
        public function setTotal(float $total): void { $this->total = $total; }
    }

?>