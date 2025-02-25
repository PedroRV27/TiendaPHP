<?php
namespace Controllers;

use Models\Pedido;
use lib\Pages;
use lib\Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require "vendor/phpmailer/phpmailer/src/Exception.php";
// require "vendor/phpmailer/phpmailer/src/PHPMailer.php";
// require "vendor/phpmailer/phpmailer/src/SMTP.php";

class PedidoController {

    private Pages $pages;

    public function __construct() {
        $this->pages = new Pages();
    }

    public function save() : void {
        if (isset($_SESSION["identity"])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verificar si el carrito está definido en la sesión
                if (!isset($_SESSION["carrito"]) || empty($_SESSION["carrito"]["productos"])) {
                    // Manejar el error cuando el carrito no está definido o está vacío
                    $_SESSION["errorCarrito"] = "El carrito está vacío o no ha sido definido.";
                    header("Location: " . base_url . "carrito/ver");
                    exit();
                }
    
                $carrito = $_SESSION["carrito"];
                $usuarioID = $_SESSION["identity"]->id;
                $pedido = new Pedido();
    
                $valido = $pedido->validarDireccion($_POST["data"]);
    
                if ($valido === true) {
                    $pedido->setUsuarioId($usuarioID);
                    $pedido->setProvincia($_POST["data"]["provincia"]);
                    $pedido->setLocalidad($_POST["data"]["localidad"]);
                    $pedido->setDireccion($_POST["data"]["direccion"]);
                    $pedido->setCoste($carrito["total"]); // Asegúrate de que $carrito["total"] esté definido y no sea nulo
    
                    if ($pedido->hayStock($carrito["productos"])) {
                        $correcto = $pedido->save();
    
                        if ($correcto) {
                            $pedido->reducirStock($carrito["productos"]);
                            $id_pedido = Pedido::getUltimoPedido();
                            $_SESSION["IdPedido"] = $id_pedido;
    
                            $asunto = 'Compra correcta';
                            $contenido = '<h1>Gracias por su compra</h1><br>Tus pedido es:<br>';
                            $productos = $carrito["productos"];
                            foreach ($productos as $producto) {
                                $contenido .= $producto->nombre . ":";
                                $contenido .= $producto->precio . "€";
                                $contenido .= "<br>";
                            }
                            $preciototalcarrito = 0;
                            foreach ($productos as $producto) {
                                $preciototalcarrito += $producto->precio;
                            }
                            $contenido .= "Precio total del carrito es: " . $preciototalcarrito . "€";
                            $para = $_SESSION["identity"]->email;
                            $nombre = $_SESSION["identity"]->nombre;
                            Email::send($asunto, $contenido, $para, $nombre);
    
                            unset($_SESSION["carrito"]);
    
                            $this->pages->render("pedido/correcto");
                        } else {
                            $this->pages->render("pedido/error");
                        }
                        header("Refresh: 2; URL=" . base_url);
                    } else {
                        $errorStock = "No hay stock suficiente de alguno de los productos";
                        $this->pages->render("carrito/ver", ["errorStock" => $errorStock]);
                        header("Refresh: 2; URL=" . base_url . "carrito/ver");
                    }
                } else {
                    $this->pages->render("pedido/hacer", ["error" => $valido]);
                }
            } else {
                $this->pages->render("pedido/hacer");
            }
        } else {
            $_SESSION["errorIdentity"] = "<a href='" . base_url . "usuario/login'>Inicia sesión</a> para poder realizar tu pedido";
            header("Location: " . base_url . "Carrito/ver");
        }
    }

    public function misPedidos() : void {
        if (isset($_SESSION["identity"])) {
            $usuarioID = $_SESSION["identity"]->id;
            $pedido = new Pedido();
            $pedidos = $pedido->getByUser($usuarioID);

            $this->pages->render("pedido/mis_pedidos", ["pedidos" => $pedidos]);
        } else {
            $_SESSION["errorIdentity"] = "<a href='" . base_url . "usuario/login'>Inicia sesión</a> para poder ver tus pedidos";
            $this->pages->render("pedido/mis_pedidos", ["error" => $_SESSION["errorIdentity"]]);
        }
    }

    public function ver(int $id) : void {
        $pedido = new Pedido();
        $productos = $pedido->getProductos($id);
        $detallesProductos = [];

        foreach ($productos as $producto) {
            $datos = $pedido->getDetallesProducto($producto->producto_id)[0];
            $datos["unidades"] = $producto->unidades;
            $detallesProductos[] = $datos;
        }

        $this->pages->render("pedido/ver", ["productos" => $detallesProductos]);
    }

    public function hacer(){
        $this->pages->render("pedido/hacer");
    }
    

}