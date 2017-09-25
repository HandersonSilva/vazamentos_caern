<?php
  namespace App\Controllers;
  use App\Models\BaseDAO;
  use App\Models\usuarioDAO;
  use App\Models\Entidades\Usuario;

   class HomeController extends Controller{

        public function index(){
          
         
          $this->render('layouts/home1');
        }
       
     }

