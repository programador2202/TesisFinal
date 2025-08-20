<?php
require_once "../models/restaurante.php";
$restaurante = new Restaurante();

// Obtener el método real (POST se usa también para update)
$method = $_SERVER['REQUEST_METHOD'];

header("Content-type: application/json; charset=utf-8");

switch ($method) {

   
    case "GET":
        if (isset($_GET["task"])) {
            if ($_GET["task"] == 'getAll') {
                echo json_encode($restaurante->getAll());
            } elseif ($_GET["task"] == 'getById' && isset($_GET['idrestaurante'])) {
                echo json_encode($restaurante->getById($_GET['idrestaurante']));
            } else {
                echo json_encode(["error" => "Parametro 'task' desconocido o faltan datos."]);
            }
        } else {
            echo json_encode(["error" => "Falta el parametro 'task'."]);
        }
        break;


    case "POST":
        $task = $_POST["task"] ?? '';

        $idrestaurante   = $_POST["idRestaurante"] ?? '';
        $nom_restaurante = $_POST["nom_restaurante"] ?? '';
        $descripcion     = $_POST["descripcion"] ?? '';
        $direccion       = $_POST["direccion"] ?? '';
        $telefono        = $_POST["telefono"] ?? '';
        $idcategoria     = $_POST["idcategoria"] ?? '';
        $imgPath         = '';

        // Validar campos obligatorios
        if (!$nom_restaurante || !$descripcion || !$direccion || !$telefono || !$idcategoria) {
            echo json_encode(["error" => "Todos los campos son obligatorios."]);
            exit;
        }

        // Manejo de imagen si se sube
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $imgTmpPath = $_FILES['img']['tmp_name'];
            $imgName = time() . "_" . basename($_FILES['img']['name']); 
            $uploadDir = "../public/img/restaurantes/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $imgPathFull = $uploadDir . $imgName;
            if (move_uploaded_file($imgTmpPath, $imgPathFull)) {
                $imgPath = "public/img/restaurantes/" . $imgName;
            }
        }

        // Crear restaurante
        if ($task == "create") {
            if (!$imgPath) {
                echo json_encode(["error" => "Debe proporcionar una imagen para crear el restaurante."]);
                exit;
            }

            if ($restaurante->create($nom_restaurante, $imgPath, $descripcion, $direccion, $telefono, $idcategoria)) {
                echo json_encode(["success" => "Restaurante creado exitosamente."]);
            } else {
                echo json_encode(["error" => "Error al crear el restaurante."]);
            }
        }

        // Actualizar restaurante
        elseif ($task == "update") {
            if (!$idrestaurante) {
                echo json_encode(["error" => "ID de restaurante requerido para actualizar."]);
                exit;
            }

            // Si no se subió imagen, mantener la anterior
            if (!$imgPath) {
                $restData = $restaurante->getById($idrestaurante);
                $imgPath = $restData['img'] ?? '';
            }

            if ($restaurante->update($idrestaurante, $nom_restaurante, $imgPath, $descripcion, $direccion, $telefono, $idcategoria)) {
                echo json_encode(["success" => "Restaurante actualizado exitosamente."]);
            } else {
                echo json_encode(["error" => "Error al actualizar el restaurante."]);
            }
        } else {
            echo json_encode(["error" => "Tarea POST desconocida"]);
        }
        break;

    // delete
    case "DELETE":
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (isset($_DELETE["task"]) && $_DELETE["task"] == "delete" && isset($_DELETE["idrestaurante"])) {
            $idrestaurante = $_DELETE["idrestaurante"];
            if ($restaurante->delete($idrestaurante)) {
                echo json_encode(["success" => "Restaurante eliminado correctamente."]);
            } else {
                echo json_encode(["error" => "Error al eliminar el restaurante."]);
            }
        } else {
            echo json_encode(["error" => "Faltan parámetros para eliminar."]);
        }
        break;

    default:
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
