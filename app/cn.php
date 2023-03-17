<?php
  class conexion{

    public $con;

    public function conectar(){
      $this->con = mysqli_connect("190.234.201.126:3306","pTienda","pTienda","ptienda");
    }
    
  }
?>