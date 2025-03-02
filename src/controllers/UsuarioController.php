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
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["data"])) {
            $registrado = $_POST["data"];
            
            //Validar
            $nombreValido = Utils::validarNombre($registrado["nombre"]);
            if ($nombreValido !== true) $errores["nombre"] = $nombreValido;

            $emailValido = Utils::validarEmail($registrado["email"]);
            if ($emailValido !== true) $errores["email"] = $emailValido;

            $passwordValido = Utils::validarPassword($registrado["password"]);
            if ($passwordValido !== true) $errores["password"] = $passwordValido;

            if (empty($errores)) {
                $registrado["password"] = password_hash($registrado["password"], PASSWORD_BCRYPT, ["cost" => 4]);
                $usuario = Usuario::fromArray($registrado);
                $save = $usuario->save();

                if ($save) {
                    $_SESSION["register"] = "complete";
                    header("Location: " . base_url . "Usuario/login");
                    exit();
                } else {
                    $_SESSION["register"] = "failed";
                }
            }
        }

        $this->pages->render("usuario/registro", ["errores" => $errores]);
    }

    public function login(): void {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["data"])) {
            $email = $_POST["data"]["email"] ?? '';
            $password = $_POST["data"]["password"] ?? '';

            // Validar
            $emailValido = Utils::validarEmail($email);
            if ($emailValido !== true) $errores["email"] = $emailValido;

            if (empty($password)) {
                $errores["password"] = "La contraseña es obligatoria.";
            }

            if (empty($errores)) {
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

                    if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
                        // Crear una cookie que expire en 7 días
                        $cookie_name = "remember_me";
                        $cookie_value = $identity->id; 
                        $cookie_expire = time() + (7 * 24 * 60 * 60); // 7 días
                        setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
                        setcookie("remember_me", $identity->id, time() + (7 * 24 * 60 * 60), "/");
                    }

                    header("Location:" . base_url);
                    exit();
                } else {
                    $errores["login"] = "Credenciales incorrectas.";
                }
            }
        }

        $this->pages->render("usuario/login", ["errores" => $errores]);
    }

    public function editar(): void {
        if (!isset($_SESSION["identity"])) {
            header("Location: " . base_url . "Usuario/login");
            exit();
        }
        
        $usuario = new Usuario("", "", "", "", "", "");
        $userInfo = $usuario->buscaId($_SESSION["identity"]->id);
        
        $this->pages->render("usuario/editar", ["usuario" => $userInfo]);
    }
    
    public function update(): void {
        $errores = [];
        
        if (!isset($_SESSION["identity"])) {
            header("Location: " . base_url . "Usuario/login");
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["data"])) {
            $userData = $_POST["data"];
            
            //Validar
            $nombreValido = Utils::validarNombre($userData["nombre"]);
            if ($nombreValido !== true) $errores["nombre"] = $nombreValido;
    

            if (!empty($userData["apellidos"])) {
                $apellidosValido = Utils::validarNombre($userData["apellidos"]); 
                if ($apellidosValido !== true) $errores["apellidos"] = $apellidosValido;
            }
            
            $emailValido = Utils::validarEmail($userData["email"]);
            if ($emailValido !== true) $errores["email"] = $emailValido;
            

            if ($emailValido === true) {
                $usuario = Usuario::createEmpty();
                $existeEmail = $usuario->buscaMail($userData["email"]);
                if ($existeEmail && $existeEmail->id != $_SESSION["identity"]->id) {
                    $errores["email"] = "Este email ya está registrado por otro usuario";
                }
            }
            
            if (!empty($userData["password"]) && isset($userData["confirm_password"]) && $userData["password"] !== $userData["confirm_password"]) {
                $errores["confirm_password"] = "Las contraseñas no coinciden";
            }
            
            if (empty($errores)) {
                $usuario = new Usuario(
                    $_SESSION["identity"]->id,
                    $userData["nombre"],
                    $userData["apellidos"] ?? $_SESSION["identity"]->apellidos,
                    $userData["email"],
                    !empty($userData["password"]) ? password_hash($userData["password"], PASSWORD_BCRYPT, ["cost" => 4]) : $_SESSION["identity"]->password,
                    $_SESSION["identity"]->rol
                );
                
                $updated = $usuario->update();
                
                if ($updated) {
                    $_SESSION["identity"] = $usuario->buscaId($_SESSION["identity"]->id);
                    $_SESSION["update_success"] = "Tus datos han sido actualizados correctamente";
                    header("Location: " . base_url);
                    exit();
                } else {
                    $_SESSION["update_error"] = "Error al actualizar tus datos. Por favor, inténtalo de nuevo.";
                }
            }
            
            $userForView = (object)$userData;
            $userForView->id = $_SESSION["identity"]->id;
            if (!isset($userData["apellidos"])) {
                $userForView->apellidos = $_SESSION["identity"]->apellidos;
            }
            
            $this->pages->render("usuario/editar", [
                "errores" => $errores, 
                "usuario" => $userForView
            ]);
        } else {
            $usuario = Usuario::createEmpty();
            $userInfo = $usuario->buscaId($_SESSION["identity"]->id);
            
            $this->pages->render("usuario/editar", ["usuario" => $userInfo]);
        }
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