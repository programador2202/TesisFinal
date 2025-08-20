<?php

if ($_SERVER['REQUEST_METHOD']){
  require_once "../models/restaurante.php";
  $restaurante =new Restaurante();

  switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
      header("Content-type: application/json; charset=utf-8");
      if(isset($_GET["task"])){
        if($_GET["task"]=='getAll'){
            echo json_encode($restaurante->getAll());
        } else if ($_GET["task"]=='getById' && isset($_GET['idrestaurante'])){
          echo json_encode( $restaurante ->getById( $_GET['idrestaurante']));
        } else {
          echo json_encode( ["error" =>"Parametro 'task' desconocido o faltan datos."]);
        }
      } else {
        echo json_encode(["error"=> "falta el parametro 'task'."]);
      }
      break;
  
    
  // manejar la inserción de un nuevo restaurante incluyendo imagen
case "POST":
    header("Content-type: application/json; charset=utf-8");

    if (isset($_POST["task"]) && $_POST["task"] == "create") {
        // Campos obligatorios
        $nom_restaurante = $_POST["nom_restaurante"] ?? '';
        $descripcion = $_POST["descripcion"] ?? '';
        $direccion = $_POST["direccion"] ?? '';
        $telefono = $_POST["telefono"] ?? '';
        $idcategoria = $_POST["idcategoria"] ?? '';

        if (!$nom_restaurante || !$descripcion || !$direccion || !$telefono || !$idcategoria) {
            echo json_encode(["error" => "Todos los campos son obligatorios."]);
            break;
        }

    // Manejo de la imagen
if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $imgTmpPath = $_FILES['img']['tmp_name'];
    $imgName = time() . "_" . basename($_FILES['img']['name']); // evitamos nombres repetidos
    $uploadDir = "../public/img/restaurantes/";

    // Crear carpeta si no existe
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            echo json_encode(["error" => "No se pudo crear la carpeta de imágenes."]);
            break;
        }
    }

    $imgPath = $uploadDir . $imgName;

    if (move_uploaded_file($imgTmpPath, $imgPath)) {
        // Guardar la ruta relativa (para el front)
        $relativeImgPath = "public/img/restaurantes/" . $imgName;

        if ($restaurante->create($nom_restaurante, $relativeImgPath, $descripcion, $direccion, $telefono, $idcategoria)) {
            echo json_encode(["success" => "Restaurante creado exitosamente."]);
        } else {
            echo json_encode(["error" => "Error al crear el restaurante en la base de datos."]);
        }
    } else {
        echo json_encode(["error" => "Error al subir la imagen."]);
    }
} else {
    echo json_encode(["error" => "Imagen no proporcionada o error en la subida."]);
}

    break;
}
  }
}