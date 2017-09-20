<?php

    namespace App\Models;
    use App\Models\BaseDAO;
    use App\Models\Entidades\Localizacao;

    class LocalizacaoDAO {
        private $conPdo;

        public function __construct(){
            $this->conPdo = BaseDAO::getConnection();
        }

        public function localizacaoInserir(Localizacao $localizacao){      
        try{
           
           //realizar insercao
            $log = $localizacao->getLog();
            $lat = $localizacao->getLat();
            $rua = $localizacao->getRua();
            $estado = $localizacao->getEstado();
            $cidade = $localizacao->getCidade(); 

            $ins = $this->conPdo->prepare(
                "INSERT INTO caern_ponto(log_ponto,lat_ponto,rua_ponto,estado_ponto,cidade_ponto) 
                VALUES(:log,:lat,:rua,:estado,:cidade)"
                );
            //setando os Values
            $ins->bindParam(':log',$log);
            $ins->bindParam(':lat',$lat);
            $ins->bindParam(':rua',$rua);
            $ins->bindParam(':estado',$estado);
            $ins->bindParam(':cidade',$cidade);

            //Retornado as linhas afetadas caso tenha sucesso
            if($ins->execute()){
                return $ins->rowCount();
            }
            $ins = null;//fechar a conexao*/
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        }

      
    }