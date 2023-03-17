<header>
  <nav class="navbar navbar-light">
    <div class="container" >
      <a class="nav-link text-black" href="/pTienda_2/app/public/templates/index.php"><img src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="50" height="40" class="d-inline-block align-text-top"><h6>LOGO</h6></a>
      <form class="d-flex">
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="nav-link active navbar-toggler" aria-current="page" href="/pTienda_2/app/public/templates/index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-toggler" href="/pTienda_2/app/public/templates/nosotros.php">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-toggler" href="/pTienda_2/app/public/templates/productos.php">Productos</a>
          </li>
          <!-- <li class="nav-item">
            <select class="form-select" aria-label="select example" enable>
              <option selected>////////////////</option>
              <option value="1">Mis compras</option>
              <option value="2">Carrito</option>
            </select>
          </li> -->
          <li class="nav-item">
            <a class="nav-link navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" href="#" tabindex="-1" aria-disabled="true"><i class="fa fa-user"></i></a>
          </li>
        </ul>
      </form>
    </div>
  </nav>
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="background: darkgrey;">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="5000"> <!-- 5 segundos -->
        <h2 class="text-center text-white">Bienvenidos a tienda</h2>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <h2 class="text-center text-white">Descuentos del 10%</h2>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <h2 class="text-center text-white">Envios gratis a lima</h2>
      </div>
    </div>
  </div>
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Se parte de nosotros</h5>
    <button type="button" class="btn-close text-reset boton" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body login-emerg">
    <div class="register-ses">    
    <input type="checkbox" id="chk" aria-hidden="true">
      <div class="inicio-ses">
        <form action="<?php echo routeAcceso::puertaAcceso($local); ?>" method="POST">
          <label for="chk" aria-hidden="true" class="titulo-ses">Sign up</label>
          <input type="hidden" name="logval" value="intentoLog">
          <input type="text" name="nombre" placeholder="Nombre" class="inputs-log" required="">
          <select class="inputs-select" name="tdocumento" required="">
            <option value="dni" selected>DNI</option>
            <option value="carnet de extranjeria">Carnet de extranjeria</option>
          </select>
          <input type="text" name="numdocumento" placeholder="# Documento" class="inputs-log" required="">
          <input type="text" name="direccion" placeholder="Direccion" class="inputs-log" required="">
          <input type="text" name="numtelefono" placeholder="# telefono" class="inputs-log" required="">
          <input type="email" name="correo" placeholder="Email" class="inputs-log" required="">
          <input type="password" name="contrasena" placeholder="Contraseña" class="inputs-log" required="">
          <button class="botoneslog boton">Sign up</button>
        </form>
      </div>

      <div class="login">
        <form action="<?php echo routeAcceso::puertaAcceso($local); ?>" method="POST">
          <label for="chk" aria-hidden="true" class="titulo-ses">Login</label>
          <input type="email" name="email" placeholder="Email" class="inputs-log" required="">
          <input type="password" name="pswd" placeholder="Contraseña" class="inputs-log" required="">
          <button class="botoneslog boton">Login</button>   
        </form>
      </div>
    </div>
  </div>
</div>

