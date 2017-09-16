<?php
  
 
   class Controller{
       
       public function index() {
           include 'App/Views/index.php';
              
     }
     public function login() {
         
         include 'App/Views/viewLogin.php';
        
     }
     
     public function cadastro() {
         
        include 'App/Views/viewCadastro.php';
         
     }
   }

