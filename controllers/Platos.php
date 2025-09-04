<?php
require_once "../models/platos.php";
$platos = new Platos();

switch ($_SERVER["REQUEST_METHOD"]) {

    case "GET":
        header("Content-type: application/json; charset=utf-8");

        if (isset($_GET["task"])) {
            if ($_GET["task"] == 'getAll') {
                echo json_encode($platos->getAll());
            } elseif ($_GET["task"] == 'getById' && isset($_GET['idplatos'])) {
                echo json_encode($platos->getById($_GET['idplatos']));
            } elseif ($_GET["task"] == 'ListarPlatos' && isset($_GET['idrestaurante'])) {
                echo json_encode($platos->ListarPlatos($_GET['idrestaurante']));
            }
            else {
                echo json_encode(["error" => "Parámetro 'task' desconocido o faltan datos."]);
            }
        } else {
            echo json_encode(["error" => "Falta el parámetro 'task'."]);
        }
        break;

    case "POST":
        header("Content-type: application/json; charset=utf-8");

        $task = $_POST['task'] ?? '';
        $idplatos = $_POST['idPlato'] ?? null;
        $nom_platos = $_POST['nom_platos'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $idrestaurante = $_POST['idrestaurante'] ?? '';
        $imagen = $_FILES['img']['name'] ?? null;

        // Si hay imagen, mover al directorio correspondiente
        if ($imagen && isset($_FILES['img'])) {
            $targetDir = "../public/img/platos/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            move_uploaded_file($_FILES['img']['tmp_name'], $targetDir . $imagen);
        }

        if ($task == "create") {
            echo json_encode($platos->create($nom_platos, $descripcion, $precio, $idrestaurante, $imagen));
        } elseif ($task == "update" && $idplatos) {
            echo json_encode($platos->update($idplatos, $nom_platos, $descripcion, $precio, $idrestaurante, $imagen));
        } else {
            echo json_encode(["error" => "Parámetros incorrectos para POST."]);
        }
        break;

    case "DELETE":
        header("Content-type: application/json; charset=utf-8");

        parse_str(file_get_contents("php://input"), $deleteVars);
        $task = $deleteVars['task'] ?? '';
        $idplatos = $deleteVars['idplatos'] ?? null;

        if ($task == "delete" && $idplatos) {
            echo json_encode($platos->delete($idplatos));
        } else {
            echo json_encode(["error" => "Parámetros incorrectos para DELETE."]);
        }
        break;

    default:
        header("Content-type: application/json; charset=utf-8");
        echo json_encode(["error" => "Método HTTP no soportado."]);
        break;
}
?>
