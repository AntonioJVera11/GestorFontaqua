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

    function updatePass($id, $pass){
        try{
            $password_encriptado = password_hash($pass, CRYPT_BLOWFISH);
            $updateSQL = "
                UPDATE users SET password = :pass WHERE id = :id
            ";
            $pdo = $this->db->connect();
            $pdoStmt = $pdo->prepare($updateSQL);
            $pdoStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoStmt->bindParam(':pass', $password_encriptado, PDO::PARAM_STR);
            $pdoStmt->execute();
            return ["Contraseña actualizada", "success"];
        } catch (PDOException $e) {
            $error = 'Error al actualizar contraseña: ' . $e->getMessage() . " en la línea: " . $e->getLine();
            return [$error, 'danger'];
        }

    }

    function insertRol ($user_id , $rol_id) {
        try {
            $insertSQL ="
    
                INSERT INTO roles_users
                VALUES (null, :user_id, :rol_id, null, null)";
    
                $pdo = $this->db->connect();
                $pdoStmt = $pdo->prepare($insertSQL);
    
                $pdoStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $pdoStmt->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
                
    
                $pdoStmt->execute();
    
                return 'Registro Añadido Con Éxito';
            } catch (PDOException $e) {
                $error = 'Error al añadir registro: ' . $e->getMessage() . " en la línea: " . $e->getLine();
                return [$error, 'danger'];
            }
    }

    function getUsuario($id){
        
        $selectSQL = "
            SELECT * FROM users WHERE id = :id LIMIT 1;
        ";
        $pdo = $this->db->connect();
        $pdoStmt = $pdo->prepare($selectSQL);
        $pdoStmt->bindParam(':id', $id, PDO::PARAM_STR, 50);

        $pdoStmt->execute();

        $usuario = $pdoStmt->fetch();
        return $usuario;
    }

    function getRol($id){
        $selectSQL = "
        SELECT roles_users.role_id, roles.name FROM roles_users INNER JOIN roles ON roles.id = roles_users.role_id WHERE roles_users.user_id = :id LIMIT 1;";
        $pdo = $this->db->connect();
        $pdoStmt = $pdo->prepare($selectSQL);
        $pdoStmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $pdoStmt->setFetchMode(PDO::FETCH_ASSOC);

        $pdoStmt->execute();

        $rol = $pdoStmt->fetch();
        return $rol;
    }

    function updateUser($id, $name, $email){
        try{
            $updateSQL = "
                UPDATE users SET name = :name, email = :email WHERE id = :id
            ";
            $pdo = $this->db->connect();
            $pdoStmt = $pdo->prepare($updateSQL);
            $pdoStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdoStmt->bindParam(':name', $name, PDO::PARAM_STR);
            $pdoStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $pdoStmt->execute();
            return ["Usuario actualizado", "success"];
        } catch (PDOException $e) {
            $error = 'Error al actualizar contraseña: ' . $e->getMessage() . " en la línea: " . $e->getLine();
            return [$error, 'danger'];
        }

    }
}

?>