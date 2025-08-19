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

  //crear un nuevo restaurante
  //nom_restaurante,descripcion,direccion,telefono
  public function create($nom_restaurante,$descripcion, $direccion, $telefono){
    $stmt = $this->conexion->prepare("INSERT INTO RESTAURANTES (nom_restaurante, descripcion, direccion, telefono) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom_restaurante, $descripcion, $direccion, $telefono]);
    return $stmt->rowCount() > 0;
  }

  //actualizar un restaurante
  public function update($id, $nom_restaurante, $descripcion, $direccion, $telefono){
    $stmt = $this->conexion->prepare("UPDATE RESTAURANTES SET nom_restaurante = ?, descripcion = ?, direccion = ?, telefono = ? WHERE idrestaurante = ?");
    $stmt->execute([$nom_restaurante, $descripcion, $direccion, $telefono, $id]);
    return $stmt->rowCount() > 0;
  }

  //eliminar un restaurante
  public function delete($id){
    $stmt = $this->conexion->prepare("DELETE FROM RESTAURANTES WHERE idrestaurante = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
  }
  //Métodos para obtener información específica del restaurante
  public function getDetails() {
    $stmt = $this->conexion->prepare("SELECT * FROM RESTAURANTES");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }


}
?>