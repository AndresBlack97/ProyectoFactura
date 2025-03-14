<?php
    class Persona{
        protected string $codigo;
        protected string $email;
        protected string $nombre;
        protected string $telefono;

        public function __construct(string $codigo,string $email,string $nombre,string $telefono){
            $this->codigo = $codigo;
            $this->email = $email;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
        }

        public function getCodigo(): string { return $this->codigo; }
        public function getEmail(): string { return $this->email; }
        public function getNombre(): string { return $this->nombre; }
        public function getTelefono(): string { return $this->telefono; }

        public function setCodigo(string $codigo): void { $this->codigo = $codigo; }
        public function setEmail(string $email): void { $this->email = $email; }
        public function setNombre(string $nombre): void { $this->nombre = $nombre; }
        public function setTelefono(string $telefono): void { $this->telefono = $telefono; }
    }

?>