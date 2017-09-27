<?php
  namespace App\Controllers;
  use App\Models\VazamentoDAO;
  use App\Lib\Erro;
  use App\Models\usuarioDAO;
  use App\Models\Entidades\Usuario;

   class HomeController extends Controller{
        
        public function index(){
          try{
            $vazamentoDAO = new VazamentoDAO();
            
            //retorna dados do banco
            $data= $vazamentoDAO->retornaData();
                    
            if($data>0){
            $this->renderHomeData('layouts/home',$data);
            }
            
          }catch(PDOException $e){
            throw new Exception("Ops! Erro ao buscar dados no Banco",500);
          }
         
          
        }
       
     }

