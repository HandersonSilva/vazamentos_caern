<?php
  namespace App\Controllers;
  use App\Models\BaseDAO;

   class HomeController extends Controller{

        public function index(){
         // testando a conexão com o banco via PDO
          $test= BaseDAO::getConnection();      
         
          $this->render('layouts/home');
        }
       
     }

