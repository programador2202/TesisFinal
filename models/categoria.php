<?php

require_once "../config/Conexion.php";
class categoria {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    // Obtener todas las categorías
    public function getAll() {
        $stmt = $this->conexion->prepare("SELECT * FROM CATEGORIA");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una categoría por ID
    public function getById($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM CATEGORIA WHERE idcategoria = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una nueva categoría
    public function create($nombre) {
        $stmt = $this->conexion->prepare("INSERT INTO CATEGORIA (nombre) VALUES (?)");
        return $stmt->execute([$nombre]);
    }

    // Actualizar una categoría
    public function update($id, $nombre) {
        $stmt = $this->conexion->prepare("UPDATE CATEGORIA SET nombre = ? WHERE idcategoria = ?");
        return $stmt->execute([$nombre, $id]);
    }

    // Eliminar una categoría
    public function delete($id) {
        $stmt = $this->conexion->prepare("DELETE FROM CATEGORIA WHERE idcategoria = ?");
        return $stmt->execute([$id]);
    }
}
?>
