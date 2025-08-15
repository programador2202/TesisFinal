<?php

if ($_SERVER['REQUEST_METHOD']) {
    require_once "../models/categoria.php";
    $categorias = new categoria();

    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            header("Content-Type: application/json; charset=utf-8");

            if (isset($_GET["task"])) {
                if ($_GET["task"] == 'getAll') {
                    echo json_encode($categorias->getAll());
                } else if ($_GET["task"] == 'getById' && isset($_GET['idcategoria'])) {
                    echo json_encode($categorias->getById($_GET['idcategoria']));
                } else {
                    echo json_encode(["error" => "Parámetro 'task' desconocido o faltan datos."]);
                }
            } else {
                echo json_encode(["error" => "Falta el parámetro 'task'."]);
            }
            break;
    }
}
