<?php

class UserModel extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    function insert($user){
        $password_encriptado = password_hash($user['password'], CRYPT_BLOWFISH);
        
        try {
        $insertSQL = "INSERT INTO users VALUES (null, :nombre, :email, :password, null, null)";

            $pdo = $this->db->connect();
            $pdoStmt = $pdo->prepare($insertSQL);

            $pdoStmt->bindParam(':nombre', $user['nombre'], PDO::PARAM_STR, 50);
            $pdoStmt->bindParam(':email', $user['email'], PDO::PARAM_STR, 50);
            $pdoStmt->bindParam(':password', $password_encriptado, PDO::PARAM_STR, 60);

            $pdoStmt->execute();

			return 'Usuario registrado con éxito. Has recibido un e-mail de confirmación.';
        } catch (PDOException $e) {
            $error = 'Error al añadir registro: ' . $e->getMessage() . " en la línea: " . $e->getLine();
			return $error;
        }


    }

    function getUsuarioEmail($email){
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $pdo = $this->db->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);

        $stmt->execute();

        $usuario = $stmt->fetch();
        return $usuario;
    }
}

?>