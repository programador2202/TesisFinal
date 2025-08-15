<?php
require_once "../config/Conexion.php";



class platos {
  private $conexion;




  //OBTENER TODAS LOS PLATOS
  public function __construct(){
    $this ->conexion =conexion::getConexion();
  }

  public function getAll(){
    $stmt =$this->conexion->prepare("SELECT * FROM PLATOS");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
 
  //OBTENER UN PLATO POR SU ID

  public function getById($id){
    $stmt = $this ->conexion -> prepare("SELECT *FROM PLATOS WHERE idplatos= ? ");
    $stmt->execute([$id]);
    return $stmt ->fetch(PDO::FETCH_ASSOC);

 }

 //CREAR UN NUEVO PLATO

 //ACTUALIZAR UN PLATO

 //ELIMINAR UN PLATO


}


?>