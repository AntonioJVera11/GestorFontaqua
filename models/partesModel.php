<?php 

    class partesModel extends Model {

        public function __construct() {

            parent::__construct();
            
        }

        public function get() {
            try {
                $consultaSQL = "SELECT * FROM partes ORDER BY id";
    
                $pdo = $this->db->connect();
    
                $stmt = $pdo->prepare($consultaSQL);
                $stmt->setFetchMode(PDO::FETCH_OBJ);
    
                $stmt->execute();
    
                $articulos = $stmt->fetchAll();
    
                return $articulos;
                
            } catch(PDOException $e) {
    
                $error = 'Error al leer registros '.$e->getMessage().' en la línea '.$e->getLine();
    
            }
        }

        public function getCategorias() {
            try {
                $consultaSQL = "SELECT * FROM categorias ORDER BY id";
    
                $pdo = $this->db->connect();
                $stmt = $pdo->prepare($consultaSQL);
                $stmt->setFetchMode(PDO::FETCH_OBJ);
    
                $stmt->execute();
    
                return $stmt;
                
            } catch(PDOException $e) {
    
                $error = 'Error al leer registros '.$e->getMessage().' en la línea '.$e->getLine();
    
            }
        }

        public function insert($articulo) {

            try 
            {
            
                $insertSQL =" INSERT INTO articulos (nombre, precio, imagen, modificado, stock,  imagen)
                VALUES (:nombre, :precio, :imagen, :modificado, :stock, :imagen)";
    
                $pdo = $this->db->connect();
                $pdoStmt = $pdo->prepare($insertSQL);
    
                $pdoStmt->bindParam(':nombre', $articulo['nombre'], PDO::PARAM_STR, 50);
                $pdoStmt->bindParam(':precio', $articulo['precio']);
                $pdoStmt->bindParam(':imagen', $articulo['imagen'], PDO::PARAM_STR, 50);
                $pdoStmt->bindParam(':modificado', $articulo['modificado'], PDO::PARAM_STR);
        
                $pdoStmt->execute();
    
                return 'Registro Añadido Con Éxito';
                    
            } 
    
            catch (PDOException $e) 
            {
            
                $error = 'Error al añadir registro: ' . $e->getMessage() . " en la línea: " . $e->getLine();
                return $error;
            }
    
            
        }
        
        public function cabeceraTabla() {
            $cabecera = [
                "Id",
                "Nombre",
                "Obra",
                "Coste",
                "Ingreso",
                "Fecha Comienzo",
                "Fecha Final"
            ];

            return $cabecera;
        }

    }
?>  