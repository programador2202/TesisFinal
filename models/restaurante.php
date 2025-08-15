<?php
require_once "../config/Conexion.php";

class Restaurante {
  private $conexion;


  public function __construct(){
    $this ->conexion =conexion::getConexion();
  }
  public function getAll(){
    $stmt =$this->conexion->prepare("SELECT * FROM RESTAURANTES");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  //obtener un restaurante por su ID
  public function getById($id){
    $stmt = $this ->conexion -> prepare("SELECT *FROM RESTAURANTES WHERE idrestaurante= ? ");
    $stmt->execute([$id]);
    return $stmt ->fetch(PDO::FETCH_ASSOC);
  }


  //Métodos para manejar la información del restaurante
  //Ejemplo: obtener detalles del restaurante, horarios, ubicación, etc.
}
?>