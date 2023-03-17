<?php 

	include 'models.php';

	class routeAcceso extends controlAcceso{

		# Ruta de Control de Acceso
		public static function puertaPrincipal(){
			$direccion = "testingPage.php";
			return $direccion;
		}

		public static function puertaAcceso($localizacion){
			$aux_loc = $localizacion;
			return $aux_loc;
		}	
		# Inicio de sesion php / Opcional

		public static function sesiones(){

			if (!isset($_SESSION)) {
			  	session_start(); # Se inicia el control de sesiones
			}
		}

		# Login

		public static function login($email, $password){
			$datlog = controlAcceso::validacionAcceso($email, $password);
			if (is_object($datlog)) {
				routeAcceso::cargarLog($datlog);
				$msg = 'Contraseña correcta';
				return $msg;
			} else {
				switch ($datlog) {
					case 1:
						$msg = 'Contraseña Incorrecta';
						return $msg;

					case 2:
						$msg = 'Correo no registrado';
						return $msg;
			
					default:
						$msg = 'Error encontrado, comunicarse con un administrador';
						return $msg;
				}
			}
		}

		public static function cargarLog($log){
			
			if(!isset($_SESSION['logged'])){

				$_SESSION['logged'] = $log;

			} else {

				# Sin numero de excepciones inusuales / Nose puede loguear si una entidad ya esta logueada
				header('Refresh:0');
				
			}
		}

		public static function logOut(){
			session_unset();
			header("Location:index.php");
			die();
		}

		public static function registro($nombre, $tipo_documento, $num_doc, $direccion, $telefono, $email, $contrasena){
			$pruebaVar = new persona('natural', $nombre, $tipo_documento, $num_doc, $direccion, $telefono, $email, $contrasena);
			$datlog = controlAcceso::registroWeb($pruebaVar);
			if (is_object($datlog)) {
				routeAcceso::cargarLog($datlog);
				$msg = 'Registro correcto';
				return $msg;
			} else {
				switch ($datlog) {
					case 1:
						$msg = 'Correo ya registrado';
						return $msg;

					case 2:
						$msg = 'Documento de identidad ya registrado';
						return $msg;
			
					default:
						$msg = 'Error encontrado, comunicarse con un administrador';
						return $msg;
				}
			}
		}

	}

	class articuloControlador extends articuloModelo{
		public function mostrarControlador(){
			$articulo2 = articuloModelo::mostrarArticulo();
			return $articulo2;
		}
	}
?>