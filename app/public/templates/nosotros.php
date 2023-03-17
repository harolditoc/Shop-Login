<?php  

  include "../../auth/routes.php";
  routeAcceso::sesiones();
  $local = 'nosotros.php';

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
?>
<body>
<?php 

  if(empty($_SESSION['logged'])){
    include "../../templates/header.php"; 

?>

    <div class="cover d-flex justify-content-center align-items-center flex-column" style="background-image:url(https://la.louisvuitton.com/content/dam/lv/online/stories/art-and-culture/U_AC_Manufactures_LP.html/jcr:content/assets/HARDCOVER_MANUFACTURES_3360x840_DIE.jpg?imwidth=2048);"> 
    <h1>MISION</h1>
    <br>
    <br>

    <h4>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
    orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
  orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!</h4>
  
  </div>
  <div class="cover d-flex justify-content-center align-items-center flex-column" style="background-image:url(https://www.prada.com/content/dam/pradanux/pradasphere/2022/fashion-shows/fw2022_womenswear/asset_2/hero_banner_big_TB.jpg/_jcr_content/renditions/cq5dam.web.1280.1280.webp

  );"> 
    <h1>VISION</h1>
      <br>
    <br>
    <h4>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
    orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
  orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!</h4> 
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
    $datLogged = $_SESSION['logged'];
    include "../../templates/headerlog.php"; 
?>
  <!-- Contenido login -->
  <div class="cover d-flex justify-content-center align-items-center flex-column" style="background-image:url(https://la.louisvuitton.com/content/dam/lv/online/stories/art-and-culture/U_AC_Manufactures_LP.html/jcr:content/assets/HARDCOVER_MANUFACTURES_3360x840_DIE.jpg?imwidth=2048);"> 
    <h1>MISION</h1>
    <br>
    <br>

    <h4>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
    orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
  orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!</h4>
  
  </div>
  <div class="cover d-flex justify-content-center align-items-center flex-column" style="background-image:url(https://www.prada.com/content/dam/pradanux/pradasphere/2022/fashion-shows/fw2022_womenswear/asset_2/hero_banner_big_TB.jpg/_jcr_content/renditions/cq5dam.web.1280.1280.webp

  );"> 
    <h1>VISION</h1>
      <br>
    <br>
    <h4>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
    orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!
  orem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat alias ducimus, nisi numquam dolor, ea, molestiae, quibusdam nostrum aspernatur nobis dicta. Recusandae incidunt fuga tempore qui nihil dolor! Officiis, ab!</h4> 
  </div>

<?php 
    include "../../templates/footer.php";
  }
?>
</body>
</html>