<?php
namespace Controllers;

use Models\Categoria;
use Models\Producto;
use lib\Pages;
use Utils\Utils;
use lib\BaseDatos;
use PDOException;

class CategoriaController {

    private Pages $pages;
    private BaseDatos $bd;

    public function __construct() {
        $this->pages = new Pages();
        $this->bd = new BaseDatos();
    }

    public function index(): void {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        $this->pages->render("categoria/index", ["categorias" => $categorias]);
    }

    public function save(): bool|null {
        Utils::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["nombre"])) {
                $nombre = $_POST["nombre"];
                $sql = $this->bd->prepare("INSERT INTO categorias VALUES (NULL, :nombre)");

                $sql->bindParam(":nombre", $nombre, \PDO::PARAM_STR);

                try {
                    $sql->execute();
                    header("Location: ".base_url."Categoria/index");
                    return true;
                } catch (\PDOException $e) {
                    $error = $e;
                }
            }
        }
        $this->pages->render("categoria/crear");
        return null;
    }

    public function crear(): void {
        Utils::isAdmin();
        $this->pages->render("categoria/crear");
    }

    public function sus($id): void {
        
        Utils::isAdmin();
        $categoria = new Categoria();
        $categoria->setId($id);
        $productos = $categoria->getAllProducts();
        $categoria = $categoria->getOne();


        $this->pages->render("categoria/ver", ["categoria" => $categoria, "productos" => $productos]);
    }
    

    public function editar(int $id): void {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categoria->setId($id);
        $categoria = $categoria->getOne();
    
        $this->pages->render("categoria/editar", ["categoria" => $categoria]);
    }
    
    public function update(int $id): bool|null {
        Utils::isAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["nombre"])) {
                $nombre = $_POST["nombre"];
                $sql = $this->bd->prepare("UPDATE categorias SET nombre = :nombre WHERE id = :id");
    
                $sql->bindParam(":nombre", $nombre, \PDO::PARAM_STR);
                $sql->bindParam(":id", $id, \PDO::PARAM_INT);
    
                try {
                    $sql->execute();

                    header("Location: ".base_url."Categoria/index");
                    return true;
                } catch (\PDOException $e) {
                    $error = $e;
                }
            }
        }
        

        $categoria = new Categoria();
        $categoria->setId($id);
        $categoria = $categoria->getOne();
        $this->pages->render("categoria/editar", ["categoria" => $categoria]);
        
        return null;
    }
    

    public function eliminar(int $id): void {
        Utils::isAdmin();
        $productoController = new ProductoController();
        $productoController->eliminarProductosPorCategoria($id);

        $sql = $this->bd->prepare("DELETE FROM categorias WHERE id = :id");
        $sql->bindParam(":id", $id, \PDO::PARAM_INT);

        try {
            $sql->execute();
            header("Location: ".base_url."Categoria/index");
            return;
        } catch (\PDOException $e) {
            $error = $e;
            
        }
    }

    public function sas($id) {

        $categoria = new Categoria();
        $categoria->setId($id);
        $productos = $categoria->getAllProducts();
        $categoria = $categoria->getOne();



        $this->pages->render("categoria/ver", ["categoria" => $categoria, "productos" => $productos]);
    }

    public function confirmEliminar(int $id): void {
        Utils::isAdmin();
        
        $categoria = new Categoria();
        $categoria->setId($id);
        $categoria = $categoria->getOne();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = $this->bd->prepare("DELETE FROM categorias WHERE id = :id");
            $sql->bindParam(":id", $id, \PDO::PARAM_INT);
    
            try {
                $sql->execute();
                header("Location: ".base_url."Categoria/index");
                return;
            } catch (\PDOException $e) {
                $error = $e;
            }
        }

        $this->pages->render("categoria/eliminar", ["categoria" => $categoria]);
    }


}