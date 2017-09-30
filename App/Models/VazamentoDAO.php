<?php

    namespace App\Models;
    use PDO;
    use App\Models\BaseDAO;
    use App\Models\Entidades\Vazamento;

    class VazamentoDAO {
        private $conPdo;

        public function __construct(){
            $this->conPdo = BaseDAO::getConnection();
        }

        public function Inserir(Vazamento $vazamento){      
        try{
           
            
           //realizar insercao
            $descricao = $vazamento->getDescricao();
            $status = $vazamento->getStatus();
            $data = $vazamento->getDate();
            $gravidade = $vazamento->getGravidade();
            $tempo = $vazamento->getTempo(); 
            $fk_id_ponto = $vazamento->getFkPonto(); 
            $fk_id_usuario = $vazamento->getFkUsuario(); 

            $insert = $this->conPdo->prepare("INSERT INTO caern_vazamento(descricao_vazamento,status_vazamento,data_vazamento,gravidade_vazamento,tempo_vazamento ,fk_id_ponto,fk_id_usuario) VALUES(:descricao,:status,:data,:gravidade,:tempo,:id_ponto,:id_usuario)");
            //setando os Values
            $insert->bindParam(':descricao',$descricao);
            $insert->bindParam(':status',$status);
            $insert->bindParam(':data',$data);
            $insert->bindParam(':gravidade',$gravidade);
            $insert->bindParam(':tempo',$tempo);
            $insert->bindParam(':id_ponto',$fk_id_ponto);
            $insert->bindParam(':id_usuario',$fk_id_usuario);
                    
                    echo "<br/>";
                    var_dump($insert);
            //Retornado as linhas afetadas caso tenha sucesso
            if($insert->execute()){
                return $insert->rowCount();
            }
            $insert = null;//fechar a conexao*/
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        }
        public function retornaData(){
            try{
                $select = $this->conPdo->prepare("
                select p.log_ponto,p.lat_ponto,p.rua_ponto,p.cidade_ponto,p.estado_ponto ,v.descricao_vazamento,v.data_vazamento,status_vazamento,u.nome_usuario from caern_vazamento v
                inner join caern_usuario u on u.id_usuario = v.fk_id_usuario
                inner join caern_ponto p on p.id_ponto = v.fk_id_ponto
                group by p.log_ponto,p.lat_ponto,p.rua_ponto,p.cidade_ponto,p.estado_ponto ,v.descricao_vazamento,v.data_vazamento,status_vazamento,u.nome_usuario;
                ");

               
                if( $select->execute()){
                    if($select->rowCount()>0){
                       while($rowdata = $select->fetch(PDO::FETCH_OBJ)){
                           // echo $rowdata->codigo." ".$row->nome." ".$row->email." ".$row->senha."<br/>";
                           $data[]=$rowdata;
                        }
                        return $data;
                    }else{
                        $data = 0;
                        return $data;
                    }
                }
                
                
              }catch(PDOException $e){
                throw new Exception("Erro ao cadstrar o vazamento...",500);
              }
        }
        /*
        public retornaID($log,$at){
            try{
                 // listando os dados via PDO
	        	// preparamos uma instrução SQL
	        	$obj = $this->conPdo->prepare(
                    "SELECT id_ponto FROM caern_ponto cp WHERE cp.log_ponto = :lat AND cp.lat_ponto = :log"
                );
                $obj->bindParam(':log',$log);
                $obj->bindParam(':lat',$lat);

	        	// executa a instrução SQL
	        	if($obj->execute()){
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

        }*/

      
    }