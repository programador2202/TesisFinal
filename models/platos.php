<?php
require_once "../config/Conexion.php";

class Platos {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    // OBTENER TODOS LOS PLATOS (con datos del restaurante)
    public function getAll() {
        $stmt = $this->conexion->prepare("
            SELECT 
                p.idplatos,
                p.imagen,
                p.nom_platos,
                p.descripcion,
                p.precio,
                p.idrestaurante,
                r.nom_restaurante,
                r.direccion,
                r.telefono
            FROM PLATOS p
            JOIN RESTAURANTES r ON p.idrestaurante = r.idrestaurante
            ORDER BY p.idplatos ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER UN PLATO POR SU ID
    public function getById($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM PLATOS WHERE idplatos = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREAR UN NUEVO PLATO
    public function create($nom_platos, $descripcion, $precio, $idrestaurante, $imagen = null) {
        // Validar que el restaurante exista
        $stmt = $this->conexion->prepare("SELECT idrestaurante FROM RESTAURANTES WHERE idrestaurante = ?");
        $stmt->execute([$idrestaurante]);
        if (!$stmt->fetch()) {
            return ['error' => 'Restaurante no válido'];
        }

        $stmt = $this->conexion->prepare("
            INSERT INTO PLATOS (nom_platos, descripcion, precio, idrestaurante, imagen)
            VALUES (?, ?, ?, ?, ?)
        ");
        if ($stmt->execute([$nom_platos, $descripcion, $precio, $idrestaurante, $imagen])) {
            return ['success' => 'Plato creado correctamente'];
        }
        return ['error' => 'Error al crear el plato'];
    }

    // ACTUALIZAR UN PLATO
    public function update($idplatos, $nom_platos, $descripcion, $precio, $idrestaurante, $imagen = null) {
        // Validar que el restaurante exista
        $stmt = $this->conexion->prepare("SELECT idrestaurante FROM RESTAURANTES WHERE idrestaurante = ?");
        $stmt->execute([$idrestaurante]);
        if (!$stmt->fetch()) {
            return ['error' => 'Restaurante no válido'];
        }

        $stmt = $this->conexion->prepare("
            UPDATE PLATOS 
            SET nom_platos = ?, descripcion = ?, precio = ?, idrestaurante = ?, imagen = ?
            WHERE idplatos = ?
        ");
        if ($stmt->execute([$nom_platos, $descripcion, $precio, $idrestaurante, $imagen, $idplatos])) {
            return ['success' => 'Plato actualizado correctamente'];
        }
        return ['error' => 'Error al actualizar el plato'];
    }

    // ELIMINAR UN PLATO
    public function delete($idplatos) {
        $stmt = $this->conexion->prepare("DELETE FROM PLATOS WHERE idplatos = ?");
        if ($stmt->execute([$idplatos])) {
            return ['success' => 'Plato eliminado correctamente'];
        }
        return ['error' => 'Error al eliminar el plato'];
    }

    public function ListaMariscos() {
    $stmt = $this->conexion->prepare("
            SELECT 
            p.idplatos,
            p.imagen,
            p.nom_platos,
            p.descripcion,
            p.precio,
            p.idrestaurante,
            r.nom_restaurante,
            r.direccion,
            r.telefono
        FROM PLATOS p
        JOIN RESTAURANTES r ON p.idrestaurante = r.idrestaurante
        WHERE p.idrestaurante = 1;
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
