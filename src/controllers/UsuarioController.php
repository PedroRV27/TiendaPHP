<?php
namespace Controllers;
use Models\Usuario;
use Models\Categoria;
use lib\Pages;
use Utils\Utils;


class UsuarioController {
    private Pages $pages;

    public function __construct() {
        $this->pages = new Pages();
    }

    public function index(): void {
        $id = 1;
        $categoria = new Categoria();
        $categoria->setId($id);
        $productos = $categoria->getAllProducts();
        $categoria = $categoria->getOne();
        $this->pages->render("categoria/inicio", ["categoria" => $categoria, "productos" => $productos]);

    }

    public function registro(): void {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST["data"]) {
                $registrado = $_POST["data"];
                $registrado["password"] = password_hash($registrado["password"], PASSWORD_BCRYPT, ["cost" => 4]);

                $usuario = Usuario::fromArray($registrado);


                $save = $usuario->save();
                if ($save) {
                    $_SESSION["register"] = "complete";
                } else {
                    $_SESSION["register"] = "failed";
                }
            } else {
                $_SESSION["register"] = "failed";
            }
        }
        $this->pages->render("usuario/registro");
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST["data"]) {
                $usuario = Usuario::fromArray($_POST["data"]);
                $identity = $usuario->login();
    
                if ($identity && is_object($identity)) {
                    if (isset($_SESSION["errorIdentity"])) {
                        unset($_SESSION["errorIdentity"]);
                    }
                    $_SESSION["identity"] = $identity;
    
                    if ($identity->rol == "admin") {
                        $_SESSION["admin"] = true;
                    }
                    // Verificar si el checkbox Recordarme fue marcado
                    if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
                        // Crear una cookie que expire en 7 días
                        $cookie_name = "remember_me";
                        $cookie_value = $identity->id; 
                        $cookie_expire = time() + (7 * 24 * 60 * 60); // 7 días
                        setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
                    }
    
                    header("Location:" . base_url);
                } else {
                    $this->pages->render("usuario/login", ["error" => $identity]);
                }
            }
        }
        $this->pages->render("usuario/login");
    }

    public function logout(): void {
        if (isset($_SESSION["identity"])) {
            unset($_SESSION["identity"]);
        }
        if (isset($_SESSION["admin"])) {
            unset($_SESSION["admin"]);
        }
        if (isset($_SESSION["carrito"])) {
            unset($_SESSION["carrito"]);
        }
        if (isset($_COOKIE["remember_me"])) {
            setcookie("remember_me", "", time() - 3600, "/");
        }

        header("Location: ".base_url);
        // Utils::deleteSession('identity');
        // Utils::deleteSession('carrito');
        // header("Location:".base_url);
    }
}