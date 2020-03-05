<?php
    require_once("class/registro_email.php");
    class User Extends Controller {

        function __construct() {

            parent ::__construct();

        }

        function render() {
            $this->view->render('user/login/index');
        }


        function register() {
            $this->view->render('user/register/index');
        }

        function validar_acceso() {

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

            $errores = [];
            $user = $this->model->getUsuarioEmail($email);

        
            // var_dump($usuario);
            if (!empty($user)){
                $coincide = password_verify($pass, $user['password']);
                if(!$coincide){
                    $errores['password'] = "La contraseña está incorrecta.";
                }
                

            } else{
                $errores['email'] =  "El email no está registrado.";
            }


            if (!empty($errores)) {
                # Datos no validados
                $this->view->errores = $errores;
                $this->view->mensaje = "Errores en el formulario.";
                $this->view->user = $user;

                $this->render();
            } else {
                session_start();

                $_SESSION["id"] = $user['id'];

                $_SESSION["name"] = $user['name'];

                header('Location: ../articulos');
            }


        }

        function validar_registro(){
            
            $name = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $pass1 = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $pass2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            
            $user = [
                'nombre' => $name,
                'email' => $email,
                'password' => $pass1
            ];

            $errores = array();

            if (empty($user['nombre'])) {
                $errores['nombre'] = "Campo obligatorio";
            }

            if (empty($user['email'])) {
                $errores['email'] = "Campo obligatorio";
            } elseif ($this->model->getUsuarioEmail($email) != false){
                $errores['email'] = "Este Email ya está registrado.";
            }

            if (empty($user['password'])) {
                $errores['password'] = "Campo obligatorio";
            }
            if ($pass1 != $pass2){
                $errores['password'] = "Las contraseñas no son iguales.";
            }

            if (!empty($errores)) {
                
                # Datos no validados
                $this->view->errores = $errores;
                $this->view->mensaje = "Errores en el formulario.";
                $this->view->user = $user;

                $this->register();

                
            } else {

                # La función insert devuelve el mensaje resultante de añadir el registro
                $mensaje=$this->model->insert($user);

                $email = new registro_email($_POST['nombre'], $_POST['email'], $_POST['password']);
		        $email->enviar_email();
                
                $this->view->mensaje = $mensaje;

                $this->render();
                
            } 


        }

        function logout(){
            session_start();
            setcookie("PHPSESSID", "", time() - 3600, "/");
            unset($_SESSION);
            session_unset();
            session_destroy();
            $this->view->render('user/login/index');

        }


    }
