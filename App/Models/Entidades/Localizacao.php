<?php
    namespace App\Models\Entidades;
    
    class Localizacao 
    {
        private $id;
        private $log;
        private $lat;
        private $rua;
        private $estado;
        private $cidade; 

        public function getId(){
            return $this->id;
        }
     
        public function getLat(){
            return $this->lat;
        }
        public function setLat($lat){
            $this->lat = $lat;
        }
        public function getLog(){
            return $this->log;
        }
        public function setLog($log){
            $this->log= $log;
        }

        public function getRua(){
            return $this->rua;
        }
        public function setRua($rua){
            $this->rua= $rua;
        }

        public function getCidade(){
            return $this->cidade;
        }
        public function setCidade($cidade){
            $this->cidade = $cidade;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }

    }
    