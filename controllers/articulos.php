<?php
    require_once('fpdf/fpdf.php');
    require_once('class/mi_pdf.php');
    class Articulos Extends Controller {

        function __construct() {

            parent ::__construct();
            
            
        }

        function render() {

            session_start();

            $articulos = $this->model->get();
            $this->view->articulos = $articulos;
            $this->view->cabecera = $this->model->cabeceraTabla();
            

            $this->view->render('articulos/index');
        }

        function create() {
            session_start();

            $articulos = $this->model->get();
            $this->view->articulos = $articulos;
            $this->view->cabecera = $this->model->cabeceraTabla();

            if (!isset($this->view->articulo)) $this->view->articulo = null;

            $this->view->render('articulos/create/index');

        }
        
        function edit($param) {
            session_start();

            $this->view->id = $param[0];
            
            $this->view->articulo = $this->model->getArticulo($this->view->id);
            $this->view->articulo["id"] = $param[0];
            
            // var_dump($this->view->articulo);
            // exit(0);
            
            $articulos = $this->model->get();
            $this->view->articulos = $articulos;
            $this->view->cabecera = $this->model->cabeceraTabla();
            
            $this->view->render('articulos/edit/index');
        }
        
        function show($param = null) {
            session_start();
            
            $this->view->id = $param[0];

            $this->view->articulo = $this->model->getArticulo($param[0]);
            $this->view->articulo["id"] = $param[0];

            if (!isset($this->view->articulo)) $this->view->articulo = null;
            $this->view->render('articulos/show/index');
        }

        function delete($param) {
            session_start();
            
            $this->model->delete($param[0]);
            
            $articulos = $this->model->get();
            $this->view->datos = $articulos;
            
            $this->view->render('articulos/index');
        }

        function registrar() {
            # Sanear datos $_POST del formulario
    
            $articulo = 
            [
                'nombre'     => filter_var($_POST['nombre'], FILTER_SANITIZE_STRING),
                'precio'    => filter_var($_POST['precio'], FILTER_SANITIZE_STRING),
                'modificado'    => filter_var($_POST['modificado'], FILTER_SANITIZE_SPECIAL_CHARS),
                'imagen'          => $_FILES['imagen']
                
            ];
    
            // var_dump($articulo);
            // exit(0);
    
            # Validar datos del formulario
    
            $errores = array();
    
            # Valiar descripción
            if (empty($articulo['nombre'])) {
                $errores['nombre'] = "Campo obligatorio";
            }
    
            # Validar precio
            if (empty($articulo['precio'])) {
                $errores['precio'] = "Campo obligatorio";
            } else if (!filter_var($articulo['precio'], FILTER_VALIDATE_FLOAT)) {
                $errores['precio'] = "Valor no permitido";
    
            }
    
            # Validar modificado
            if (empty($articulo['modificado'])) {
                $errores['modificado'] = "Campo obligatorio";
            } else if (!filter_var($articulo['modificado'], FILTER_SANITIZE_STRING)) {
                $errores['modificado'] = "Valor no permitido";
    
            }
    
            # Validar stock con rango
            $options = array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => 1000,
                )
            );
           
            
    
    
    
            # Validar categoria_id con rango
            $options = array(
                'options' => array(
                    'min_range' => 1,
                    'max_range' => 10,
                )
            );
            
            // if (!filter_var($articulo['categoria_id'], FILTER_VALIDATE_INT, $options)) {
            //     $errores['categoria_id'] = "Valor fuera de rango";
            // }
    
            # Validar imagen jpg, gif, png
    
    
            # Comprobamos antes si ha ocurrido algún error en la subida de archivo
    
            $FileUploadErrors = array(
                0 => 'No hay error, fichero subido con éxito.',
                1 => 'El fichero subido excede la directiva upload_max_filesize de php.ini.',
                2 => 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.',
                3 => 'El fichero fue sólo parcialmente subido.',
                4 => 'No se subió ningún fichero.',
                6 => 'Falta la carpeta temporal.',
                7 => 'No se pudo escribir el fichero en el disco.',
                8 => 'Una extensión de PHP detuvo la subida de ficheros.',
            );
            
            if (($articulo['imagen']['error'] !== UPLOAD_ERR_OK )) {
                
                $errores['imagen'] = $FileUploadErrors[$articulo['imagen']['error']];
                
            }  else 
            
            if (is_uploaded_file($articulo['imagen']['tmp_name'])) {
    
                $info = new SplFileInfo($articulo['imagen']['tmp_name']);
                
                # Validamos tamaño máximo 2MB personalizado
                # MAX_FILE_SIZE hace la misma validación con HTML
                $max_tamano = 2 * 1024 * 1024;
                
                if ($info->getSize() > $max_tamano ) {
                    $errores['imagen'] = "Tamaño de archivo no permitido. Máximo 2MB";
                }
    
                # Validamos el tipo
                $info = new SplFileInfo($articulo['imagen']['name']);
                $tipos_permitidos =['jpeg', 'JPEG','jpg', 'JPG', 'gif', 'GIF',  'png', 'PNG'];
                
                if (!in_array ($info->getExtension(), $tipos_permitidos )) {
                    $errores['imagen'] = "Tipo no permitido. Sólo JPG, PNG y GIF";
                }
                
            }
    
            if (!empty($errores)) {
                // var_dump($errores);
                // exit(0);
                # Datos no validados
                $this->view->errores = $errores;
                $this->view->mensaje = "Errores en el formulario.";
                $this->view->articulo = $articulo;
                $this->create();
    
                
            } else {
    
                # Datos validados: insertamos registros y movemos imagen 
                move_uploaded_file($articulo['imagen']['tmp_name'],"imagenes/".$articulo['imagen']['name']);
                
                # Actualizo el campo imagen con name
                $articulo['imagen'] = $articulo['imagen']['name'];
        
                # La función insert devuelve el mensaje resultante de añadir el registro
                $mensaje=$this->model->insert($articulo);
                
                $this->view->mensaje = $mensaje;
    
                $articulos = $this->model->get();
                $this->view->articulos = $articulos;
                $this->view->cabecera = $this->model->cabeceraTabla();
    
                $this->view->render('articulos/index');
                
            } 
        }
        
        function actualizar() {
            # Sanear datos $_POST del formulario
            $articulo = 
            [
                'id'     => $_POST['id'],
                'nombre'     => filter_var($_POST['nombre'], FILTER_SANITIZE_STRING),
                'precio'    => filter_var($_POST['precio'], FILTER_SANITIZE_STRING),
                'modificado'    => filter_var($_POST['modificado'], FILTER_SANITIZE_SPECIAL_CHARS),
                'imagen'          => $_FILES['imagen']
                
            ];
            
            // var_dump($articulo['imagen']);
            // exit(0);
            // var_dump($_REQUEST['id']);
            // exit(0);
    
            # Validar datos del formulario
    
            $errores = array();
    
            if (empty($articulo['id'])) {
                $errores['id'] = "No recoge el ID";
            }
    
            # Valiar descripción
            if (empty($articulo['nombre'])) {
                $errores['nombre'] = "Campo obligatorio";
            }
    
            # Validar precio
            if (empty($articulo['precio'])) {
                $errores['precio'] = "Campo obligatorio";
            } else if (!filter_var($articulo['precio'], FILTER_VALIDATE_FLOAT)) {
                $errores['precio'] = "Valor no permitido";
    
            }
    
            # Validar modificado
            if (empty($articulo['modificado'])) {
                $errores['modificado'] = "Campo obligatorio";
            } else if (!filter_var($articulo['modificado'], FILTER_SANITIZE_STRING)) {
                $errores['modificado'] = "Valor no permitido";
    
            }
    
            # Comprobamos antes si ha ocurrido algún error en la subida de archivo
    
            $FileUploadErrors = array(
                0 => 'No hay error, fichero subido con éxito.',
                1 => 'El fichero subido excede la directiva upload_max_filesize de php.ini.',
                2 => 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.',
                3 => 'El fichero fue sólo parcialmente subido.',
                4 => 'No se subió ningún fichero.',
                6 => 'Falta la carpeta temporal.',
                7 => 'No se pudo escribir el fichero en el disco.',
                8 => 'Una extensión de PHP detuvo la subida de ficheros.',
            );
            
            if (($articulo['imagen']['error'] !== UPLOAD_ERR_OK )) {
                
                $errores['imagen'] = $FileUploadErrors[$articulo['imagen']['error']];
                
            }  else 
            
            if (is_uploaded_file($articulo['imagen']['tmp_name'])) {
    
                $info = new SplFileInfo($articulo['imagen']['tmp_name']);
                
                # Validamos tamaño máximo 2MB personalizado
                # MAX_FILE_SIZE hace la misma validación con HTML
                $max_tamano = 2 * 1024 * 1024;
                
                if ($info->getSize() > $max_tamano ) {
                    $errores['imagen'] = "Tamaño de archivo no permitido. Máximo 2MB";
                }
    
                # Validamos el tipo
                $info = new SplFileInfo($articulo['imagen']['name']);
                $tipos_permitidos =['jpeg', 'JPEG','jpg', 'JPG', 'gif', 'GIF',  'png', 'PNG'];
                
                if (!in_array ($info->getExtension(), $tipos_permitidos )) {
                    $errores['imagen'] = "Tipo no permitido. Sólo JPG, PNG y GIF";
                }
                
            }
    
            if (!empty($errores)) {
                // var_dump($errores);
                // exit(0);
                # Datos no validados
                $this->view->errores = $errores;
                $this->view->mensaje = "Errores en el formulario.";
                $this->view->articulo = $articulo;
                $this->edit();
    
                
            } else {
    
                # Datos validados: insertamos registros y movemos imagen 
                move_uploaded_file($articulo['imagen']['tmp_name'],"imagenes/".$articulo['imagen']['name']);
                
                # Actualizo el campo imagen con name
                $articulo['imagen'] = $articulo['imagen']['name'];
                
                # La función insert devuelve el mensaje resultante de añadir el registro
                $mensaje=$this->model->update($articulo);
    
                $articulos = $this->model->get();
                $this->view->articulos = $articulos;
    
                $this->view->cabecera = $this->model->cabeceraTabla();
                
                $this->view->mensaje = $mensaje;
                $this->view->render('articulos/index');
                
            } 
        }

        public function imprimir_pdf(){
            $pdf = new mi_pdf();
            $pdf->Addpage();
            $pdf->SetFont('Helvetica', '', 10);
    
            $pdf-> Cabecera_archivos();
    
            $archivos = $this->model->get();
            $total_capacidad = 0;
            $altura = 20;
    
            foreach($archivos as $i => $archivo){
                $altura = $altura + 8.5;
                $pdf->Cell(10,8,utf8_decode($archivo->id),0,0);
    
                $pdf->Cell(60,8,utf8_decode($archivo->nombre),0,0);
    
                $pdf->Cell(20,8,utf8_decode($archivo->precio.' eur'),0,0);

                $pdf->Cell(50,8,utf8_decode($archivo->modificado),0,0);

                $pdf->Cell(50,8,$pdf->Image('imagenes/'.$archivo->imagen, 155, $altura, 4, 0),0,1);

                // $pdf->Image('imagenes/'.$archivo->imagen, 10, 10, 10, 0, 'png');

            }
    
            $pdf->Cell(45,10,utf8_decode('Número de artículos: '), 'T', 0);
            $pdf->Cell(45,10,utf8_decode($i+1), 'T', 0);
            $pdf->Cell(90,8,utf8_decode(''), 'T', 1, 'R');
    
            $pdf->Output('I', 'articulos.pdf');
        }
    }
    
?>