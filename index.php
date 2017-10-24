<?php
    use App\App;
    use App\Lib\Erro;
   
    //Session start
    //Session_start();

    //aconteça todos os erros menos notice
    error_reporting(E_ALL & ~E_NOTICE);

    require_once("vendor/autoload.php");

    try{
       
        $app = new App();
        $app->run();
    }catch(\Exception $e){
        $oError = new Erro($e);
        $oError->render();
    }
  
  
  