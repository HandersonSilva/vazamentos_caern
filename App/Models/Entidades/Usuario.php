<?php

    namespace App\Models\Entidades;

    class Usuario{
       
        private $id;
        private $nome;
        private $email;
        private $senha;
        
        public function getId(){
            return $this->id;
        }
     
        public function getName(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email= $email;
        }

        public function getSenha(){
            return $this->senha;
        }
        public function setSenha($senha){
            $this->senha = $senha;
        }
    }