<?php
require_once "../models/categoria.php"; 

header("Content-Type: application/json; charset=UTF-8");

$categoria = new categoria();

$method = $_SERVER['REQUEST_METHOD'];
$task = $_GET['task'] ?? null;

switch ($method) {
    case 'GET':
        if ($task === 'getAll') {
            $data = $categoria->getAll();
            echo json_encode($data);
        } elseif ($task === 'getById' && isset($_GET['idCategoria'])) {
            $data = $categoria->getById($_GET['idCategoria']);
            echo json_encode($data);
        } else {
            echo json_encode(["success" => false, "message" => "Tarea GET no válida"]);
        }
        break;

    case 'POST':

        $input = json_decode(file_get_contents("php://input"), true);
        $task = $input['task'] ?? null;

        if ($task === 'create') {
            $nombre = $input['categoria'] ?? '';
            if ($nombre && $categoria->create($nombre)) {
                echo json_encode(["success" => true, "message" => "Categoría creada con éxito"]);
            } else {
                echo json_encode(["success" => false, "message" => "No se pudo crear la categoría"]);
            }
        } elseif ($task === 'update') {
            $id = $input['idCategoria'] ?? null;
            $nombre = $input['categoria'] ?? '';
            if ($id && $nombre && $categoria->update($id, $nombre)) {
                echo json_encode(["success" => true, "message" => "Categoría actualizada con éxito"]);
            } else {
                echo json_encode(["success" => false, "message" => "No se pudo actualizar la categoría"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Tarea POST no válida"]);
        }
        break;

    case 'DELETE':
        if ($task === 'delete' && isset($_GET['idCategoria'])) {
            $id = $_GET['idCategoria'];
            if ($categoria->delete($id)) {
                echo json_encode(["success" => true, "message" => "Categoría eliminada con éxito"]);
            } else {
                echo json_encode(["success" => false, "message" => "No se pudo eliminar la categoría"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Tarea DELETE no válida"]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Método no soportado"]);
        break;
}
?>
