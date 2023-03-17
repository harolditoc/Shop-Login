<?php 

	include "../routes.php";

	routeAcceso::sesiones();

	# $pruebaVar = new persona('natural', 'hernando', 'dni', '72270745', 'los lirios', 917456951, 'loslirio@mail.com', 'Pollitoconpapa');

	# persona::guardarPersona($pruebaVar);

	# persona::eliminarPersona('loslirio@mail.com','Pollitoconpapa');

	# echo persona::validacionAcceso('loslirios@mail.com', 'Pollitoconpapa');

	# $pruebaVar = new usuario('101', 'hernando', 'dni', '72270745', 'los lirios', 917456951, 'loslirio@mail.com', 'Pollitoconpapa', '1');

	# echo usuario::guardarUsuario($pruebaVar);	

	# echo $pruebaVar->getNombre();

	# $varPru = new usuario();

	# echo $varPru->obtenerId_final(); 

	# var_dump(rol::obtener_Todo());

	# echo usuario::validacionAcceso('loslirio@mail.com', 'Pollitoconpapa');

	# var_dump(controlAcceso::registroWeb($pruebaVar));

	# var_dump(controlAcceso::validacionAcceso('loslirio@mail.com', 'Pollitoconpapa'));

	## Probando enrutameinto

	#  Primero, cuando + producto -> se crea una instancia en venta con estado cero

	# Cuando se concreta la venta -> cambiar el estado y reducir el stock (Update)
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Prueba</title>
</head>
<body>

	<form action="<?php echo routeAcceso::puertaPrincipal(); ?>" method="POST">

		<input type="text" name="usu" placeholder="Usuario">
		<br>
		<br>
		<input type="password" name="con" placeholder="Contraseña">
		<br>
		<br>
		<button type="submit">Hacer</button>

	</form>
	<br>
	<form action='<?php echo routeAcceso::puertaPrincipal(); ?>' method="POST">
		<input type="hidden" name="logout" value="true">
		<button>Log out</button>
	</form>
</body>
</html>

<?php 

	if(!empty($_POST['usu']) and !empty($_POST['con'])){
		echo routeAcceso::login($_POST['usu'], $_POST['con']);
	}

	if(!empty($_SESSION['logged'])){
		# Cargar datos web - sesion iniciada
		var_dump($_SESSION['logged']);
	}

	if(!empty($_POST['logout'])){
		if($_POST['logout']){
			routeAcceso::logOut();
		}
	}

?>