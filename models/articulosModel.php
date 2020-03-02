<?php 

    class articulosModel extends Model {

        public function __construct() {

            parent::__construct();
            
        }

        public function get() {
            try {
                $consultaSQL = "SELECT * FROM articulos ORDER BY id";
    
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

        public function getArticulo($id){
            try{ 
                $sql = "SELECT * FROM articulos WHERE id = :id LIMIT 1";
                $pdo = $this->db->connect();
                $stmt = $pdo->prepare($sql);
                
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                
                $articulos = $stmt->fetch();
                // $articulos["id"] = $id;
                
                // var_dump($articulos['nombre']);
                // exit(0);

            return $articulos;
            }
                
            catch (PDOException $e){
            
            exit($e->getMessage());
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
            try {
            
                $insertSQL =" INSERT INTO articulos
                VALUES (null, :nombre, :precio, :modificado, :imagen)";
    
                $pdo = $this->db->connect();
                $pdoStmt = $pdo->prepare($insertSQL);
    
                $pdoStmt->bindParam(':nombre', $articulo['nombre'], PDO::PARAM_STR, 50);
                $pdoStmt->bindParam(':precio', $articulo['precio']);
                $pdoStmt->bindParam(':modificado', $articulo['modificado'], PDO::PARAM_STR);
                $pdoStmt->bindParam(':imagen', $articulo['imagen'], PDO::PARAM_STR, 50);
        
                $pdoStmt->execute();
    
                return 'Registro Añadido Con Éxito';
                    
            } catch (PDOException $e) {
            
                $error = 'Error al añadir registro: ' . $e->getMessage() . " en la línea: " . $e->getLine();
                return $error;
            }
        }

        public function delete($id) {
            try {
            
                $deleteSQL ="DELETE FROM articulos WHERE id = :id";
    
                $pdo = $this->db->connect();
                $pdoStmt = $pdo->prepare($deleteSQL);
    
                $pdoStmt->bindParam(':id', $id, PDO::PARAM_INT);
        
                $pdoStmt->execute();
    
                return 'Registro borrado Con Éxito';
                    
            } catch (PDOException $e) {
            
                $error = 'Error al borrar registro: ' . $e->getMessage() . " en la línea: " . $e->getLine();
                return $error;
            }
        }

        public function update($articulo) {
            // $id = $articulo["id"];
            // var_dump($articulo);
            // exit(0);
            try {
                $updateSQL ="UPDATE articulos SET
                nombre = :nombre,
                precio = :precio,
                modificado = :modificado,
                imagen = :imagen
                WHERE id = :id";
    
                $pdo = $this->db->connect();
                $stmt = $pdo->prepare($updateSQL);
                
                $stmt->bindParam(':id', $articulo['id'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre', $articulo['nombre'], PDO::PARAM_STR, 50);
                $stmt->bindParam(':precio', $articulo['precio']);
                $stmt->bindParam(':modificado', $articulo['modificado'], PDO::PARAM_STR);
                $stmt->bindParam(':imagen', $articulo['imagen'], PDO::PARAM_STR, 50);
        
                $stmt->execute();
    
                return 'Registro actualizado Con Éxito';
                    
            } catch (PDOException $e) {
            
                $error = 'Error al actualizar el registro: ' . $e->getMessage() . " en la línea: " . $e->getLine();
                return $error;
            }
        }

        public function ordenar($param) {
            $articulo = $param[0];
        }
        
        public function cabeceraTabla() {

            $cabecera = [
                "Id",
                "Nombre",
                "Precio",
                "Última Modificación",
                "Imagen"
            ];

            return $cabecera;
        }

    }
?>  