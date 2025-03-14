<?php
    class Factura{
        private string $fecha;
        private int $numero;
        private float $total;
        private Cliente $cliente;
        private Vendedor $vendedor;

        public function __construct(string $fecha,int $numero,float $total,Cliente $cliente,Vendedor $vendedor){
            $this->fecha = $fecha;
            $this->numero = $numero;
            $this->total = $total;
            $this->Cliente = $cliente;
            $this->Vendedor = $vendedor;
        }

        public function getFecha(): string { return $this->fecha; }
        public function getNumero(): int { return $this->numero; }
        public function getTotal(): float { return $this->total; }
        public function getCliente(): Cliente { return $this->cliente; }
        public function getVendedor(): Vendedor { return $this->vendedor; }
    
        public function setFecha(string $fecha): void { $this->fecha = $fecha; }
        public function setNumero(int $numero): void { $this->numero = $numero; }
        public function setTotal(float $total): void { $this->total = $total; }
        public function setCliente(Cliente $cliente): void { $this->cliente = $cliente; }
        public function setVendedor(Vendedor $vendedor): void { $this->vendedor = $vendedor; }
    }

?>