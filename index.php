<?php

  require_once ('App/Controllers/homeController.php');
  
  $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : "index";
  
  $controller = new Controller();
  
  switch ($pagina){
      case "index":
          $controller->index();
          break;
      case "viewLogin":
          $controller->login();
          break;
      case "viewCadastro":
          $controller->cadastro();
          break;
  }
  
  
  