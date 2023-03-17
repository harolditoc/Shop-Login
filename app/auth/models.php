<?php 
	
	# Listado de clases (modelos) usados en una tienda...
	
	# Conexion al servidor MySQL-MariaDB

	include "$_SERVER[DOCUMENT_ROOT]/pTienda_2/app/cn.php";

	# Clases

	# Usuarios externos...

	class persona extends conexion{

		# Atributos - Privados

		private $idpersona;
		private $tipo_persona;
		private $nombre;
		private $tipo_documento;
		private $num_documento;
		private $direccion;
		private $telefono;
		private $email;
		private $password;

		# Getters and Setters - Accesos a atributos al inicializar la clase

		public function getIdpersona(){
				return $this->idpersona;
		}

		public function setIdpersona($idpersona){
				$this->idpersona = $idpersona;
		}

		public function getTipo_persona(){
				return $this->tipo_persona;
		}

		public function setTipo_persona($tipo_persona){
				$this->tipo_persona = $tipo_persona;
		}

		public function getNombre(){
				return $this->nombre;
		}

		public function setNombre($nombre){
				$this->nombre = $nombre;
		}

		public function getTipo_documento(){
				return $this->tipo_documento;
		}

		public function setTipo_documento($tipo_documento){
				$this->tipo_documento = $tipo_documento;
		}

		public function getNum_documento(){
				return $this->num_documento;
		}

		public function setNum_documento($num_documento){
				$this->num_documento = $num_documento;
		}

		public function getDireccion(){
				return $this->direccion;
		}

		public function setDireccion($direccion){
				$this->direccion = $direccion;
		}

		public function getTelefono(){
				return $this->telefono;
		}

		public function setTelefono($telefono){
				$this->telefono = $telefono;
		}

		public function getEmail(){
				return $this->email;
		}

		public function setEmail($email){
				$this->email = $email;
		}

		public function getPassword(){
				return $this->password;
		}

		public function setPassword($password){
				$this->password = $password;
		}

		public function __construct(){ 
			$params = func_get_args();
			$num_params = func_num_args();
			$funcion_contructor = '__construct'.$num_params;
			if(method_exists($this, $funcion_contructor)){
				call_user_func_array(array($this, $funcion_contructor), $params);
			}
		}

		# Funciones DB...

			# Funciones Estaticas

			public static function guardarPersona(persona $nuevaPersona){
				$conc = new conexion();
				$conc->conectar();

				# Recibiendo variables
				$aux_Idpersona = $nuevaPersona->getIdpersona();
				$aux_Tipo_persona = $nuevaPersona->getTipo_persona();
				$aux_Nombre = $nuevaPersona->getNombre();
				$aux_Tipo_documento = $nuevaPersona->getTipo_documento();
				$aux_Num_documento = $nuevaPersona->getNum_documento();
				$aux_Direccion = $nuevaPersona->getDireccion();
				$aux_Telefono = $nuevaPersona->getTelefono();
				$aux_Email = $nuevaPersona->getEmail();
				$aux_Password = $nuevaPersona->getPassword();

				# Validando existencia(Correo o Documento de identidad)

				if(empty(persona::buscarEmail($aux_Email)) and empty(persona::buscarDocumento($aux_Num_documento))){
					$pre = mysqli_prepare($conc->con, "INSERT INTO persona VALUES(?,?,?,?,?,?,?,?,?)");
					$pre->bind_param('isssssiss', $aux_Idpersona, $aux_Tipo_persona, $aux_Nombre, $aux_Tipo_documento, $aux_Num_documento, $aux_Direccion, $aux_Telefono, $aux_Email, $aux_Password);
					$pre->execute();
					# Registrado correctamente
					return 0;
				} else {
					# Correo ya registrado o documento de identidad existente
					if(!empty(persona::buscarEmail($aux_Email))){
						# Correo ya registrado
						return 1;
					} elseif (!empty(persona::buscarDocumento($aux_Num_documento))) {
						# Documento de identidad ya registrado
						return 2;
					} else {
						# Se desconoce la excepcion
						return false;
					}
				}
			}

			public static function buscarEmail($email){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM persona WHERE email = ?");
				$pre->bind_param('s', $email);
				$pre->execute();
				$res = $pre->get_result();
				$personas = [];
				while($per = $res->fetch_object(persona::class)){
					array_push($personas, $per);
				}
				return $personas;
			}

			public static function buscarDocumento($documento){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM persona WHERE num_documento = ?");
				$pre->bind_param('s', $documento);
				$pre->execute();
				$res = $pre->get_result();
				$personas = [];
				while($per = $res->fetch_object(persona::class)){
					array_push($personas, $per);
				}
				return $personas;
			}

			public static function validacionAcceso($email, $password){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM persona WHERE email = ?");
				$pre->bind_param('s', $email);
				$pre->execute();
				$res = $pre->get_result();
				$personas = [];
				while($per = $res->fetch_object(persona::class)){
					array_push($personas, $per);
				}
				if(!empty($personas)){
					$aux_contrasena = $personas[0]->getPassword();
					if(password_verify($password, $aux_contrasena)){
						# Contraseña correcta
						return 0;
					} else {
						# Contraseña incorrecta
						return 1;
					}
				} else {
					# Correo no registrado
					return 2;
				}
			}

			public static function eliminarPersona($email, $password){
				$var_val = persona::validacionAcceso($email, $password);
				if($var_val == 0){
					$conc = new conexion();
					$conc->conectar();
					$pre = mysqli_prepare($conc->con, "DELETE FROM persona WHERE email = ?");
					$pre->bind_param('s', $email);
					$pre->execute();
					return 0;
				} else {
					return 1;
				}
			}

			# Funciones internas

			public function obtenerId_final(){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM persona ORDER BY idpersona DESC LIMIT 1");
				$pre->execute();
				$res = $pre->get_result();
				$personas = [];
				while($per = $res->fetch_object(persona::class)){
					array_push($personas, $per);
				}
				return $personas[0]->idpersona;
			}

		# Constructores...

		public function __construct0(){ }

		
		public function __construct8($tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $password){ 
			$aux_persona = new persona();
			$new_id = $aux_persona->obtenerId_final();
			$this->idpersona = $new_id+1;
			$this->tipo_persona = $tipo_persona;
			$this->nombre = $nombre;
			$this->tipo_documento = $tipo_documento;
			$this->num_documento = $num_documento;
			$this->direccion = $direccion;
			$this->telefono = $telefono;
			$this->email = $email;
			$this->password = password_hash($password, PASSWORD_DEFAULT);
		}

	}

	# Usuarios internos...

	class rol extends conexion{
		private $idrol;
		private $nombre;
		private $descripcion;
		private $estado;

		# Getters and Setters - Accesos a atributos al inicializar la clase

		public function getIdrol(){
				return $this->idrol;
		}

		public function setIdrol($idrol){
				$this->idrol = $idrol;
		}

		public function getNombre(){
				return $this->nombre;
		}

		public function setNombre($nombre){
				$this->nombre = $nombre;
		}

		public function getDescripcion(){
				return $this->descripcion;
		}

		public function setDescripcion($descripcion){
				$this->descripcion = $descripcion;
		}

		public function getEstado(){
				return $this->estado;
		}

		public function setEstado($estado){
				$this->estado = $estado;
		}

		public function __construct(){ 
			$params = func_get_args();
			$num_params = func_num_args();
			$funcion_contructor = '__construct'.$num_params;
			if(method_exists($this, $funcion_contructor)){
				call_user_func_array(array($this, $funcion_contructor), $params);
			}
		}

		# Funciones DB...

			# Funciones estaticas

			public static function obtener_Todo(){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM rol ORDER BY idrol ASC");
				$pre->execute();
				$res = $pre->get_result();
				$roles = [];
				while($rol = $res->fetch_object(rol::class)){
					array_push($roles, $rol);
				}
				return $roles;
			}

		# Constructores...

		public function __construct0(){ }

	}

	class usuario extends conexion{
		private $idusuario;
		private $rol_idrol;
		private $nombre;
		private $tipo_documento;
		private $num_documento;
		private $direccion;
		private $telefono;
		private $email;
		private $password;
		private $estado;

		# Getters and Setters - Accesos a atributos al inicializar la clase

		public function getIdusuario(){
				return $this->idusuario;
		}

		public function setIdusuario($idusuario){
				$this->idusuario = $idusuario;
		}

		public function getRol_idrol(){
				return $this->rol_idrol;
		}

		public function setRol_idrol($rol_idrol){
				$this->rol_idrol = $rol_idrol;
		}

		public function getNombre(){
				return $this->nombre;
		}

		public function setNombre($nombre){
				$this->nombre = $nombre;
		}

		public function getTipo_documento(){
				return $this->tipo_documento;
		}

		public function setTipo_documento($tipo_documento){
				$this->tipo_documento = $tipo_documento;
		}

		public function getNum_documento(){
				return $this->num_documento;
		}

		public function setNum_documento($num_documento){
				$this->num_documento = $num_documento;
		}

		public function getDireccion(){
				return $this->direccion;
		}

		public function setDireccion($direccion){
				$this->direccion = $direccion;
		}

		public function getTelefono(){
				return $this->telefono;
		}

		public function setTelefono($telefono){
				$this->telefono = $telefono;
		}

		public function getEmail(){
				return $this->email;
		}

		public function setEmail($email){
				$this->email = $email;
		}

		public function getPassword(){
				return $this->password;
		}

		public function setPassword($password){
				$this->password = $password;
		}

		public function getEstado(){
				return $this->estado;
		}

		public function setEstado($estado){
				$this->estado = $estado;
		}

		public function __construct(){ 
			$params = func_get_args();
			$num_params = func_num_args();
			$funcion_contructor = '__construct'.$num_params;
			if(method_exists($this, $funcion_contructor)){
				call_user_func_array(array($this, $funcion_contructor), $params);
			}
		}

		# Funciones DB...

			# Funciones estaticas

			public static function guardarUsuario(usuario $nuevoUsuario){
				$conc = new conexion();
				$conc->conectar();

				# Recibiendo variables
				$aux_Idusuario = $nuevoUsuario->getIdusuario();
				$aux_Rol_idrol = $nuevoUsuario->getRol_idrol();
				$aux_Nombre = $nuevoUsuario->getNombre();
				$aux_Tipo_documento = $nuevoUsuario->getTipo_documento();
				$aux_Num_documento = $nuevoUsuario->getNum_documento();
				$aux_Direccion = $nuevoUsuario->getDireccion();
				$aux_Telefono = $nuevoUsuario->getTelefono();
				$aux_Email = $nuevoUsuario->getEmail();
				$aux_Password = $nuevoUsuario->getPassword();
				$aux_estado = $nuevoUsuario->getEstado();

				# Validando existencia(Correo o Documento de identidad)

				if(empty(usuario::buscarEmail($aux_Email)) and empty(usuario::buscarDocumento($aux_Num_documento))){
					$pre = mysqli_prepare($conc->con, "INSERT INTO usuario VALUES(?,?,?,?,?,?,?,?,?,?)");
					$pre->bind_param('iissssissi', $aux_Idusuario, $aux_Rol_idrol, $aux_Nombre, $aux_Tipo_documento, $aux_Num_documento, $aux_Direccion, $aux_Telefono, $aux_Email, $aux_Password, $aux_estado);
					$pre->execute();
					# Registrado correctamente
					return 0;
				} else {
					# Correo ya registrado o documento de identidad existente
					if(!empty(usuario::buscarEmail($aux_Email))){
						# Correo ya registrado
						return 1;
					} elseif (!empty(usuario::buscarDocumento($aux_Num_documento))) {
						# Documento de identidad ya registrado
						return 2;
					} else {
						# Se desconoce la excepcion
						return 3;
					}
				}
			}

			public static function buscarEmail($email){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM usuario WHERE email = ?");
				$pre->bind_param('s', $email);
				$pre->execute();
				$res = $pre->get_result();
				$usuarios = [];
				while($usu = $res->fetch_object(usuario::class)){
					array_push($usuarios, $usu);
				}
				return $usuarios;
			}

			public static function buscarDocumento($documento){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM usuario WHERE num_documento = ?");
				$pre->bind_param('s', $documento);
				$pre->execute();
				$res = $pre->get_result();
				$usuarios = [];
				while($usu = $res->fetch_object(usuario::class)){
					array_push($usuarios, $usu);
				}
				return $usuarios;
			}

			public static function validacionAcceso($email, $password){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM usuario WHERE email = ?");
				$pre->bind_param('s', $email);
				$pre->execute();
				$res = $pre->get_result();
				$usuarios = [];
				while($usu = $res->fetch_object(usuario::class)){
					array_push($usuarios, $usu);
				}
				if(!empty($usuarios)){
					$aux_contrasena = $usuarios[0]->getPassword();
					if(password_verify($password, $aux_contrasena)){
						# Contraseña correcta
						return 0;
					} else {
						# Contraseña incorrecta
						return 1;
					}
				} else {
					# Correo no registrado
					return 2;
				}
			}

			# Funciones internas

			public function obtenerId_final(){
				$conc = new conexion();
				$conc->conectar();
				$pre = mysqli_prepare($conc->con, "SELECT * FROM usuario ORDER BY idusuario DESC LIMIT 1");
				$pre->execute();
				$res = $pre->get_result();
				$usuarios = [];
				while($usu = $res->fetch_object(persona::class)){
					array_push($usuarios, $usu);
				}
				return $usuarios[0]->idusuario;
			}

		# Constructores...

		public function __construct0(){ }

		public function __construct9($rol_idrol, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $password, $estado){ 
			$aux_usuario = new usuario();
			$new_id = $aux_usuario->obtenerId_final();
			$this->idusuario = $new_id+1;
			$this->rol_idrol = $rol_idrol;
			$this->nombre = $nombre;
			$this->tipo_documento = $tipo_documento;
			$this->num_documento = $num_documento;
			$this->direccion = $direccion;
			$this->telefono = $telefono;
			$this->email = $email;
			$this->password = password_hash($password, PASSWORD_DEFAULT);
			$this->estado = $estado;
		}
	}


	# Clase controladora de acceso de usuarios internos y externoss sobre el aplicativo web

	class controlAcceso{
		
		# Registro
		# Reibe una clase (Usuario O persona) ->registroWeb(Usuario) /// $params =>> [Usuario] = Params[0]
		public static function registroWeb(){
			$params = func_get_args();
			if($params[0] instanceof usuario){

				$aux_Idusuario = $params[0]->getIdusuario();
				$aux_Rol_idrol = $params[0]->getRol_idrol();
				$aux_Nombre = $params[0]->getNombre();
				$aux_Tipo_documento = $params[0]->getTipo_documento();
				$aux_Num_documento = $params[0]->getNum_documento();
				$aux_Direccion = $params[0]->getDireccion();
				$aux_Telefono = $params[0]->getTelefono();
				$aux_Email = $params[0]->getEmail();
				$aux_Password = $params[0]->getPassword();
				$aux_estado = $params[0]->getEstado();

				if(!empty(persona::buscarEmail($aux_Email)) and empty(persona::buscarDocumento($aux_Num_documento))){
					# Si existe en persona, solo se registra en usuario...
					$valReg = usuario::guardarUsuario($params[0]);
					switch ($valReg) {
						case 0:
							$entUsu = usuario::buscarEmail($aux_Email);
							return $entUsu[0];

						default:
							return $valReg; 
					}
				} else {
					# Si no existe primero se debera registar en persona...
					$auxVar = new persona('natural', $aux_Nombre, $aux_Tipo_documento, $aux_Num_documento, $aux_Direccion, $aux_Telefono, $aux_Email, $aux_Password);
					$auxVar->setPassword($aux_Password); # Contraseña original
					persona::guardarPersona($auxVar);
					$valReg = usuario::guardarUsuario($params[0]);
					switch ($valReg) {
						case 0:
							$entUsu = usuario::buscarEmail($aux_Email);
							return $entUsu[0];

						default:
							return $valReg; 
					}
				}
			} elseif ($params[0] instanceof persona){
				# Registro de persona externa a la organizacion
				$aux_Email = $params[0]->getEmail();
				$valReg = persona::guardarPersona($params[0]);
				switch ($valReg) {
						case 0:
							$entPer = persona::buscarEmail($aux_Email);
							return $entPer[0];

						default:
							return $valReg; 
				}
			} else {
				# Excepcion capturada no definida
				return 3;
			}
		}

		public static function validacionAcceso($email, $password){
			# Validar que no sea un usuario interno
			$valUsu = usuario::validacionAcceso($email, $password);
			switch ($valUsu) {
				case 0:
					$entUsu = usuario::buscarEmail($email);
					return $entUsu[0];
				case 2:
					$valPer = persona::validacionAcceso($email, $password);
					switch ($valPer) {
						case 0:
							$entPer = persona::buscarEmail($email);
							return $entPer[0];
						default:
							return $valPer;
					}
					break;
				default:
					return $valUsu;
			}
		}	
	}

	# Productos...

	class categoria extends conexion{
		private $idcategoria;
		private $nombre;
		private $descripcion;
		private $estado;
	}

	class articulo{
		private $idarticulo;
		private $categoria_idcategoria;
		private $codigo;
		private $nombre;
		private $precio_venta;
		private $stock;
		private $descripcion;
		private $imagen;
		private $estado;

		public function getIdarticulo(){
				return $this->idarticulo;
		}

		public function setIdarticulo($idarticulo){
				$this->idarticulo = $idarticulo;
		}

		public function getCategoria_idcategoria(){
				return $this->categoria_idcategoria;
		}

		public function setCategoria_idcategoria($categoria_idcategoria){
				$this->categoria_idcategoria = $categoria_idcategoria;
		}

		public function getCodigo(){
				return $this->codigo;
		}

		public function setCodigo($codigo){
				$this->codigo = $codigo;
		}

		public function getNombre(){
				return $this->nombre;
		}

		public function setNombre($nombre){
				$this->nombre = $nombre;
		}

		public function getPrecio_venta(){
				return $this->precio_venta;
		}

		public function setPrecio_venta($precio_venta){
				$this->precio_venta = $precio_venta;
		}

		public function getStock(){
				return $this->stock;
		}

		public function setStock($stock){
				$this->stock = $stock;
		}

		public function getDescripcion(){
				return $this->descripcion;
		}

		public function setDescripcion($descripcion){
				$this->descripcion = $descripcion;
		}

		public function getImagen(){
				return $this->imagen;
		}

		public function setImagen($imagen){
				$this->imagen = $imagen;
		}

		public function getEstado(){
				return $this->estado;
		}

		public function setEstado($estado){
				$this->estado = $estado;
		}
	}

	class articuloModelo extends conexion{
		public static function mostrarArticulo(){
			$conc = new conexion();
			$conc->conectar();
			$pre = mysqli_prepare($conc->con, "SELECT * FROM articulo");
			$pre->execute();
			$res = $pre->get_result();
			$articulos = [];
			while($art = $res->fetch_object(articulo::class)){
				array_push($articulos, $art);
			}
			return $articulos; 
		}
	}
	# Reposicion...

	class ingreso{
		private $idingreso;
		private $persona_idpersona;
		private $usuario_idusurio;
		private $tipo_comprobante;
		private $serie_comprobante;
		private $num_comprobante;
		private $fecha;
		private $impuesto;
		private $total;
		private $estado;
	}

	class detalle_ingreso{
		private $iddetalle_ingreso;
		private $ingreso_idingreso;
		private $articulo_idarticulo;
		private $cantidad;
		private $precio;
	}

	# Venta

	class venta{
		private $idventa;
		private $persona_idpersona;
		private $usuario_idusurio;
		private $tipo_comprobante;
		private $serie_comprobante;
		private $num_comprobante;
		private $fecha_hora;
		private $impuesto;
		private $total;
		private $estado;
	}

	class detalle_venta{
		private $iddetalle_venta;
		private $venta_idventa;
		private $articulo_idarticulo;
		private $cantidad;
		private $precio;
		private $descuento;
	}
?>