<?php

   # PHP Mailer
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';
   
    Class registro_email extends PHPMailer {

        function __construct($name, $email, $pass, $rol) {

            parent::__construct();

            # Propiedades de mi clase email
            $this->destinatario = $email;
            $this->asunto ="Registro en la Base de Datos de Fontaqua";
            
            # Cuerpo del mensaje
            $this->mensaje = "
            <p>Hola $name:</p>
            <p>Su registro en la web de <b>Fontaqua</b> ha resultado exitoso. Con motivo de dejar constancia de su cuenta, le facilitamos en este correo sus datos: </p>
            <ul>
                <li>Nombre de usuario: $name </li>
                <li>Correo Electrónico:  $email </li>
                <li>Password: $pass</li>
                <li>Rol del usuario: $rol</li>
            </ul>
            <p>Antonio Vera Rodríguez, departamento de Administración de <b>Fontaqua.</b></p>
            ";


            # configuración resto de parámetros
            $this->CharSet = "UTF-8";
            $this->Encoding = "quoted-printable";

            $this->SMTPDebug = false;
            $this->do_debug = 0;
            $this->isSMTP(); 

            //Server settings smtp gthis
            //Nos vamos a el perfil de la cuenta de gthis
            //Activamos la opción de seguridad autentificación a 2 pasos
            //Generamos una contraseña Temporal
            //Dicha contraseña la pegamos en la propiedad Password
            
            $this->Username = 'arevmedia98@gmail.com';                
            $this->Password = 'uxhnsqmozitvnved'; 

            $this->SMTPDebug = 0; 
            $this->SMTPSecure = 'tls'; 
            $this->Host = 'smtp.gmail.com'; 
            $this->Port = 587;                               
                                                
            $this->SMTPAuth = true;   

        }

        function enviar_email() {

            $this->setFrom ($this->destinatario); 
            $this->addAddress ($this->destinatario); 
            $this->Subject = $this->asunto;
            $this->isHTML(true);

            $this->Body = $this->mensaje;

            $mensaje = null;
            try {
                $this->send(); 

            } 	catch (Exception $e) {

                $mensaje='Message could not be sent. thiser Error: '. $this->ErrorInfo;

            }

            return $mensaje;


        }
    }

    Class modificacion_email extends PHPMailer {

        function __construct($name, $email) {

            parent::__construct();

            # Propiedades de mi clase email
            $this->destinatario = $email;
            $this->asunto ="Modificación de su perfil en la app Fontaqua";
            
            # Cuerpo del mensaje
            $this->mensaje = "
            <p>Hola $name:</p>
            <p>Le mandamos este mensaje para confirmarle que los datos de su cuenta en la app Fontaqua han sido actualizados. Sus nuevos datos son: </p>
            <ul>
                <li>Nombre de usuario: $name </li>
                <li>Correo Electrónico:  $email </li>
            </ul>
            <p>Antonio Vera Rodríguez, departamento de Administración de <b>Fontaqua.</b></p>
            ";


            # configuración resto de parámetros
            $this->CharSet = "UTF-8";
            $this->Encoding = "quoted-printable";

            $this->SMTPDebug = false;
            $this->do_debug = 0;
            $this->isSMTP(); 

            //Server settings smtp gthis
            //Nos vamos a el perfil de la cuenta de gthis
            //Activamos la opción de seguridad autentificación a 2 pasos
            //Generamos una contraseña Temporal
            //Dicha contraseña la pegamos en la propiedad Password
            
            $this->Username = 'arevmedia98@gmail.com';                
            $this->Password = 'uxhnsqmozitvnved'; 

            $this->SMTPDebug = 0; 
            $this->SMTPSecure = 'tls'; 
            $this->Host = 'smtp.gmail.com'; 
            $this->Port = 587;                               
                                                
            $this->SMTPAuth = true;   

        }

        function enviar_email() {

            $this->setFrom ($this->destinatario); 
            $this->addAddress ($this->destinatario); 
            $this->Subject = $this->asunto;
            $this->isHTML(true);

            $this->Body = $this->mensaje;

            $mensaje = null;
            try {
                $this->send(); 

            } 	catch (Exception $e) {

                $mensaje='Message could not be sent. thiser Error: '. $this->ErrorInfo;

            }

            return $mensaje;


        }
    }

    Class pass_email extends PHPMailer {

        function __construct($name, $email, $pass) {

            parent::__construct();

            # Propiedades de mi clase email
            $this->destinatario = $email;
            $this->asunto ="Cambio de contraseña";
            
            # Cuerpo del mensaje
            $this->mensaje = "
            <p>Hola $name</p>
            <p>Le mandamos este mensaje para confirmarle que los datos de su cuenta en la app Fontaqua han sido actualizados. Sus datos son:</p>
            <ul>
                <li>Nombre de usuario:  $name </li>
                <li>Correo electrónico:  $email </li>
                <li>Nueva contraseña:  $pass </li>
            </ul>
            <p>Antonio Vera Rodríguez, departamento de Administración de <b>Fontaqua.</b></p>
            ";


            # configuración resto de parámetros
            $this->CharSet = "UTF-8";
            $this->Encoding = "quoted-printable";

            $this->SMTPDebug = false;
            $this->do_debug = 0;
            $this->isSMTP(); 

            //Server settings smtp gthis
            //Nos vamos a el perfil de la cuenta de gthis
            //Activamos la opción de seguridad autentificación a 2 pasos
            //Generamos una contraseña Temporal
            //Dicha contraseña la pegamos en la propiedad Password
            
            $this->Username = 'arevmedia98@gmail.com';                
            $this->Password = 'uxhnsqmozitvnved'; 

            $this->SMTPDebug = 0; 
            $this->SMTPSecure = 'tls'; 
            $this->Host = 'smtp.gmail.com'; 
            $this->Port = 587;                               
                                                
            $this->SMTPAuth = true;   

        }

        function enviar_email() {

            $this->setFrom ($this->destinatario); 
            $this->addAddress ($this->destinatario); 
            $this->Subject = $this->asunto;
            $this->isHTML(true);

            $this->Body = $this->mensaje;

            $mensaje = null;
            try {
                $this->send(); 

            } 	catch (Exception $e) {

                $mensaje='Message could not be sent. thiser Error: '. $this->ErrorInfo;

            }

            return $mensaje;


        }
    }
?>