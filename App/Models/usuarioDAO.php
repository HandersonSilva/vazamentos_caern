<?php

    namespace App\Models;
    use App\Models\BaseDAO;

    class usuarioDAO {
        private $conPdo;

        public function __construct(){
            $this->conPdo = BaseDAO::getConnection();
        }

      
    }