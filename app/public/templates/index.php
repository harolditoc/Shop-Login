<?php 
  include "../../auth/routes.php";
  routeAcceso::sesiones();
  $local = 'index.php';
  
  if(!empty($_POST['email']) and !empty($_POST['pswd'])){
    $auxlog = routeAcceso::login($_POST['email'], $_POST['pswd']);
  }

  if(!empty($_POST['logval'])){
    $nombre = $_POST['nombre'];
    $tipo_documento = $_POST['tdocumento'];
    $num_doc = $_POST['numdocumento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['numtelefono'];
    $email = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $auxreg = routeAcceso::registro($nombre, $tipo_documento, $num_doc, $direccion, $telefono, $email, $contrasena);
  }

  if(!empty($_GET['logout'])){
    if($_GET['logout']){
      routeAcceso::logOut();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<?php
  $title = "Tiendaonline | Bienvenidos a nuestra Tienda Online";
  $cssprincipal = "../../static/css/index.css";
  $csssecundario = "../../static/css/header.css";
  $cssterceario = "../../static/css/footer.css";
  include "../../templates/head.php";
?>  
<body class="body-mod">
<?php
  if(empty($_SESSION['logged'])){
    include "../../templates/header.php";
?>  
      <div class="container mt-5">      
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://edit.org/photos/img/blog/f7f-plantilla-tienda-ropa-editar-gratis.jpg-840.jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://edit.org/photos/img/blog/hrr-plantillas-moda-ropa-complementos-diseno-editar-editable-editor-carteles-marketing-comunicacion-personalizable.jpg-840.jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://volantespublicitarios.info/wp-content/uploads/2018/10/flyer-publicitario-para-ropa-femenina.jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev rounded float-start position-absolute top-50 start-0 translate-middle" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon cover-button " aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next position-absolute top-50 start-100 translate-middle" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon cover-button" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
       <div class="container mt-5 mb-5">
        <img src="https://static.eldiario.es/clip/397f6e34-93b0-40da-be39-00b2abc20e1e_16-9-discover-aspect-ratio_default_0.jpg" class="rounded mx-auto d-block cover-small" alt="...">
      </div>
    </div>
<?php
    include "../../templates/footer.php";
    if(!empty($_POST['email']) and !empty($_POST['pswd'])){
      echo '<script language="javascript">alert("'.$auxlog.'"); </script>';
    }

    if(!empty($_POST['logval'])){
      echo '<script language="javascript">alert("'.$auxreg.'"); </script>';
    }
  } else {
?>
  <!-- Contenido login -->
<?php 
    $datLogged = $_SESSION['logged'];
    include '../templates/indexlog.php';
  }
?>
</body>
</html>

