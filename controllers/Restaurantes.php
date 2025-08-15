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
  }
}