<?php
    namespace App\Models\Entidades;

    class Vazamento
    {
        private $id_vazamento;
        private $descricao;
        private $status;
        private $data;
        private $gravidade;
        private $tempo; 
        private $fk_id_ponto;
        private $fk_id_usuario;


        public function getId(){
            return $this->id_vazamento;
        }
     
        public function getDescricao(){
            return $this->descricao;
        }
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        public function getStatus(){
            return $this->status;
        }
        public function setStatus($status){
            $this->status = $status;
        }

        public function getDate(){
            return $this->data;
        }
        public function setDate($data){
            $this->data = $data;
        }

        public function getGravidade(){
            return $this->gravidade;
        }
        public function setGravidade($gravidade){
            $this->gravidade = $gravidade;
        }
        public function getTempo(){
            return $this->tempo;
        }
        public function setTempo($tempo){
            $this->tempo = $tempo;
        }
        public function getFkPonto(){
            return $this->fk_id_ponto;
        }
        public function setFkPonto($id_ponto){
            $this->fk_id_ponto = $id_ponto;
        }
        public function getFkUsuario(){
            return $this->fk_id_usuario;
        }
        public function setFkUsuario($id_usuario){
            $this->fk_id_usuario = $id_usuario;
        }
    }
    