<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
          <li class="nav-item dropdown">
            <a class="nav-link navbar-toggler dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Bienvenido <?php echo ucfirst($datLogged->getNombre()); ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Carrito</a></li>
              <li><a class="dropdown-item" href="#">Mis Compras</a></li>
              <li><hr class="dropdown-divider"></li>
              <!---Cerrar sesion --->
              <li>
                <a class="dropdown-item">
                  <form action='<?php echo routeAcceso::puertaAcceso($local); ?>'>
                    <input type="hidden" name="logout" value="true">
                    <button class="btn">Cerrar Sesion</button>
                  </form>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </form>
    </div>
  </nav>
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="background: darkgrey;">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="5000"> <!-- 5 segundos -->
        <h2 class="text-center text-white">Bienvenidos cliente</h2>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <h2 class="text-center text-white">Descuentos por ser cliente del 20%</h2>
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
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body cuerpo">
    <div class="main">    
    <input type="checkbox" id="chk" aria-hidden="true">

      <div class="signup">
        <form>
          <label for="chk" aria-hidden="true">Sign up</label>
          <input type="text" name="txt" placeholder="Usuario" required="">
          <input type="email" name="email" placeholder="Email" required="">
          <input type="password" name="pswd" placeholder="Contraseña" required="">
          <button class="botoneslog">Sign up</button>
        </form>
      </div>

      <div class="login">
        <form>
          <label for="chk" aria-hidden="true">Login</label>
          <input type="email" name="email" placeholder="Email" required="">
          <input type="password" name="pswd" placeholder="Contraseña" required="">
          <button class="botoneslog">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>

