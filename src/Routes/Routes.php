<?php

namespace Routes;


use Controllers\CarritoController;
use Controllers\ProductoController;
use Controllers\CategoriaController;
use Controllers\PedidoController;
use Controllers\UsuarioController;

use lib\Router;

class Routes
{
    public static function index(){
        // Router::add('GET', '/Usuario/index', function (){
        //     return (new UsuarioController())->index();
        // });
        Router::add('GET','/',function (){
            return (new UsuarioController())->index();
        });
        
        Router::add('GET', '/Carrito/ver', function (){
            return (new CarritoController())->ver();
        });

        Router::add('GET', 'Carrito/addProducto/:id', function ($id){
            return (new CarritoController())->addProducto($id);
        });

        Router::add('GET', 'Carrito/removeProducto/:id', function ($id){
            return (new CarritoController())->removeProducto($id);
        });

        Router::add('GET', 'Carrito/deleteProducto/:id', function ($id){
            return (new CarritoController())->deleteProducto($id);
        });

        Router::add('GET', '/Carrito/delete', function (){
            return (new CarritoController())->delete();
        });

        Router::add('GET', 'Categoria/editar/:id', function ($id){
            return (new CategoriaController())->editar($id);
        });

        Router::add('POST', 'Categoria/update/:id', function ($id){
            return (new CategoriaController())->update($id);
        });

        Router::add('GET', 'Categoria/confirmEliminar/:id', function ($id){
            return (new CategoriaController())->confirmEliminar($id);
        });

        Router::add('POST', 'Categoria/eliminar/:id', function ($id){
            return (new CategoriaController())->eliminar($id);
        });

        Router::add('GET', '/Categoria/index', function (){
            return (new CategoriaController())->index();
        });

        Router::add('GET', '/Categoria/crear', function (){
            return (new CategoriaController())->crear();
        });

        Router::add('POST', '/Categoria/save', function (){
            return (new CategoriaController())->save();
        });

        Router::add('GET', 'Categoria/ver/:id', function ($id){
            return (new CategoriaController())->sas($id);
        });

        Router::add('POST', '/Pedido/save', function (){
            return (new PedidoController())->save();
        });

        Router::add('GET', '/Pedido/hacer', function (){
            return (new PedidoController())->hacer();
        });

        Router::add('GET', '/Pedido/misPedidos', function (){
            return (new PedidoController())->misPedidos();
        });

        Router::add('GET', 'Pedido/ver/:id', function ($id){
            return (new PedidoController())->ver($id);
        });

        Router::add('GET', '/Producto/index', function (){
            return (new ProductoController())->index();
        });

        Router::add('GET', '/Producto/crear', function (){
            return (new ProductoController())->crear();
        });

        Router::add('POST', '/Producto/save', function (){
            return (new ProductoController())->save();
        });

        Router::add('GET', '/Producto/editar/:id', function ($id) {
            return (new ProductoController())->editar($id);
        });
        
        Router::add('GET', '/Producto/eliminar/:id', function ($id) {
            return (new ProductoController())->eliminar($id);
        });
        
        Router::add('POST', '/Producto/update', function () {
            return (new ProductoController())->update();
        });

        // Router::add('GET', '/Usuario/index', function (){
        //     return (new UsuarioController())->index();
        // });

        Router::add('GET', '/Usuario/registro', function (){
            return (new UsuarioController())->registro();
        });

        Router::add('POST', '/Usuario/registro', function (){
            return (new UsuarioController())->registro();
        });

        Router::add('GET', '/Usuario/login', function (){
            return (new UsuarioController())->login();
        });

        Router::add('POST', '/Usuario/login', function (){
            return (new UsuarioController())->login();
        });

        Router::add('GET', 'Usuario/logout/', function (){
            return (new UsuarioController())->logout();
        });

        Router::add('GET', '/Usuario/editar', function (){
            return (new UsuarioController())->editar();
        });
        
        Router::add('POST', '/Usuario/update', function (){
            return (new UsuarioController())->update();
        });


        Router::dispatch();
    }
}