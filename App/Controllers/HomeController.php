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
                
            }else{
                $this->renderHomeData('layouts/home',$data=null);
            }
            
          }catch(PDOException $e){
            throw new Exception("Ops! Erro ao buscar dados no Banco",500);
          }
         
          
        }
        
        public static function geraFeed() {
            ini_set('allow_url_fopen', 1);
            ini_set('allow_url_include', 1);

            // caminho do feed do meu blog
            $feed = 'http://g1.globo.com/dynamo/rn/rio-grande-do-norte/rss2.xml';
            // leitura do feed
            $rss = simplexml_load_file($feed);
            
            
            return $rss;
        }
       
     }

