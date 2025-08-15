<?php

if ($_SERVER['REQUEST_METHOD']){
  require_once "../models/platos.php";
  $platos =new Platos();


  switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
      header("Content-type: application/json; charset=utf-8");

      if(isset($_GET["task"])){
        if($_GET["task"]=='getAll'){
            echo json_encode($platos->getAll());
        } else if ($_GET["task"]=='getById' && isset($_GET['idplatos'])){
          echo json_encode( $platos ->getById( $_GET['idplatos']));
        } else {
          echo json_encode( ["error" =>"Parametro 'task' desconocido o faltan datos."]);
        }
      } else {
        echo json_encode(["error"=> "falta el parametro 'task'."]);
      }
      break;
  }


}

