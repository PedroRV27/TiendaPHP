<?php
namespace Controllers;

use Models\Producto;
use Models\Categoria;
use lib\Pages;
use Utils\Utils;
use lib\BaseDatos;
use PDOException;

class ProductoController {

    private Pages $pages;
    private BaseDatos $bd;

    public function __construct() {
        $this->pages = new Pages();
        $this->bd = new BaseDatos();
    }

    public function index(): void {
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();

        $this->pages->render("producto/index", ["productos" => $productos]);
    }

    public function crear(): void {
        Utils::isAdmin();
        $this->pages->render("producto/crear", ["categorias" => Categoria::obtenerCategorias()]);
    }

    public function save(): void {
        Utils::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["data"])) {
                $_POST["data"]["fecha"] = date("Y-d-m");
                $valido = Producto::validarSave($_POST["data"], $_FILES["imagen"]);
                if ($valido === true) {
                    Utils::guardarImagen($_FILES["imagen"]);
                    $producto = new Producto();

                    $guardado = $producto->save($_POST["data"], $_FILES["imagen"]);

                    if ($guardado === true) {
                        header("Location: ".base_url."Producto/index");
                    } else {
                        $error = "Error, no se pudo guardar el producto";
                    }
                }
                else {
                    $error = $valido;
                }
            }
        }
        $this->pages->render("producto/crear", ["categorias" => Categoria::obtenerCategorias(), "error" => $error ?? ""]);
    }

    public function eliminarProductosPorCategoria(int $categoria_id): void {
        $sql = $this->bd->prepare("DELETE FROM productos WHERE categoria_id = :categoria_id");
        $sql->bindParam(":categoria_id", $categoria_id, \PDO::PARAM_INT);

        try {
            $sql->execute();
        } catch (\PDOException $e) {
            $error = $e;
        }
    }

    public function editar(int $id): void {
        Utils::isAdmin();
        $producto = new Producto();
        $producto->setId($id);
        $producto = $producto->getOne();

        $this->pages->render("producto/editar", ["producto" => $producto, "categorias" => Categoria::obtenerCategorias()]);
    }

    public function update(): void {
        Utils::isAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
            $id = $_POST['data']['id'];
            $productoExistente = new Producto();
            $productoExistente->setId($id);
            $productoExistente = $productoExistente->getOne();
    
            if (!$productoExistente) {
                $_SESSION['producto'] = "El producto no existe.";
                header("Location: " . base_url . "Producto/index");
                exit();
            }
            $valido = Producto::validarSave($_POST['data'], $_FILES['imagen'] ?? null);
            
            if ($valido !== true) {
                $this->pages->render("producto/editar", [
                    "producto" => $_POST['data'],
                    "categorias" => Categoria::obtenerCategorias(),
                    "error" => $valido
                ]);
                return;
            }
    
            $imagen = $productoExistente->imagen;
            if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
                if (!Utils::guardarImagen($_FILES['imagen'])) {
                    $this->pages->render("producto/editar", [
                        "producto" => $_POST['data'],
                        "categorias" => Categoria::obtenerCategorias(),
                        "error" => "Error al guardar la imagen."
                    ]);
                    return;
                }
                $imagen = $_FILES['imagen']['name'];
            }
    
            // Actualizar el producto
            $producto = new Producto();
            $producto->setId($id);
            $producto->setNombre($_POST['data']['nombre']);
            $producto->setCategoriaId($_POST['data']['categoria']);
            $producto->setDescripcion($_POST['data']['descripcion']);
            $producto->setPrecio($_POST['data']['precio']);
            $producto->setStock($_POST['data']['stock']);
            $producto->setImagen($imagen);
    
            $update = $producto->update();
    
            if ($update) {
                $_SESSION['producto'] = "complete";
            } else {
                $_SESSION['producto'] = "failed";
            }
    
            header("Location: " . base_url . "Producto/index");
            exit();
        }
    }
    

    public function eliminar(int $id): void {
        Utils::isAdmin();
        $producto = new Producto();
        $producto->setId($id);

        $eliminado = $producto->delete();

        if ($eliminado === true) {
            header("Location: " . base_url . "Producto/index");
        } else {
            $error = "Error, no se pudo eliminar el producto";
            $this->pages->render("producto/index", ["error" => $error, "productos" => $producto->getAll()]);
        }
    }
}
?>