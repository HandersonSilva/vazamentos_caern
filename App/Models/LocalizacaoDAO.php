<?php

    namespace App\Models;
    use App\Models\BaseDAO;
    use App\Models\Entidades\Localizacao;
    use PDO;


    class LocalizacaoDAO {
        private $conPdo;

        public function __construct(){
            $this->conPdo = BaseDAO::getConnection();
        }

        public function Inserir(Localizacao $localizacao){      
        try{
           
           //realizar insercao
            $log = $localizacao->getLog();
            $lat = $localizacao->getLat();
            $rua = $localizacao->getRua();
            $estado = $localizacao->getEstado();
            $cidade = $localizacao->getCidade(); 
            
            $insert = $this->conPdo->prepare(
                "INSERT INTO caern_ponto(log_ponto,lat_ponto,rua_ponto,estado_ponto,cidade_ponto) 
                VALUES(:log,:lat,:rua,:estado,:cidade)"
                );
            //setando os Values
            $insert->bindParam(':log',$log);
            $insert->bindParam(':lat',$lat);
            $insert->bindParam(':rua',$rua);
            $insert->bindParam(':estado',$estado);
            $insert->bindParam(':cidade',$cidade);

            //Retornado as linhas afetadas caso tenha sucesso
            if($insert->execute()){
                return $insert->rowCount();
            }
            $insert = null;//fechar a conexao*/
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        }

        public function retornaID($log , $lat){
            
            try{
               
                 // listando os dados via PDO
	        	// preparamos uma instrução SQL
	        	$obj = $this->conPdo->prepare(
                    "SELECT id_ponto FROM caern_ponto cp WHERE cp.lat_ponto = $lat AND cp.log_ponto = $log"
                );
              
                print_r( $obj);
	        	// executa a instrução SQL
	        	if($obj->execute()){
                    echo $obj->rowCount();

                       	// se retornar mais de um dado, exibe
		            	if($obj->rowCount() > 0){
                            $row = $obj->fetch(PDO::FETCH_OBJ);
                            return $row->id_ponto;
			         }
		        }
                 $obj = null;

            }catch(PDOException $e){
                echo $e->getMessage();
            }

        }

      
    }