<?php
class ProductosPorFactura {
    private int $cantidad;
    private float $subtotal;
    
    // Relación con Factura y Producto
    private Factura $factura;
    private Producto $producto;

    public function __construct(Factura $factura, Producto $producto, int $cantidad, float $subtotal) {
        $this->factura = $factura;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->subtotal = $subtotal;
    }

    public function getCantidad(): int { return $this->cantidad; }
    public function setCantidad(int $cantidad): void { $this->cantidad = $cantidad; }

    public function getSubtotal(): float { return $this->subtotal; }
    public function setSubtotal(float $subtotal): void { $this->subtotal = $subtotal; }

    public function getFactura(): Factura { return $this->factura; }
    public function getProducto(): Producto { return $this->producto; }
}
?>
