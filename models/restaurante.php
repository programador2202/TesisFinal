<?php
require_once "../config/Conexion.php";

class Restaurante {
  private $conexion;


  public function __construct(){
    $this ->conexion =conexion::getConexion();
  }
  public function getAll(){
    $stmt =$this->conexion->prepare("SELECT  r.idrestaurante, r.nom_restaurante, r.img, r.descripcion, r.direccion, r.telefono,
                       c.nombre AS categoria
                FROM RESTAURANTES r
                INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria");
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
  //nom_restaurante,img,descripcion,direccion,telefono
  public function create($nom_restaurante,$img,$descripcion, $direccion, $telefono,$idcategoria){
    $stmt = $this->conexion->prepare("INSERT INTO RESTAURANTES (nom_restaurante, img,descripcion, direccion, telefono,idcategoria) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->execute([$nom_restaurante, $img, $descripcion, $direccion, $telefono,$idcategoria]);
    return $stmt->rowCount() > 0;
  }

  //actualizar un restaurante
public function update($id, $nom_restaurante, $img, $descripcion, $direccion, $telefono, $idcategoria){
    $stmt = $this->conexion->prepare("UPDATE RESTAURANTES 
        SET nom_restaurante = ?, img = ?, descripcion = ?, direccion = ?, telefono = ?, idcategoria=? 
        WHERE idrestaurante = ?");
    $stmt->execute([$nom_restaurante, $img, $descripcion, $direccion, $telefono, $idcategoria, $id]);
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
  // Obtener una categoría por ID
    public function getCategorias($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM CATEGORIA WHERE idcategoria = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  //obtener categoria de Comida Oriental
   public function ListaOriental() {
    $stmt = $this->conexion->prepare("
        SELECT 
            r.idrestaurante,
            r.nom_restaurante,
            r.img,
            r.descripcion,
            r.direccion,
            r.telefono,
            c.nombre AS categoria
        FROM RESTAURANTES r
        INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
        WHERE r.idcategoria = 1
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


 public function ListaHamburguesas() {
    $stmt = $this->conexion->prepare("
        SELECT 
            r.idrestaurante,
            r.nom_restaurante,
            r.img,
            r.descripcion,
            r.direccion,
            r.telefono,
            c.nombre AS categoria
        FROM RESTAURANTES r
        INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
        WHERE r.idcategoria = 2
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 public function ListaMarisco() {
    $stmt = $this->conexion->prepare("
        SELECT 
            r.idrestaurante,
            r.nom_restaurante,
            r.img,
            r.descripcion,
            r.direccion,
            r.telefono,
            c.nombre AS categoria
        FROM RESTAURANTES r
        INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
        WHERE r.idcategoria = 4
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 public function ListaPollerias() {
    $stmt = $this->conexion->prepare("
        SELECT 
            r.idrestaurante,
            r.nom_restaurante,
            r.img,
            r.descripcion,
            r.direccion,
            r.telefono,
            c.nombre AS categoria
        FROM RESTAURANTES r
        INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
        WHERE r.idcategoria = 3
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 public function ListaPizzeria() {
    $stmt = $this->conexion->prepare("
        SELECT 
            r.idrestaurante,
            r.nom_restaurante,
            r.img,
            r.descripcion,
            r.direccion,
            r.telefono,
            c.nombre AS categoria
        FROM RESTAURANTES r
        INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
        WHERE r.idcategoria = 10
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 public function ListaCafePastel() {
    $stmt = $this->conexion->prepare("
        SELECT 
            r.idrestaurante,
            r.nom_restaurante,
            r.img,
            r.descripcion,
            r.direccion,
            r.telefono,
            c.nombre AS categoria
        FROM RESTAURANTES r
        INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
        WHERE r.idcategoria = 8
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 public function ListaParrilla() {
    $stmt = $this->conexion->prepare("
        SELECT 
            r.idrestaurante,
            r.nom_restaurante,
            r.img,
            r.descripcion,
            r.direccion,
            r.telefono,
            c.nombre AS categoria
        FROM RESTAURANTES r
        INNER JOIN CATEGORIA c ON r.idcategoria = c.idcategoria
        WHERE r.idcategoria = 9
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>