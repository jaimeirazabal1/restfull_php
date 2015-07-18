<?php 
class Usuario extends Mysqli{
	public function __construct(){
		parent::__construct("localhost",'root','','restFull');
	}
	public function listar(){
		$resultado = $this->query("SELECT * from usuario");
		if (!count($this->error_list)) {
			while ($fila = $resultado->fetch_assoc()) {
				$filas[]=$fila;
			}
			return isset($filas) ? $filas : array();
		}
		$this->mostrarErrores();
		return false;
	}
	public function crear($nombre, $apellido, $fecha_nacimiento){
		$this->query("INSERT INTO usuario (nombre, apellido, fecha_nacimiento) VALUES ('$nombre', '$apellido', '$fecha_nacimiento')");
		if (!count($this->error_list)) {
			return true;
		}
		$this->mostrarErrores();
		return false;
	}
	public function editar($id, $nombre, $apellido, $fecha_nacimiento){
		$this->query("UPDATE usuario set nombre='$nombre', apellido='$apellido', fecha_nacimiento='$fecha_nacimiento' where id = '$id'");
		if (!count($this->error_list)) {
			return true;
		}
		$this->mostrarErrores();
		return false;
	}
	public function eliminar($id){
		$this->query("DELETE from usuario where id = '$id'");
		if (!count($this->error_list)) {
			return true;
		}
		$this->mostrarErrores();
		return false;
	}
	public function mostrarErrores(){
		if (count($this->error_list)) {
			foreach ($this->error_list as $key => $value) {
				echo $value['error']."<br>";
			}
		}
	}
	public function run(){

		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				echo json_encode($this->listar());
				break;
			case 'POST':
				echo json_encode($this->crear($_POST['nombre'],$_POST['apellido'],$_POST['fecha_nacimiento']));
				break;
			case 'PUT':
				parse_str(file_get_contents('php://input'), $vars);
				echo json_encode($vars);
				break;
			case 'DELETE':
				parse_str(file_get_contents('php://input'), $vars);
				echo json_encode($vars);
				break;
			default:
				# code...
				break;
		}
	}
}
$usuario = new Usuario();
$usuario->run();
 ?>