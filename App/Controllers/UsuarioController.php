<?php
    namespace App\Controllers;

    class UsuarioController extends Controller
    {
        public function index(){
            $this->redirect("usuario/Cadastro");
        }

        public function Cadastro(){
            $this->render("usuario/Cadastro");
        }

        public function Login(){
            $this->render("usuario/Login");
        }
    }
    