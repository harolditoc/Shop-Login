<?php  
  include "../../auth/routes.php";
  routeAcceso::sesiones();
  $local = 'productos.php';

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
<html>

<?php  
  $title = "Tiendaonline | Bienvenidos a nuestra Tienda Online";
  $cssprincipal = "../../static/css/index.css";
  $csssecundario = "../../static/css/header.css";
  $cssterceario = "../../static/css/footer.css";
	include "../../templates/head.php";
  $aux = new articuloControlador();
  $aux2 = $aux->mostrarControlador();
?>
<body>
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
            <img src="https://global.tommy.com/tommy-global-images/FW19_TJ_DEL-2_UNI_01_300_39L-3.jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://media.revistagq.com/photos/61e83211acd48c90acb49c65/16:9/w_2560%2Cc_limit/Louis%2520Vuitton%2520y%2520Nike%2520Air%2520Force%25201%2520por%2520Virgil%2520Abloh%2520(1).jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://aefirenze.it/images/blog/eccellenze-guccio-gucci.jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
        </div>
      
      </div>
      <div  class="container mt-2 mb-2">
        <div class="row">
          <div class="col">
            <img src="https://mms.businesswire.com/media/20210806005470/es/739318/5/Script.PMS280-01.jpg?download=1" class="rounded mx-auto d-block cover-small" alt="...">
          </div>
          <div class="col">
           <img src="https://global.tommy.com/tommy-global-images/about-us/_size_1404x766/corporate-responsibility-preview.png" class="rounded mx-auto d-block c
          </div>
          <div class="col">
            <img src="https://www.marshopping.com/matosinhos/-/media/images/b2c/portugal/matosinhos/images-stores/springfield/springfield-logo-410x282.ashx?h=282&iar=0&mw=650&w=410&hash=CA80F11FFB9EAC77B02F9564D8D76AD0" class="rounded mx-auto d-block cover-small" alt="...">
          </div>
        </div>
      </div>
  </div>
    <div>
    <div class="fondo-marca">
      <div class="container cardshorizontal flex-column">
        <div class="row mt-5 mb-5">
          <?php foreach ($aux2 as $res) { ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 product">
              <img class="cover-smallp col-12" src="<?php echo $res->getImagen(); ?>" alt="">
              <h3 class="d-flex justify-content-center align-items-center mt-2"><?php echo $res->getNombre(); ?></h3>
              <span class="d-flex justify-content-center align-items-center mb-2">S/.<?php echo $res->getPrecio_venta();?></span>
              <button class="btn btn-lg btn-secondary mt-2 col-12">Añadir al carrito <i class="fas fa-cart-plus"></i></button>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
<?php 
    if(!empty($_POST['email']) and !empty($_POST['pswd'])){
      echo '<script language="javascript">alert("'.$auxlog.'"); </script>';
    }

    if(!empty($_POST['logval'])){
      echo '<script language="javascript">alert("'.$auxreg.'"); </script>';
    }
  } else {
    $datLogged = $_SESSION['logged'];
    include "../../templates/headerlog.php"; 
?>
  <!--- Contenido comprado --->
  <div class="container mt-5">      
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://global.tommy.com/tommy-global-images/FW19_TJ_DEL-2_UNI_01_300_39L-3.jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://media.revistagq.com/photos/61e83211acd48c90acb49c65/16:9/w_2560%2Cc_limit/Louis%2520Vuitton%2520y%2520Nike%2520Air%2520Force%25201%2520por%2520Virgil%2520Abloh%2520(1).jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://aefirenze.it/images/blog/eccellenze-guccio-gucci.jpg" class="d-block w-100 cover cover-small" alt="...">
          </div>
        </div>
      
      </div>
      <div  class="container mt-2 mb-2">
        <div class="row">
          <div class="col">
            <img src="https://mms.businesswire.com/media/20210806005470/es/739318/5/Script.PMS280-01.jpg?download=1" class="rounded mx-auto d-block cover-small" alt="...">
          </div>
          <div class="col">
           <img src="https://global.tommy.com/tommy-global-images/about-us/_size_1404x766/corporate-responsibility-preview.png" class="rounded mx-auto d-block cover-small" alt="...">
          </div>
          <div class="col">
            <img src="https://www.marshopping.com/matosinhos/-/media/images/b2c/portugal/matosinhos/images-stores/springfield/springfield-logo-410x282.ashx?h=282&iar=0&mw=650&w=410&hash=CA80F11FFB9EAC77B02F9564D8D76AD0" class="rounded mx-auto d-block cover-small" alt="...">
          </div>
        </div>
      </div>
  </div>
<?php 
  }
  include "../../templates/footer.php";
?>
</body>
</html>