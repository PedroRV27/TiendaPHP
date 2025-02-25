<?php
namespace Controllers;

use Models\Carrito;
use Models\Producto;
use lib\BaseDatos;
use lib\Pages;

class CarritoController {

    private Pages $pages;
    private BaseDatos $bd;

    public function __construct() {
        $this->pages = new Pages();
        $this->bd = new BaseDatos();
    }

    public function ver(): void {
        $carrito = new Carrito();
        $productos = $carrito->getAllProducts();
        $this->pages->render("carrito/ver", ["productos" => $productos]);
    }

    public function addProducto(int $id): void {
        $producto = new Producto();
        $producto->setId($id);
        $producto = $producto->getOne();
        $producto->unidades = 1;

        if (is_object($producto)) {
            $carrito = new Carrito();
            $carrito->addProducto($producto);
            header("Location: ".base_url."Carrito/ver");
        }
    }

    public function removeProducto(int $id): void {
        $carrito = new Carrito();
        $carrito->removeProducto($id);
        header("Location: ".base_url."Carrito/ver");
    }

    public function deleteProducto(int $id): void {
        $carrito = new Carrito();
        $carrito->deleteProducto($id);
        header("Location: ".base_url."Carrito/ver");
    }

    public function delete(): void {
        $carrito = new Carrito();
        $carrito->delete();
        header("Location: ".base_url."Carrito/ver");
    }

}